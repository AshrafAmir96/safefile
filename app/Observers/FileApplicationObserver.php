<?php

namespace App\Observers;

use App\FileApplication;

class FileApplicationObserver
{
    public function created(FileApplication $file_application){

        $file_application->ref_num = 'PKF/'.$file_application->id;
        $file_application->save();
    }
}
