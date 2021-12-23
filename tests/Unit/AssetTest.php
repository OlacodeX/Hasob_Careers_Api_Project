<?php

namespace Tests\Unit;

use Tests\TestCase; 
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Asset;
class AssetTest extends TestCase
{
     use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_can_list_productss() {
        $assets = factory(Asset::class, 2)->create();

        $this->get(route('allProducts'))
            ->assertStatus(200);
    }
    
    public function test_can_create_product() {

        $data = [
                    
                'type' => 'New',
                'serialNumber' => 'mn23838733',
                'description' => 'Product description',
                'fixed_movable' => 'Yes',
                'picture_path' => 'https://source.unsplash.com/random',
                'purchase_date' => '2022-11-22',
                'start_use_date' =>'2022-10-10',
                'purchase_price' => '1500',
                'warranty_expiry_date' => '2022-09-10',
                'degradation_in_yeard' => '2022-12-30',
                'current_value_in_naira' => '2000',
                'location' => 'Nigeria'
        ];
          $this->json('POST', 'api/products/create', $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                    'id',
                    'type',
                    'serialNumber',
                    'description',
                    'fixed_movable',
                    'picture_path',
                    'purchase_date',
                    'start_use_date',
                    'purchase_price',
                    'warranty_expiry_date',
                    'degradation_in_yeard',
                    'current_value_in_naira',
                    'location'
                ]
            ]); 
        }
        
    public function test_can_update_product() {

        $asset = factory(Asset::class)->create();

        $data = [
             
                'type' => 'New',
                'serialNumber' => 'mn23838733',
                'description' => 'Product description',
                'fixed_movable' => 'Yes',
                'picture_path' => 'https://source.unsplash.com/random',
                'purchase_date' => '2022-11-22',
                'start_use_date' =>'2022-10-10',
                'purchase_price' => '1500',
                'warranty_expiry_date' => '2022-09-10',
                'degradation_in_yeard' => '2022-12-30',
                'current_value_in_naira' => '2000',
                'location' => 'Nigeria'
        ];
            $this->put(route('updateProduct', $asset->id), $data, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                "data" => [
                   'id',
                    'type',
                    'serialNumber',
                    'description',
                    'fixed_movable',
                    'picture_path',
                    'purchase_date',
                    'start_use_date',
                    'purchase_price',
                    'warranty_expiry_date',
                    'degradation_in_yeard',
                    'current_value_in_naira',
                    'location'
                ]
            ]);  
    }

    public function test_can_show_product() {

        $asset = factory(Asset::class)->create();

        $this->get(route('particularProduct', $asset->id))
            ->assertStatus(200);
    }

    public function test_can_delete_product() {

        $asset = factory(Asset::class)->create();

        $this->delete(route('removeProduct', $asset->id))
            ->assertStatus(204);
    }
}
