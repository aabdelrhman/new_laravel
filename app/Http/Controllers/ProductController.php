<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertProduct;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct(){
        $this->middleware('permission:show-product');
        $this->middleware('permission:create-product' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:edit-product' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:archif-product' , ['only' => ['destroy']]);
    }

    public function index(){
        $products = Product::with('section' , 'brand' , 'offer')->selectionProduct()->paginate(5);
        return view('Admin.Product.index' , compact('products'));
    }

    public function create(){
        $sections = Section::selectSectionBlade()->active()->get();
        $brands = Brand::selectBrandBlade()->active()->get();
        return view('Admin.Product.create' , get_defined_vars());
    }

    public function store(insertProduct $request){
        try {
            $photos =array();
            foreach($request->photos as $photo){
                $file_name = saveImage($photo , "images/Product/");
                $photos[] = $file_name ;
            }
            Product::create([
                'name_en' => $request->name_en ,
                'name_ar' => $request->name_ar ,
                'desc_en' => $request->desc_en ,
                'desc_ar' => $request->desc_ar ,
                'price' => $request->price ,
                'photos' => $photos ,
                'section_id' => $request->section_id ,
                'brand_id' =>  $request->brand_id,
            ]);
            return redirect()->route('product.index')->with('success' , __('messages.success add'));
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error' , __('messages.error add'));
        }

    }

    public function edit(Product $product){
        $sections = Section::selectsectionBlade()->active()->get();
        $brands = Brand::selectbrandBlade()->active()->get();
        return view('Admin.Product.edit' , get_defined_vars());
    }

    public function update(insertProduct $request , Product $product){
        try {
            if($product -> section -> status == 1){
                if($request->has('status')){
                    $request->request->add(['status' => 1]);
                }else{
                    $request->request->add(['status' => 0]);
                }
                $product->update($request->except('_token' , 'photos'));
                return redirect()->route('product.index')->with('success' , __('messages.success update'));
            }
            return redirect()->route('product.index')->with('error' , __('messages.error cant update section not active'));
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error' , __('messages.error update'));
        }
    }

    public function destroy(Product $product){
        try {
            $product->delete();
            return redirect()->route('product.index')->with('success' , __('messages.success Archief'));
        } catch (\Throwable $th) {
            return redirect()->route('product.index')->with('error' , __('messages.error Archief'));
        }

    }

    public function archif(){
        $products = Product::onlyTrashed()->selectionProduct()->get();
        return view('Admin.Product.archif' , compact('products'));
    }

    public function deleteArchif($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $photos = collect($product->photos);
        $photos_count = $photos->count();
        if($photos_count > 0){
            for ($i=0; $i < $photos_count; $i++) {
                removeImage($photos[$i] , 'images/Product/');
            }
        }
        $product -> forceDelete();
        return redirect()->route('product.index')->with('success' , __('messages.success delete'));
    }

    public function restoreArchif($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product -> restore();
        return redirect()->route('product.index')->with('success' , __('messages.success restore'));
    }

    public function showImages($id){
        $product = Product::findOrFail($id);
        return view('Admin.Product.image' , compact('product'));
    }

    public function imageDelete($id , $image_id){
        $product = Product::findOrFail($id);
        $photos = $product->photos; //All images before delete
        $photo = $product->photos[$image_id];  //the image will delete
        array_splice($photos , $image_id , ++$image_id);  //delete image from array
        removeImage($photo , 'images/Product/');  //remove image from storge
        $product->update([
            'photos' => $photos
        ]);  // update images array in database
        return redirect()->route('showImages' , $id)->with('success' , __('messages.success delete'));
    }

    public function imageAdd($id , Request $request){
        try {
            $product = Product::findOrFail($id);
            $photos = $product->photos;  //old all images in database
            foreach($request->photos as $photo){
                $file_name = saveImage($photo , "images/Product/");  //save image in storage
                array_push($photos , $file_name);  //add new image in array with old
            }
            $product->update([
                'photos' => $photos  //update array in database with new image
            ]);
            return redirect()->route('showImages' , $id)->with('success' , __('messages.success add') );
        } catch (\Throwable $th) {
            return redirect()->route('showImages' , $id)->with('error' , __('messages.error add'));
        }

    }
}
