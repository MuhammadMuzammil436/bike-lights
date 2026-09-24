<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function ProductsList()
    {
        $data['title'] = 'Products List';

        return view('adminpanel.products', $data);
    }

    public function AddProduct()
    {
        echo 'AddProduct';
    }
}
