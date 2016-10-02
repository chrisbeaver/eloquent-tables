<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Table\TableBuilder;

use App\Http\Requests;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
    	return view('products.index');
    }

    public function data(Request $request)
    {
    	// return Product::where(['company_id' => 1]);
    	return TableBuilder::makeTable(Product::with('company'));
    }

}
