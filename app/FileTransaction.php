<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class FileTransaction extends Model
{
    use SoftDeletes,Userstamps;

    protected $casts = [
        'id' => 'string'
    ];

    protected $fillable = ['id','file_num','rack_num','rfid','file_application_id','trx_type'];

    public function file_application()
    {
        return $this->belongsTo(FileApplication::class);
    }
}
