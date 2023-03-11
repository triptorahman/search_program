<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user_info(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
        
    }
}
