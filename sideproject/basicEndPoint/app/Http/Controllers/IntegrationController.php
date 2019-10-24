<?php

namespace App\Http\Controllers;

use App\Integration;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('layouts.integrations.index',  [
            'Integration' => auth()->user()->integrations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.integrations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
        ]);

        $attributes['owner_id'] = auth()->id();

        Integration::create($attributes);
        return redirect('/integrations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Integration  $integration
     * @return \Illuminate\Http\Response
     */
    public function show(Integration $integration)
    {
        return view('layouts.integrations.show', compact('integration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Integration  $integration
     * @return \Illuminate\Http\Response
     */
    public function edit(Integration $integration)
    {
        return view('layouts.integrations.create', compact('integration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Integration  $integration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Integration $integration)
    {
        //

        $attributes = $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
        ]);

        $integration->update($attributes);

        return redirect('/integrations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Integration  $integration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integration $integration)
    {
        //
        $integration->delete();
        return redirect('/integrations');
    }
}
