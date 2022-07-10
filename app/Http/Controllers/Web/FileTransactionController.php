<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendApplication;
use App\Traits\SelectionTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\FileTransaction;


class FileTransactionController extends Controller
{
    use SelectionTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $file_types = $this->getSelectionArray('file_types', true);
        $jofa_types = $this->getSelectionArray('jofa_types', true);
        $transaction_statuses = $this->getSelectionArray('transaction_statuses', true);
        $color_statuses = $this->getSelectionArray('color_statuses', true);
        $file_transactions = FileTransaction::join('file_applications','file_applications.id','file_transactions.file_application_id')->where('file_transactions.deleted_at',null);
        $search = $request->search;

        if($search){
            $file_transactions->where(function ($q) use ($search) {
                $q->where('file_transactions.id', "like", "%{$search}%");
                $q->orWhere('file_transactions.rfid', 'like', "%{$search}%");
                $q->orWhere('file_applications.ref_num', 'like', "%{$search}%");
            });
        }

        $file_transactions = $file_transactions->orderBy('file_transactions.created_at','desc')->select('file_transactions.*')->paginate(15);

        if ($search) {
            $file_transactions->appends(['search' => $search]);
        }


        return view('file_transaction.list', compact('file_types', 'jofa_types', 'transaction_statuses', 'color_statuses', 'file_transactions'));
    }
}
