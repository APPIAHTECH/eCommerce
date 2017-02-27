<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Order;

class PaypalController extends BaseController
{
  private $_api_context;
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

    public function postPayment()
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
        $items = array();
		$subtotal = 0;
		$cart = \Session::get('cart');
		$currency = 'EUR';
		foreach($cart as $producto){
			$item = new Item();
			$item->setName($producto->name)
			->setCurrency($currency)
			->setDescription($producto->extract)
			->setQuantity($producto->quantity)
			->setPrice($producto->price);
			$items[] = $item;
			$subtotal += $producto->quantity * $producto->price;
        }

        $item_list = new ItemList();
		$item_list->setItems($items);

        $details = new Details();
		$details->setSubtotal($subtotal)->setShipping(100);

        $total = $subtotal + 100;
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);

    $transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Comanda prova botiga-Laravel');

    $redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));

        try {

			$payment->create($this->_api_context);
            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
		      }

            // add payment ID to session
		  \Session::put('paypal_payment_id', $payment->getId());

        //En Funcion de lo que ens retorni el metode $payment->create
        //Redirecionem el usuari a la plataforma de paypal o l'se envia un missatge de error
        //En cas d'un error en enviaria al cart-show amb l'error correspondent

        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
          }

		return \Redirect::route('cart-show')
			->with('error', 'Error algo anat malament.');

		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Error! algo ha sortit malament');
			}
		}

    }

    public function getPaymentStatus(Request $request)
		{
			// Get the payment ID before session clear
			$payment_id = \Session::get('paypal_payment_id');
			// clear the session payment ID
			\Session::forget('paypal_payment_id');
      $payerId = $request->get('PayerID');
			$token = $request->get('token');
			//if (empty($request->get('PayerID')) || empty($request->get('token'))) {
			if (empty($payerId) || empty($token)) {
				return \Redirect::route('home')
				->with('message', 'Ha hagut un problema a l`hora de pagar amb Paypal');
			}

          $payment = Payment::get($payment_id, $this->_api_context);
    		// PaymentExecution object includes information necessary
    		// to execute a PayPal account payment.
    		// The payer_id is added to the request query parameters
    		// when the user is redirected from paypal back to your site
    		$execution = new PaymentExecution();
    		$execution->setPayerId($request->get('PayerID'));
    		//Execute the payment
    		$result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { // payment made
			\Session::forget('cart');
			return \Redirect::route('home')
				->with('message', 'Compra realitzada correctament');
		}
		return \Redirect::route('home')
			->with('message', 'La compra ha estat cancel·lada');
	}

    private function saveOrder($cart)
	  {
	    $subtotal = 0;
	    foreach($cart as $item){
	        $subtotal += $item->price * $item->quantity;
	    }

	    $order = Order::create([
	        'subtotal' => $subtotal,
	        'shipping' => 100,
	        'user_id' => \Auth::user()->id
	    ]);

	    foreach($cart as $item){
	        $this->saveOrderItem($item, $order->id);
	    }
	}

    private function saveOrderItem($item, $order_id)
	{
		OrderItem::create([
			'quantity' => $item->quantity,
			'price' => $item->price,
			'product_id' => $item->id,
			'order_id' => $order_id
		]);
	}
}
