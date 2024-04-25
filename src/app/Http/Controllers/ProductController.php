<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomFields;
use App\Models\ImageProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    public function showDetails($id)
    {
        $product = Product::find($id)->toArray();
        $customFields = CustomFields::where(['product_id' => $id])->first()->toArray();
        $images = ImageProduct::where(['product_id' => $id])->get()->toArray();
        $productInfo = array_merge($product, $customFields);
        return view('product', [
            'product' => $productInfo,
            'imagesInfo' => $images
        ]);
    }
}
