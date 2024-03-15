<?php

namespace App\Http\Controllers;

use App\Models\Observation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ObservationController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    function show(Observation $observation)
    {
        return view('observation.show', ['observation' => $observation]);
    }

    function store(Request $request) : \Illuminate\Http\RedirectResponse
    {
        Observation::create(
            $request->input()
        );
        return back()->with('status', 'Created');
    }

    function update(Request $request, Observation $observation) : \Illuminate\Http\RedirectResponse
    {
        $observation->update($request->input());
        return back()->with('status', 'Updated');
    }

    function delete(Observation $observation) : \Illuminate\Http\RedirectResponse
    {
        $observation->delete();
        return back()->with('status', 'Deleted');
    }
}
