<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileApplication extends Model
{
    protected $fillable = ['ref_num','file_type','jofa_type','status','received_at','file_num','other_ref','rack_num','rfid','approved_by'];
}
