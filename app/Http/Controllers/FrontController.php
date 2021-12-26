<?php

namespace App\Http\Controllers;

use App\Http\Requests\priceLimitShop;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $offers =  Offer::with('product')->activetion()->get();
        $products = Product::with('section' , 'brand' , 'offer')->selectionProduct()->latest()->get();
        $sections = Section::with('products')->selection()->get();
        return view('Front.index' , get_defined_vars());
        // return get_defined_vars() ;
    }

    public function about()
    {
        return view('Front.about');
    }

    public function shop()
    {
        $products = Product::with('offer')->selectionProduct()->latest()->paginate(5);
        return view('Front.shop' , get_defined_vars());
    }

    public function cart()
    {
        return view('Front.cart');
    }

    public function shop_brand($brand_id)
    {
        $brand = Brand::with('products')->findOrFail($brand_id);
        return view('Front.shop' , get_defined_vars());
    }

    public function shop_section($section_id)
    {
        $section = Section::with('products')->findOrFail($section_id);
        return view('Front.shop' , get_defined_vars());
    }

    public function shop_price_limit (priceLimitShop $request){
        $start = $request->start;
        $end = $request->end;
        $products = Product::with('offer')->selectionProduct()->whereBetween('price' , [$start , $end])->latest()->paginate(5);
        return view('Front.shop' , get_defined_vars());
    }

}
