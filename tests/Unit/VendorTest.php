<?php

namespace Tests\Unit;

use Tests\TestCase; 
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Vendor; 

class VendorTest extends TestCase
{
  
    use RefreshDatabase;
    public function test_can_create_vendor() {

        $data = [
            
           'firstName' => 'Olawale',
           'category' => 'Fashion' 
        ];
          $this->json('POST', 'api/vendors/create', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'name',
                    'category' 
                ]
            ]); 
    }

    public function test_can_update_vendor() {

        $vendor = factory(Vendor::class)->create();

        $data = [
           'firstName' => 'Olawale',
           'category' => 'Fashion' 
        ];
            $this->put(route('updateVendor', $vendor->id), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'name',
                    'category' 
                ]
            ]);  
    }

    public function test_can_show_vendor() {

        $vendor = factory(Vendor::class)->create();

        $this->get(route('particularVendor', $vendor->id))
            ->assertStatus(200);
    }

    public function test_can_delete_vendor() {

        $vendor = factory(Vendor::class)->create();

        $this->delete(route('removeVendor', $vendor->id))
            ->assertStatus(204);
    }

    public function test_can_list_vendors() {
        $vendors = factory(Vendor::class, 2)->create();

        $this->get(route('allVendors'))
            ->assertStatus(200);
    }
}
