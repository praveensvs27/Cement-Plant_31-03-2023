<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantType;
class PlantTypeController extends Controller
{
    public function count(Request $request)
    {
        $id=$request->input('Plant_Type_Id');$Plant_Type=$request->input('Plant_Type');
        if($id!="0"){return PlantType::where('plant_type','=',$Plant_Type)->where('id','!=',$id)->count();}
        else{return PlantType::where('plant_type','=',$Plant_Type)->count();}
    }
    public function retrieve()
    {
        $tb = PlantType::select('id','plant_type','status')->get();
        return response()->json($tb);
    }
    public function insert(Request $request)
    {
        $tb = new PlantType([
            'plant_type' => $request->input('Plant_Type'),
            'status' => $request->input('Status'),
        ]);
        $tb->save();
    }
    public function update(Request $request)
    {
        $tb = PlantType::find($request->input('Plant_Type_Id'));
        $tb->plant_type = $request->input('Plant_Type');
        $tb->status = $request->input('Status');
        $tb->save();
    }
    public function delete(Request $request)
    {
        $tb = PlantType::find($request->input('Plant_Type_Id'));
        $tb->delete();
    }
}
