<?php

namespace Tests\Unit;

use Tests\TestCase; 
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Assignment; 

class AssignmentTest extends TestCase
{
      use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_list_assignments() {
        $assignment= factory(Assignment::class, 2)->create();

        $this->get(route('allAssignments'))
            ->assertStatus(200);
    }
    
    public function test_can_create_assignment() {

        $data = [
                    
                'asset_id' => '3',
                'assignment_date' => '2022-11-22',
                'status' => 'Ok',
                'is_due' => 'Yes',
                'due_date' => '2022-12-21',
                'assigned_user_id' => '1',
                'assigned_by' =>'2'
        ];
          $this->json('POST', 'api/assignments/create', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'asset_id',
                    'assignment_date',
                    'status',
                    'is_due',
                    'due_date',
                    'assigned_user_id',
                    'assigned_by' 
                ]
            ]); 
        }
        
    public function test_can_update_assignment() {

        $assignment= factory(Assignment::class)->create();

        $data = [
             
                 'asset_id' => '3',
                'assignment_date' => '2022-11-22',
                'status' => 'Ok',
                'is_due' => 'Yes',
                'due_date' => '2022-12-21',
                'assigned_user_id' => '1',
                'assigned_by' =>'2'
        ];
            $this->put(route('updateAssignment', $assignment->id), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                   'id',
                    'asset_id',
                    'assignment_date',
                    'status',
                    'is_due',
                    'due_date',
                    'assigned_user_id',
                    'assigned_by' 
                ]
            ]);  
    }

    public function test_can_show_assignment() {

        $assignment= factory(Assignment::class)->create();

        $this->get(route('particularAssignment', $assignment->id))
            ->assertStatus(200);
    }

    public function test_can_delete_assignment() {

       $assignment= factory(Assignment::class)->create();

        $this->delete(route('removeAssignment', $assignment->id))
            ->assertStatus(204);
    }
}
