<?php

namespace App\Http\Controllers\Web;

use App\FileApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SelectionTrait;

class FileApplicationController extends Controller
{

    use SelectionTrait;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('session.database', ['only' => ['sessions', 'invalidateSession']]);
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

        // if($request->status){

        // }

        $file_applications = FileApplication::paginate(15);

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

        return view('file_application.view', compact('file_types', 'jofa_types', 'statuses', 'file_application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(FileApplication $file_application)
    {
        if($file_application->status !== 1){
            return redirect()->route('file_application.show',$file_application->id)
            ->withErrors(trans('app.file_application_cannot_update'));
        }

        $file_types = $this->getSelectionArray('file_types', true);
        $jofa_types = $this->getSelectionArray('jofa_types', true);
        $statuses = $this->getSelectionArray('statuses', true);

        return view('file_application.edit', compact('file_types', 'jofa_types', 'statuses', 'file_application'));
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
                return redirect()->route('file_application.delete', $file_application->id);
                break;

            case 'send':
                $file_application->update([
                    'file_type' => $request->file_type,
                    'jofa_type' => $request->jofa_type ? $request->jofa_type : null,
                    'file_num'  => $request->file_num,
                    'other_ref' => $request->other_ref,
                    'status' => 2,
                ]);

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
            ->withSuccess(trans('app.role_created'));
    }
}
