<?php

namespace App\Http\Controllers\Web;

use App\FileApplication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\SelectionTrait;

class FileApplicationController extends Controller
{

    use SelectionTrait;

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

        return view('file_application.list', compact('file_types', 'jofa_types', 'statuses','color_statuses','file_applications'));
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
    public function show(FileApplication $fileApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileApplication  $fileApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(FileApplication $file_application)
    {
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
        $message = null;

        switch ($request->action) {
            case 'save':
                    $file_application->update([
                        'file_type' => $request->file_type,
                        'jofa_type' => $request->jofa_type ? $request->jofa_type : null,
                    ]);

                    $message = trans('app.file_application_update_success');
                break;

            case 'delete':
                return redirect()->route('file_application.delete',$file_application->id);
                break;

            case 'send':
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
