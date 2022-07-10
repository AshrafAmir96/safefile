<?php

namespace App\Http\Controllers\Web;

use App\FileApplication;
use App\FileTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendApplication;
use App\Traits\SelectionTrait;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FileApplicationController extends Controller
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
        $statuses = $this->getSelectionArray('statuses', true);
        $color_statuses = $this->getSelectionArray('color_statuses', true);
        $file_applications = FileApplication::where('deleted_at', null);
        $search = $request->search;
        $status = $request->status;

        if ($search) {
            $file_applications->where(function ($q) use ($search) {
                $q->where('ref_num', "like", "%{$search}%");
                $q->orWhere('rack_num', 'like', "%{$search}%");
                $q->orWhere('file_num', 'like', "%{$search}%");
                $q->orWhere('other_ref', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $file_applications->where(function ($q) use ($status) {
                $q->where('status', $status);
            });
        }

        $file_applications = $file_applications->paginate(15);

        if ($search) {
            $file_applications->appends(['search' => $search]);
        }

        if ($status) {
            $file_applications->appends(['status' => $status]);
        }


        return view('file_application.list', compact('file_types', 'jofa_types', 'statuses', 'color_statuses', 'file_applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Intialize new Application
        $file_application = FileApplication::create();

        return redirect()->route('file_application.edit', $file_application->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function show(FileApplication $file_application)
    {
        $file_types = $this->getSelectionArray('file_types', true);
        $jofa_types = $this->getSelectionArray('jofa_types', true);
        $statuses = $this->getSelectionArray('statuses', true);
        $color_statuses = $this->getSelectionArray('color_statuses', true);


        return view('file_application.view', compact('file_types', 'jofa_types', 'statuses', 'file_application', 'color_statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(FileApplication $file_application)
    {
        if ($file_application->status !== 1) {
            return redirect()->route('file_application.show', $file_application->id)
                ->withErrors(trans('app.file_application_cannot_update'));
        }

        $file_types = $this->getSelectionArray('file_types', true);
        $jofa_types = $this->getSelectionArray('jofa_types', true);
        $statuses = $this->getSelectionArray('statuses', true);
        $color_statuses = $this->getSelectionArray('color_statuses', true);


        return view('file_application.edit', compact('file_types', 'jofa_types', 'statuses', 'file_application', 'color_statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileApplication $file_application)
    {
        $request->validate([
            'jofa_type' => 'required_if:file_type,2',
        ]);

        switch ($request->action) {
            case 'save':
                $file_application->update([
                    'file_type' => $request->file_type,
                    'jofa_type' => $request->jofa_type ? $request->jofa_type : null,
                    'file_num'  => $request->file_num,
                    'other_ref' => $request->other_ref,
                ]);

                return redirect()->route('file_application.index')
                    ->withSuccess(trans('app.file_application_update_success'));

                break;

            case 'delete':
                $file_application->delete();

                return redirect()->route('file_application.index')
                    ->withSuccess(trans('app.application_success_delete'));
                break;

            case 'send':
                $file_application->update([
                    'file_type' => $request->file_type,
                    'jofa_type' => $request->jofa_type ? $request->jofa_type : null,
                    'file_num'  => $request->file_num,
                    'other_ref' => $request->other_ref,
                    'status' => 2,
                ]);

                //Notify user by In System Notification
                $notification_data = [];
                $notification_data['message'] = 'app.application_submitted';
                $notification_data['icon'] = 'fas fa-file';
                $notification_data['color'] = 'bg-primary';
                $notification_data['url'] = route('file_application.show', $file_application->id);

                $admins = User::where('role_id', 1)->get();

                foreach ($admins as $admin) {
                    $admin->notify(new SendApplication($notification_data));
                }

                return redirect()->route('file_application.index')
                    ->withSuccess(trans('app.file_application_send_success'));
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileApplication $file_application)
    {
        $file_application->delete();

        return redirect()->route('file_application.index')
            ->withSuccess(trans('app.application_success_delete'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function approveForm(FileApplication $file_application)
    {
        if ($file_application->status !== 2) {
            return redirect()->route('file_application.show', $file_application->id)
                ->withErrors(trans('app.file_application_cannot_update'));
        }

        $file_types = $this->getSelectionArray('file_types', true);
        $jofa_types = $this->getSelectionArray('jofa_types', true);
        $statuses = $this->getSelectionArray('statuses', true);
        $color_statuses = $this->getSelectionArray('color_statuses', true);



        return view('file_application.approve', compact('file_types', 'jofa_types', 'statuses', 'file_application', 'color_statuses'));
    }

    public function approve(Request $request, FileApplication $file_application)
    {
        switch ($request->action) {
            case 'approve':
                $request->validate([
                    'received_at' => 'required',
                ]);

                $file_application->update([
                    'status' => 3,
                    'received_at' => Carbon::parse($request->received_at),
                    'rack_num' => Str::random(6),
                    'approved_by' => auth()->user()->id,
                ]);

                //Notify user by In System Notification
                $notification_data = [];
                $notification_data['message'] = 'app.application_approved';
                $notification_data['icon'] = 'fas fa-check';
                $notification_data['color'] = 'bg-success';
                $notification_data['url'] = route('file_application.show', $file_application->id);

                $user = User::where('id', $file_application->created_by)->first();
                $user->notify(new SendApplication($notification_data));

                return redirect()->route('file_application.show', $file_application->id)
                    ->withSuccess(trans('app.file_application_update_success'));

                break;

            case 'reject':
                $file_application->update([
                    'status' => 4,
                ]);

                //Notify user by In System Notification
                $notification_data = [];
                $notification_data['message'] = 'app.application_rejected';
                $notification_data['icon'] = 'fas fa-x';
                $notification_data['color'] = 'bg-danger';
                $notification_data['url'] = route('file_application.show', $file_application->id);

                $user = User::where('id', $file_application->created_by)->first();
                $user->notify(new SendApplication($notification_data));

                return redirect()->route('file_application.index')
                    ->withSuccess(trans('app.application_success_delete'));
                break;
        }
    }

    public function fileOut(FileApplication $file_application)
    {
        $rfid = Str::random(10);
        $file_transaction = FileTransaction::create([
            'id'=> Str::uuid(),
            'file_num' => $file_application->file_num,
            'rack_num' => $file_application->rack_num,
            'rfid' => $rfid ,
            'file_application_id' => $file_application->id,
            'trx_type' => "out",
        ]);

        $file_application->update([
            'file_transaction_id' => $file_transaction->id,
            'rfid' => $rfid,
            'status'=> 5,
        ]);

        //Notify user by In System Notification
        $notification_data = [];
        $notification_data['message'] = 'app.file_has_been_issued';
        $notification_data['icon'] = 'fa-solid fa-arrow-right-from-bracket';
        $notification_data['color'] = 'bg-success';
        $notification_data['url'] = route('file_application.show', $file_application->id);

        $user = User::where('id', $file_application->created_by)->first();
        $user->notify(new SendApplication($notification_data));

        return redirect()->route('file_application.show',$file_application->id)
                    ->withSuccess(trans('app.file_has_been_issued'));
    }

    public function fileIn(FileApplication $file_application)
    {
        $rfid = $file_application->rfid;
        $file_transaction = FileTransaction::create([
            'id'=> Str::uuid(),
            'file_num' => $file_application->file_num,
            'rack_num' => $file_application->rack_num,
            'rfid' => $rfid ,
            'file_application_id' => $file_application->id,
            'trx_type' => "in",
        ]);

        $file_application->update([
            'file_transaction_id' => $file_transaction->id,
            'status'=> 6,
        ]);

        //Notify user by In System Notification
        $notification_data = [];
        $notification_data['message'] = 'app.file_has_been_returned';
        $notification_data['icon'] = 'fa-solid fa-arrow-right-to-bracket';
        $notification_data['color'] = 'bg-success';
        $notification_data['url'] = route('file_application.show', $file_application->id);

        $user = User::where('id', $file_application->created_by)->first();
        $user->notify(new SendApplication($notification_data));

        return redirect()->route('file_application.show',$file_application->id)
                    ->withSuccess(trans('app.file_has_been_returned'));
    }

    
}
