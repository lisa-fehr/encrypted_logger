<?php

namespace App\Http\Controllers;

use App\Models\ConcernTag;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TagController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function show(Tag $tag)
    {
        return view('tag.show', ['tag' => $tag]);
    }

    function store(Request $request) : \Illuminate\Http\RedirectResponse
    {
        Tag::create($request->input());
        return back()->with('status', 'Created');
    }

    function update(Request $request, Tag $tag) : \Illuminate\Http\RedirectResponse
    {
        $tag->update($request->input());
        return back()->with('status', 'Updated');
    }

    function delete(Tag $tag) : \Illuminate\Http\RedirectResponse
    {
        ConcernTag::where('tag_id', $tag->id)->delete();

        $tag->delete();
        return back()->with('status', 'Deleted');
    }
}
