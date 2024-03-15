<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ConcernTagController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function store(Request $request, ?Concern $concern, ?Tag $tag) : \Illuminate\Http\RedirectResponse
    {
        if (!$concern->exists) {
            $concern = Concern::find($request->input('concern'));
        }
        if (!$tag->exists) {
            $tag = $request->input('tag');
        }

        $concern->tags()->syncWithoutDetaching($tag);
        return back()->with('status', 'Updated');
    }

    function delete(Request $request, Concern $concern, Tag $tag) : \Illuminate\Http\RedirectResponse
    {
        $concern->tags()->delete($tag);
        return back()->with('status', 'Deleted');
    }
}
