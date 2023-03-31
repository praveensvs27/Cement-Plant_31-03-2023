<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['id','plant','plant_type_id','company_id','latitude','longitude','contact_person_name','contact_phone_no','contact_email','city','state_id','address','status','created_at','updated_at'];
}
