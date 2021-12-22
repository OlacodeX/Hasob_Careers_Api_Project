<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $table = "assets";

    protected $fillable = ['type','serialNumber','description','fixed_movable','picture_path','purchase_date','start_use_date','purchase_price','warranty_expiry_date','degradation_in_yeard','current_value_in_naira','location'];
}
