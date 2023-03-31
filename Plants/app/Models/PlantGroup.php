<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantGroup extends Model
{
    protected $fillable = ['id','group','status','created_at','updated_at'];
}
