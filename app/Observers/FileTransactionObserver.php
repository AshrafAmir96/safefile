<?php

namespace App\Observers;

use App\FileTransaction;
use Illuminate\Support\Str;

class FileTransactionObserver
{


    /**
     * Handle the file transaction "created" event.
     *
     * @param  \App\FileTransaction  $fileTransaction
     * @return void
     */
    public function created(FileTransaction $file_transaction)
    {
        // $file_transaction->id = 
        // $file_transaction->save();
    }

    /**
     * Handle the file transaction "updated" event.
     *
     * @param  \App\FileTransaction  $fileTransaction
     * @return void
     */
    public function updated(FileTransaction $fileTransaction)
    {
        //
    }

    /**
     * Handle the file transaction "deleted" event.
     *
     * @param  \App\FileTransaction  $fileTransaction
     * @return void
     */
    public function deleted(FileTransaction $fileTransaction)
    {
        //
    }

    /**
     * Handle the file transaction "restored" event.
     *
     * @param  \App\FileTransaction  $fileTransaction
     * @return void
     */
    public function restored(FileTransaction $fileTransaction)
    {
        //
    }

    /**
     * Handle the file transaction "force deleted" event.
     *
     * @param  \App\FileTransaction  $fileTransaction
     * @return void
     */
    public function forceDeleted(FileTransaction $fileTransaction)
    {
        //
    }
}
