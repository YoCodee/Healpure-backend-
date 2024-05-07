<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genderModele extends Model
{
    use HasFactory;
    protected $table = "gender";
    protected $guarded = [''];
}
