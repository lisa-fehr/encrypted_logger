<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Photo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
        $concern = Concern::create(
            $request->except('files')
        );

        if($request->hasFile('files')) {
            $files = [];
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();
                $img = Crypt::encrypt($file->getContent());
                Storage::put($fileName, $img);
                $files[] = $fileName;
            }


            foreach ($files as $key => $file) {
                Photo::create([
                    'user_id' => $request->user()->id,
                    'img' => $file,
                    'concern_id' => $concern->id
                ]);
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
}
