<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertBrand;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('permission:show-brand');
        $this->middleware('permission:create-brand' , ['only' => ['create' , 'store']]);
        $this->middleware('permission:edit-brand' , ['only' => ['edit' , 'update']]);
        $this->middleware('permission:delete-brand' , ['only' => ['destroy']]);
    }

    public function index(){
        $brands = Brand::selectionBrand()->paginate(10);
        return view('Admin.Brand.index' , compact('brands'));
    }

    public function create(){
        return view('Admin.Brand.create');
    }

    public function store(insertBrand $request){
        try {
            Brand::create($request->except('_token'));
            return redirect()->route('brand.index')->with('success' , __('messages.success add'));
        } catch (\Throwable $th) {
            return redirect()->route('brand.index')->with('error' , __('messages.error add'));
        }
    }

    public function edit(Brand $brand){
        if($brand){
            return view('Admin.Brand.edit' , compact('brand'));
        }else{
            return redirect()->route('brand.index')->with('error' , __('messages.not found'));
        }
    }

    public function update(insertBrand $request , Brand $brand){
        try {
            if($brand){
                if($request->has('status')){
                    $request->request->add(['status' => 1]);
                }else{
                    $request->request->add(['status' => 0]);
                }
                $brand->update($request->except('_token'));
                return redirect()->route('brand.index')->with('success' , __('messages.success update'));
            }else{
                return redirect()->route('brand.index')->with('error' , __('messages.error update'));
            }
        } catch (\Throwable $th) {
            return redirect()->route('brand.index')->with('error' , __('messages.errorn update'));
        }
    }

    public function destroy(Brand $brand){
        if($brand){
            $brand->delete();
            return redirect()->route('brand.index')->with('success' , __('messages.Delete success'));
        }else{
            return redirect()->route('brand.index')->with('error' , __('messages.not found'));
        }
    }
}
