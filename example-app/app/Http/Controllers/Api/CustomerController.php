<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        if ($customers->count() > 0){

            return response()->json([
                'status' => 200,
                'customers' => $customers
    
            ], 200);

        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No records Found'
    
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9',
        ]);

        if($validator->fails()){

            return response()->json([

                'status' => 422,
                'errors' => $validator->errors()

            ], 422);

        }else{

            $customer = Customer::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if($customer){

               return response()->json([
                'status' => 200,
                'message' => "Customer Created Successfully"
               ],200);
                
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                   ],500);
            }

        }

    }

    public function show($id)
    {

        $customer = Customer::find($id);
        if($customer){
            
            return response()->json([
                'status' => 200,
                'customer' => $customer
    
            ], 200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Customer Found!"
               ],404);
        }

    }


    public function edit($id){
        $customer = Customer::find($id);
        if($customer){
            
            return response()->json([
                'status' => 200,
                'customer' => $customer
    
            ], 200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Customer Found!"
               ],404);
        }


    }

    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'surname' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9',
        ]);

        if($validator->fails()){

            return response()->json([

                'status' => 422,
                'errors' => $validator->errors()

            ], 422);

        }else{
            $customer = Customer::find($id);

     

            if($customer){
                $customer -> update([
                    'name' => $request->name,
                    'surname' => $request->surname,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
               return response()->json([
                'status' => 200,
                'message' => "Customer Updated Successfully"
               ],200);
                
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Customer Found!"
                   ],404);
            }

        }

    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if($customer){

            $customer->delete();

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Customer Found!"
               ],404);
        }
    }
}


