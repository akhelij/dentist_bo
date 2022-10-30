<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionHistoryRequest;
use App\Models\Intervention;
use App\Models\InterventionHistory;

class InterventionHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Intervention $intervention)
    {
        return $intervention->history;
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
     * @param  \App\Http\Requests\InterventionHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InterventionHistoryRequest $request)
    {
        return $request->updateOrCreate(new InterventionHistory());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterventionHistory  $history
     * @return \Illuminate\Http\Response
     */
    public function show(InterventionHistory $history)
    {
        return  $history;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterventionHistory  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(InterventionHistory $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\InterventionHistoryRequest  $request
     * @param  \App\Models\InterventionHistory  $history
     * @return \Illuminate\Http\Response
     */
    public function update(InterventionHistoryRequest $request, InterventionHistory $history)
    {
        return $request->updateOrCreate($history);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterventionHistory  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterventionHistory $history)
    {
        return $history->delete();
    }
}
