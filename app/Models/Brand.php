<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name_en' , 'name_ar' , 'status'];

    public function scopeSelectionBrand($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' , 'status');
    }

    public function scopeSelectBrandBlade($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name');
    }

    public function scopeActive($query){
        return $query->where('status' , 1);
    }

    public function getStatus(){
        return $this->status == 1 ? 'Active' : 'Not Active' ;
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
