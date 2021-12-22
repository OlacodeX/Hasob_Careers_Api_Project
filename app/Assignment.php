<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    //
    protected $table = "assigments";

    protected $fillable = ['asset_id','assignment_date','status','is_due','due_date','assigned_user_id','assigned_by'];
}
