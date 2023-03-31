<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantCompany extends Model
{
    protected $fillable = ['id','company','group_id','status','created_at','updated_at'];
}
