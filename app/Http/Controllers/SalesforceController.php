<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omniphx\Forrest\Providers\Laravel\Facades\Forrest;

class SalesforceController extends Controller
{
    public function index()
    {
        try {
            $response = Forrest::sobjects('student__c', [
                'method' => 'post',
                'body' => [
                    'Name' => 'jhon a',
                    'Class__c' => '16' ,
                    'Roll_Number__c'=>'35',
                ]
            ]);

         return response()->json(['success' => true, 'data' => $response]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

    }

    public function edit($id){
        try{
            $response = Forrest::sobjects('student__c/'.$id,[
                'method'=>'patch',
                'body' =>[
                    'Class__c' => 1400,
                    'Roll_Number__c'=>'1001',
                ]
            ]);
           return response()->json(['success'=>true , 'data'=>$response ]);
        }catch(\Exception $e){
           return response()->json(['success'=>false,'error'=>$e->getMessage()]);
        }
    }


    public function delete($id){
        try{
           $response = Forrest::sobjects('student__c/'.$id ,[
            'method'=>'delete'
           ]);
           return response()->json(['success'=>true , 'data' => $response ]);
        }catch(\Exception $e){
           return response()->json(['success'=>false , 'error' => $e->getMessage()]);
        }
    }
}

