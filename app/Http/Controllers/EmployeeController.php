<?php
namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    function employee_list(){
        return Employee::all();
    }



    function employee_add(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $insert = [
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $add = Employee::create($insert);
        if($add){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record created succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record created failed!'
            ];
            return $response;
        }
    } 



    function employee_view(Request $request){
        return Employee::find($request->id);
    } 



    
    function employee_edit(Request $request){


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }

        $update = [
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $edit = Employee::where('id', $request->employee_id)->update($update);
        if($edit){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record updated succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record updated failed!'
            ];
            return $response;
        }
    } 


    function employee_delete(Request $request){
        $delete =  Employee::destroy($request->id);
        if($delete){
            $response = [
                'status'=>'ok',
                'success'=>true,
                'message'=>'Record deleted succesfully!'
            ];
            return $response;
        }else{
            $response = [
                'status'=>'ok',
                'success'=>false,
                'message'=>'Record deleted failed!'
            ];
            return $response;
        }
    } 





} 