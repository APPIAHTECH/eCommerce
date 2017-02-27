<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\SaveProductRequest;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(5);
        return view('admin.product.index', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.product.create', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SaveProductRequest $request)
    {
        $data = [
            'name'          => $request->get('name'),
            'slug'          => str_slug($request->get('name')),
            'description'   => $request->get('description'),
            'extract'       => $request->get('extract'),
            'price'         => $request->get('price'),
            'image'         => $request->get('image'),
            'visible'       => $request->has('visible') ? 1 : 0,
            'category_id'   => $request->get('category_id')
        ];
        
        $product = Product::create($data);
        $message = $product ? 'Producto afagit correctamente!' : 'El producto no es pot afegir';
        return redirect()->route('product.index')->with('message', $message);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Product $product)
    {
        return $product;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('id', 'desc')->pluck('name', 'id');
        return view('admin.product.edit', compact('categories', 'product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SaveProductRequest $request, Product $product)
    {
        $product->fill($request->all());
        $product->slug = str_slug($request->get('name'));
        $product->visible = $request->has('visible') ? 1 : 0;
        
        $updated = $product->save();
        $message = $updated ? 'Producte actualitzat correctamente!' : 'El Producto no es pot actualizar!';
        return redirect()->route('product.index')->with('message', $message);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        $message = $deleted ? 'Producte eliminat correctamente!' : 'El producto no es pot eliminar!';
        return redirect()->route('product.index')->with('message', $message);
    }
}