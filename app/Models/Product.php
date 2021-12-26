<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Product extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable =[
        'id' ,'name_en' , 'name_ar' , 'desc_en' , 'desc_ar' , 'price' , 'photos' , 'section_id' , 'brand_id' , 'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function scopeSelectionProduct($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'desc_'.LaravelLocalization::getCurrentLocale().' as desc' , 'price' , 'photos' , 'status' , 'section_id' , 'brand_id');
    }

    public function scopeSelectionProductajax($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name');
    }

    public function getStatus(){
        return $this->status == 0 ? __('messages.Not Active') : __('messages.Active') ;
    }

    public function scopeActive($query){
        return $query->where('status' , 1);
    }

    public function section(){
        return $this->belongsTo(Section::class)->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'desc_'.LaravelLocalization::getCurrentLocale().' as desc', 'photo' , 'status');
    }

    public function brand(){
        return $this->belongsTo(Brand::class)->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'status');
    }

    public function offer(){
        return $this->hasOne(Offer::class)->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'offer_ratio' , 'offer_begin' , 'offer_end' , 'product_id');
    }
}
