<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantGroup;
use App\Models\PlantCompany;
class PlantCompanyController extends Controller
{
    public function company()
    {
        $tb = PlantGroup::select('id','group')->get();
        return view('company',['groups'=>$tb]);
    }
    public function count(Request $request)
    {
        $id=$request->input('Company_Id');$Company=$request->input('Company');
        if($id!="0"){return PlantCompany::where('company','=',$Company)->where('id','!=',$id)->count();}
        else{return PlantCompany::where('company','=',$Company)->count();}
    }
    public function retrieve()
    {
        $tb =PlantCompany::join('plant_groups', 'plant_groups.id', '=', 'plant_companies.group_id')->get(['plant_companies.*', 'plant_groups.group']);
        return response()->json($tb);
    }
    public function insert(Request $request)
    {
        $tb = new PlantCompany([
            'company' => $request->input('Company'),
            'group_id' => $request->input('Group_Id'),
            'status' => $request->input('Status'),
        ]);
        $tb->save();
    }
    public function update(Request $request)
    {
        $tb = PlantCompany::find($request->input('Company_Id'));
        $tb->company = $request->input('Company');
        $tb->group_id = $request->input('Group_Id');
        $tb->status = $request->input('Status');
        $tb->save();
    }
    public function delete(Request $request)
    {
        $tb = PlantCompany::find($request->input('Company_Id'));
        $tb->delete();
    }
}
