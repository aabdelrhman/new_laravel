<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminVerify extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'token',
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
