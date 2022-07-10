<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class FileApplication extends Model
{
    use SoftDeletes,Userstamps;

    protected $dates = ['received_at'];
    
    protected $fillable = ['ref_num','file_type','jofa_type','status','received_at','file_num','other_ref','rack_num','rfid','approved_by'];
}
