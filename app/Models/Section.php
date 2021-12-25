<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = ['name_en' , 'name_ar' , 'desc_en' , 'desc_ar' , 'status' , 'photo'];

    public function scopeSelection($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name' ,
        'desc_'.LaravelLocalization::getCurrentLocale().' as desc', 'photo' , 'status');
    }

    public function scopeSelectsectionBlade($query){
        return $query->select('id' , 'name_'.LaravelLocalization::getCurrentLocale().' as name');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function scopeActive($query){
        return $query->where('status' , 1);
    }

    // protected $statuses = array(
    //     '0' => 'Not Active',
    //     '1' => 'Active'
    // );
    // public function getStatusAttribute($val){
    //     return $this->statuses[$val];
    // }

    public function getStatus(){
        return $this->status == 0 ? __('messages.Not Active') : __('messages.Active') ;
    }

    public function getPhoto(){
        return $this->photo != "" ? asset('images/Section/'.$this->photo) : '' ;
    }
}
