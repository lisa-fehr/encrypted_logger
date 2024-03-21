<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    public function show(Request $request) {
        $user = $request->user();
        $observations = $user->observations()->where('active', true)->get();
        $archived_observations = $user->observations()->where('active', false)->get();
        $concerns = $user->concerns()->take(100)->get();
        $tags = $user->tags;
        $actions = $user->actions;

        $change_layout = $tags->count() > 4 && $observations->count() > 0;
        return view('home', compact(
            'change_layout',
            'user',
            'observations',
            'archived_observations',
            'concerns',
            'tags',
            'actions'
        ));
    }

}
