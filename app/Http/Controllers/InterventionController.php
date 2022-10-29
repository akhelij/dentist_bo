<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Intervention;
use App\Models\Patient;

class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient)
    {
        return $patient->interventions;
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
     * @param  \App\Models\Patient  $patient
     * @param  \App\Http\Requests\InterventionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterventionRequest $request)
    {
        return $request->updateOrCreate(new Intervention());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function show(Intervention $intervention)
    {
        return $intervention;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function edit(Intervention $intervention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InterventionRequest  $request
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function update(InterventionRequest $request, Intervention $intervention)
    {
        return $request->updateOrCreate($intervention);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Intervention  $intervention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Intervention $intervention)
    {
        return $intervention->delete();
    }
}
