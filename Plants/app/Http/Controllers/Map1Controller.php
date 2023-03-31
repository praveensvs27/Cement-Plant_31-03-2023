<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\SiteCreation;
class Map1Controller extends Controller
{
    public function map1()
    {
        $sites = SiteCreation::select('id','site_name','latitude','longitude')->orderBy('site_name')->get();
        //$plants = Plant::select('(select cement_group from cement_group where cement_group_id=(select cement_group_id from cement_company where cement_company_id=cement_plant.cement_company_id)) as cement_group','(select cement_company from cement_company where cement_company_id=cement_plant.cement_company_id) as cement_company','cement_plant','city','latitude','longitude')->get();
        $plants =Plant::join('plant_companies', 'plant_companies.id', '=', 'plants.company_id')->join('plant_groups', 'plant_groups.id', '=', 'plant_companies.group_id')->orderBy('plants.id')->get(['plant_groups.group','plant_companies.company','plants.plant','plants.city','plants.latitude','plants.longitude']);
        return view('map1',['sites'=>$sites,'plants'=>$plants]);
    }
}
