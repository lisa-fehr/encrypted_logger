<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessImage;
use App\Models\Concern;
use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ConcernController extends BaseController
{

    use AuthorizesRequests, ValidatesRequests;

    function show(Concern $concern)
    {
        $additional_concerns = $concern->observation->concerns()->whereNot('id', $concern);

        return view('concern.show', ['concern' => $concern, 'additional_concerns' => $additional_concerns]);
    }

    function store(Request $request) : \Illuminate\Http\RedirectResponse
    {
        if($this->hasFileError($request)) {
            return back()
                ->withInput($request->input())
                ->withErrors(['msg' => 'File is too large. Max is:'. ini_get("upload_max_filesize")]);
        }

        $concern = Concern::create(
            $request->except('files')
        );

        if($request->hasFile('files')) {
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().'-'.$file->getClientOriginalName();

                Photo::create([
                    'img' => $fileName,
                    'concern_id' => $concern->id
                ]);

                ProcessImage::dispatch($file->path(), $fileName);
            }
        }

        return back()->with('status', 'Created');
    }

    function update(Request $request, Concern $concern) : \Illuminate\Http\RedirectResponse
    {

        $concern->update($request->input());
        return back()->with('status', 'Updated');
    }

    function delete(Concern $concern) : \Illuminate\Http\RedirectResponse
    {

        $concern->delete();
        return back()->with('status', 'Deleted');
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function hasFileError(Request $request) : bool
    {

        return ! empty($request->files) && ! $request->hasFile('files');
    }
}
