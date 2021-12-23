<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use App\Http\Resources\AssignmentResource;

class AssignmentController extends Controller
{
   
    public function index()
    {
        //
        
        $assignments = Assignment::paginate(10);
        if (count($assignments) < 1) {
           return  response([
               'message' => 'No records found in the database'
           ]);
        } else {
            return AssignmentResource::collection($assignments);
        }
        
    }
 
    public function create(Request $request)
    {
        //
         $this->validate($request, [
           'asset_id' => 'required',
           'assignment_date' => 'required',
           'status' => 'required', 
            'is_due' => 'required',
           'due_date' => 'required',
           'assigned_user_id' => 'required', 
           'assigned_by' => 'required' 
            ]);
        $assigment = new Assignment();
        $assigment->assigned_by = $request->input('assigned_by');
        $assigment->assigned_user_id = $request->input('assigned_user_id'); 
        $assigment->due_date = $request->input('due_date');
        $assigment->is_due = $request->input('is_due'); 
        $assigment->status = $request->input('status');
        $assigment->assignment_date = $request->input('assignment_date'); 
        $assigment->asset_id = $request->input('asset_id');
        if ($assigment->save()) {
           return new AssignmentResource($assigment);
        }
    }
 
    public function show($id)
    {
        //
        $assigment = Assignment::findOrFail($id);
        if (!empty($assigment)) {
              return new AssignmentResource($assigment);
        }  else {
           return  response([
               'message' => 'Vendor not found'
           ]);
         }
    }
 
 
    public function update(Request $request, $id)
    {
        // 
        $assigment = Assignment::findOrFail($id);
        $assigment->assigned_by = $request->input('assigned_by');
        $assigment->assigned_user_id = $request->input('assigned_user_id'); 
        $assigment->due_date = $request->input('due_date');
        $assigment->is_due = $request->input('is_due'); 
        $assigment->status = $request->input('status');
        $assigment->assignment_date = $request->input('assignment_date'); 
        $assigment->asset_id = $request->input('asset_id');
        if ($assigment->save()) {
           return (new AssignmentResource($assigment))->response()->setStatusCode(201);
        }
    }
 
    public function destroy($id)
    {
        //
         $assigment = Assignment::findOrFail($id);
        if ($assigment->delete()) {
           return (new AssignmentResource($assigment))->response()->setStatusCode(204);
        }
    }
}
