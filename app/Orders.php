<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [ 'nom_article', 'descripcio_article'];
    protected $fillable = ['subtotal', 'shipping', 'user_id'];
}
