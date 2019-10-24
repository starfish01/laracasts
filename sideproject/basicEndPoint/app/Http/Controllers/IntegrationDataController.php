<?php

namespace App\Http\Controllers;

use App\Integration;
use App\Integration_data;
use Illuminate\Http\Request;

class IntegrationDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Integration $integration)
    {
        $attributes = request()->validate(['title' => ['required', 'min:3', 'max:255'], 'integration_id' => ['required']]);

        $attributes['owner_id'] = auth()->id();
        $attributes['description'] = '';

        $integration->addData($attributes);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Integration_data  $integration_data
     * @return \Illuminate\Http\Response
     */
    public function show(Integration $integration, Integration_data $integration_data)
    {
        //
        // dd($integration_data->id);
        return  view('layouts.integrations.show', compact('integration_data', 'integration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Integration_data  $integration_data
     * @return \Illuminate\Http\Response
     */
    public function edit(Integration_data $integration_data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Integration_data  $integration_data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Integration_data $integration_data)
    {
        $integration_data->update($request->validate([
            'description' => ['required']
        ]));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Integration_data  $integration_data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Integration_data $integration_data)
    {
        //
        $integration_data->delete();
        return redirect('/integrations');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Integration_data  $integration_data
     * @return \Illuminate\Http\Response
     */
    public function output(Integration_data $integration_data)
    {
        //
        header('Content-Type: application/json');
        echo ($integration_data->description);
    }
}
