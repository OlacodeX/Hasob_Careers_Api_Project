<?php

namespace App\Http\Controllers;
use App\Asset;
use Illuminate\Http\Request;
use App\Http\Resources\AssetsResource;
use App\Events\AssetAdded;

class AssetsController extends Controller
{
    //
    public function allProducts(){
        $assets = Asset::paginate(10);
        if (count($assets) < 1) {
           return  response([
               'message' => 'No records found in the database!'
           ]);
        } else {
            return AssetsResource::collection($assets);
        }
        

    }


    
    public function getParticularProduct($id)
    {
        //
         $asset = Asset::findOrFail($id);
         return new AssetsResource($asset);
    } 

    public function create(Request $request){
       $this->validate($request, [
           'type' => 'required',
           'serialNumber' => 'required', 
            'description' => 'required',
           'fixed_movable' => 'required',
           'picture_path' => 'required', 
            'purchase_date' => 'required',
           'start_use_date' => 'required',
           'warranty_expiry_date' => 'required', 
            'degradation_in_yeard' => 'required',
           'current_value_in_naira' => 'required',
           'location' => 'required', 
           'purchase_price' => 'required' 
            ]);
        $asset = new Asset();
        $asset->type = $request->type;
        $asset->serialNumber = $request->serialNumber;
        $asset->description = $request->description;
        $asset->fixed_movable = $request->fixed_movable;
        $asset->picture_path = $request->picture_path;
        $asset->purchase_date = $request->purchase_date;
        $asset->start_use_date = $request->start_use_date;
        $asset->warranty_expiry_date = $request->warranty_expiry_date;
        $asset->degradation_in_yeard = $request->degradation_in_yeard;
        $asset->current_value_in_naira = $request->current_value_in_naira;
        $asset->location = $request->location;
        $asset->purchase_price = $request->purchase_price;  
        if ($asset->save()) {
            event(new AssetAdded($asset));
           return new AssetsResource($asset);
        }
    }
    public function update(Request $request, $id){
        $asset = Asset::findOrFail($id);
        $asset->type = $request->type;
        $asset->serialNumber = $request->serialNumber;
        $asset->description = $request->description;
        $asset->fixed_movable = $request->fixed_movable;
        $asset->picture_path = $request->picture_path;
        $asset->purchase_date = $request->purchase_date;
        $asset->start_use_date = $request->start_use_date;
        $asset->warranty_expiry_date = $request->warranty_expiry_date;
        $asset->degradation_in_yeard = $request->degradation_in_yeard;
        $asset->current_value_in_naira = $request->current_value_in_naira;
        $asset->location = $request->location;
        $asset->purchase_price = $request->purchase_price;  
        if ($asset->save()) {
           return new AssetsResource($asset);
        }

    }
    public function destroy($id)
    {
        //
         $asset = Asset::findOrFail($id);
        if ($asset->delete()) {
           return new AssetsResource($asset);
        }
    }
}
