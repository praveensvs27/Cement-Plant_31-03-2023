<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\PlantType;
use App\Models\PlantCompany;
use App\Models\StateCreation;
class PlantController extends Controller
{
    public function plant()
    {
        $plant_types = PlantType::select('id','plant_type')->get();
        $companys = PlantCompany::select('id','company')->get();
        $states = StateCreation::select('state_id','state_name')->where('status','=','1')->get();
        return view('plant',['plant_types'=>$plant_types,'companys'=>$companys,'states'=>$states]);
    }
    public function count(Request $request)
    {
        $id=$request->input('Plant_Id');$Plant=$request->input('Plant');
        if($id!="0"){return Plant::where('plant','=',$Plant)->where('id','!=',$id)->count();}
        else{return Plant::where('plant','=',$Plant)->count();}
    }
    public function retrieve()
    {
        $tb =Plant::join('plant_types', 'plant_types.id', '=', 'plants.plant_type_id')->join('plant_companies', 'plant_companies.id', '=', 'plants.company_id')->join('state_creation', 'state_creation.state_id', '=', 'plants.state_id')->orderBy('plants.id')->get(['plants.*','plant_types.plant_type','plant_companies.company','state_creation.state_name']);
        return response()->json($tb);
    }
    public function insert(Request $request)
    {
        $Contact_Person_name=$request->input('Contact_Person_name');if($Contact_Person_name==null){$Contact_Person_name="";}
        $Contact_Phone_number=$request->input('Contact_Phone_number');if($Contact_Phone_number==null){$Contact_Phone_number="";}
        $Contact_Email=$request->input('Contact_Email');if($Contact_Email==null){$Contact_Email="";}
        $Address=$request->input('Address');if($Address==null){$Address="";}
        $tb = new Plant([
            'plant_type_id' => $request->input('Plant_Type_Id'),
            'plant' => $request->input('Plant'),
            'company_id' => $request->input('Company_Id'),
            'latitude' => $request->input('Latitude'),
            'longitude' => $request->input('Longitude'),
            'city' => $request->input('City'),
            'state_id' => $request->input('State_Id'),
            'contact_person_name' => $Contact_Person_name,
            'contact_phone_no' => $Contact_Phone_number,
            'contact_email' => $Contact_Email,
            'address' => $Address,
            'status' => $request->input('Status')
        ]);
        $tb->save();
    }
    public function update(Request $request)
    {
        $Contact_Person_name=$request->input('Contact_Person_name');if($Contact_Person_name==null){$Contact_Person_name="";}
        $Contact_Phone_number=$request->input('Contact_Phone_number');if($Contact_Phone_number==null){$Contact_Phone_number="";}
        $Contact_Email=$request->input('Contact_Email');if($Contact_Email==null){$Contact_Email="";}
        $Address=$request->input('Address');if($Address==null){$Address="";}
        $tb = Plant::find($request->input('Plant_Id'));
        $tb->plant_type_id = $request->input('Plant_Type_Id');
        $tb->plant = $request->input('Plant');
        $tb->company_id = $request->input('Company_Id');
        $tb->latitude = $request->input('Latitude');
        $tb->longitude = $request->input('Longitude');
        $tb->city = $request->input('City');
        $tb->state_id = $request->input('State_Id');
        $tb->contact_person_name = $Contact_Person_name;
        $tb->contact_phone_no = $Contact_Phone_number;
        $tb->contact_email = $Contact_Email;
        $tb->address = $Address;
        $tb->status = $request->input('Status');
        $tb->save();
    }
    public function delete(Request $request)
    {
        $tb = Plant::find($request->input('Plant_Id'));
        $tb->delete();
    }
}
