<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Resources\VendorResource;
use App\Events\VendorEvent;

class VendorController extends Controller
{
    
    public function index()
    {
        //
        
        $vendors = Vendor::paginate(10);
        if (count($vendors) < 1) {
           return  response([
               'message' => 'No records found in the database'
           ]);
        } else {
            return VendorResource::collection($vendors);
        }
        
    }
 
    public function create(Request $request)
    {
        //
         $this->validate($request, [
           'name' => 'required',
           'category' => 'required' 
            ]);
        $vendor = new Vendor();
        $vendor->name = $request->input('name');
        $vendor->category = $request->input('category'); 
        if ($vendor->save()) {
            event(new VendorEvent($vendor));
           return new VendorResource($vendor);
        }
    }
 
    public function show($id)
    {
        //
        $vendor = Vendor::findOrFail($id);
        if (!empty($vendor)) {
              return new VendorResource($vendor);
        }  else {
           return  response([
               'message' => 'Vendor not found'
           ]);
         }
    }
 
 
    public function update(Request $request, $id)
    {
        // 
        $vendor = Vendor::findOrFail($id);
        $vendor->name = $request->input('name');
        $vendor->category = $request->input('category'); 
        if ($vendor->save()) {
           return (new VendorResource($vendor))->response()->setStatusCode(201);
        }
    }
 
    public function destroy($id)
    {
        //
         $vendor = Vendor::findOrFail($id);
        if ($vendor->delete()) {
           return (new VendorResource($vendor))->response()->setStatusCode(204);
        }
    }
}
