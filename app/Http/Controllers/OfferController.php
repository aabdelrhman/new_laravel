<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertOffer;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Carbon;

class OfferController extends Controller
{
    function index(){
        $offers = Offer::with('product')->paginate(5);
        return view('Admin.Offer.index' , compact('offers'));
    }

    function create(){
        $sections = Section::selectsectionBlade()->active()->get();
        $brands = Brand::selectBrandBlade()->active()->get();
        return view('Admin.offer.create' , get_defined_vars());
    }

    function store(insertOffer $request){
        try {
            $today = Carbon::now();
            $offer_begin = Carbon::createFromFormat('Y-m-d' , $request->offer_begin);
            $offer_end = Carbon::createFromFormat('Y-m-d' , $request->offer_end);
            if($today->gte($offer_begin) && $today->lte($offer_end)){
                $status = 1 ;
            }else{
                $status = 0 ;
            }
            $data_insert  = array() ;
            foreach($request->product_id as $product){
                $data_insert [] =[
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'product_id' => $product,
                'offer_ratio' => $request->offer_ratio,
                'offer_begin' => $request->offer_begin,
                'offer_end' => $request->offer_end,
                'status' => $status,
                ];
            }
            Offer::insert($data_insert);
            return redirect()->route('offers.index')->with('success' , __('messages.success add'));
        } catch (\Throwable $th) {
            return redirect()->route('offers.index')->with('error' , __('messages.error add'));
        }
    }

    function edit(Offer $offer){
        $products = Product::selectionProduct()->get();
        $sections = Section::selectsectionBlade()->get();
        $brands = Brand::selectionBrand()->get();
        $offer->load('product');
        return view('Admin.Offer.edit' , get_defined_vars()) ;
    }

    function update(insertOffer $request ,Offer $offer){
        try {
            $product = (int)$request->product;
            $offer -> update([
                'name_en' => $request->name_en,
                'name_ar' => $request->name_ar,
                'product_id' => $product,
                'offer_ratio' => $request->offer_ratio,
                'offer_begin' => $request->offer_begin,
                'offer_end' => $request->offer_end,
            ]);
            return redirect()->route('offers.index')->with('success' , __('messages.success update'));
        } catch (\Throwable $th) {
            return $th ;
            // return redirect()->route('offers.index')->with('error' , __('messages.error update'));
        }
    }

    function destroy(Offer $offer){
        try {
            $offer -> delete();
            return redirect()->route('offers.index')->with('success' , __('messages.success delete'));
        } catch (\Throwable $th) {
            return redirect()->route('offers.index')->with('error' , __('messages.error delete'));
        }
    }

    public function ajaxGetProduct($section_id , $brand_id){
        if($brand_id == 0){
            $products = Product::where('section_id' , $section_id)->selectionProductajax()->get();
            return response()->json([
                'products' => $products,
            ]);
        }if ($section_id == 0) {
            $products = Product::where('brand_id' , $brand_id)->selectionProductajax()->get();
            return response()->json([
                'products' => $products,
            ]);
        } else {
            $products = Product::where([['section_id' , '=' , $section_id] ,
            ['brand_id' , '=' , $brand_id]])->selectionProductajax()->get();
            return response()->json([
                'products' => $products,
            ]);
        }
    }
}
