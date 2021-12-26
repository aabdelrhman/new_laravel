<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $cart_item = Cart::where([['user_id' , '=' , Auth::guard('web')->user()->id],
        ['product_id' , '=' , $request->id]])->first();
        // Check this product aleardy exsits in cart for this user
        if(!$cart_item){
            $product = Product::with('offer')->findOrFail($request->id);
            if($product){
                // Check if this product has Offer
                if(isset($product->offer)){
                    $price       = (int)$product->price;  //Price befor offer
                    $offer_ratio = (int)$product->offer->offer_ratio;  //offer ratio
                    $discount    = round($price/$offer_ratio , 2) ;  //Discount offer
                    $new_price   = $price - $discount ;  //new price after discount
                }else{
                    $new_price   = (int)$product->price; ;
                }
                // Save data in table
                Cart::create([
                    'user_id' => Auth::guard('web')->user()->id,
                    'product_id' => $request->id,
                    'price' => $new_price
                ]);
                return response()->json([
                    'msg' => 'success massage'
                ]);
            }
        }else{
            return response()->json([
                'msg' => 'This product aleady in your cart'
            ]);
        }

    }
}
