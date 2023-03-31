<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantGroup;
class PlantGroupController extends Controller
{
    public function count(Request $request)
    {
        $id=$request->input('Group_Id');$Group=$request->input('Group');
        if($id!="0"){return PlantGroup::where('group','=',$Group)->where('id','!=',$id)->count();}
        else{return PlantGroup::where('group','=',$Group)->count();}
    }
    public function retrieve()
    {
        $tb = PlantGroup::select('id','group','status')->get();
        return response()->json($tb);
    }
    public function insert(Request $request)
    {
        $tb = new PlantGroup([
            'group' => $request->input('Group'),
            'status' => $request->input('Status'),
        ]);
        $tb->save();
    }
    public function update(Request $request)
    {
        $tb = PlantGroup::find($request->input('Group_Id'));
        $tb->group = $request->input('Group');
        $tb->status = $request->input('Status');
        $tb->save();
    }
    public function delete(Request $request)
    {
        $tb = PlantGroup::find($request->input('Group_Id'));
        $tb->delete();
    }
}
