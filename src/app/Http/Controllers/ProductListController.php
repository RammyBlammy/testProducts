<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductListController extends Controller
{
    public function index()
    {
        $columns = Schema::getColumnListing('product');
        return view('product-list', [
            'cols' => $columns,
            'products' => Product::all()->toArray()
        ]);
    }
}
