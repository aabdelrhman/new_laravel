<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Offer extends Model
{
    use HasFactory;

    protected $fillable =['name_en' , 'name_ar' , 'offer_ratio' , 'offer_begin' , 'offer_end' , 'product_id' , 'status'];

    protected $casts = [
        'product_id' => 'array',
    ];

    public function product(){
        return $this->belongsTo(Product::class)->select('id' ,
         'name_'.LaravelLocalization::getCurrentLocale().' as name', 'photos' ,
         'desc_'.LaravelLocalization::getCurrentLocale().' as desc',
         'price' , 'section_id' , 'brand_id');
    }

    public function scopeActivetion($query){
        return $query->where('status' , 1);
    }
}
