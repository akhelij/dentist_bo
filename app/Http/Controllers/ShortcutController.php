<?php

namespace App\Http\Controllers;

use App\Models\Shortcut;
use Illuminate\Http\Request;

class ShortcutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Shortcut::all();
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
    public function store(Request $request)
    {
        $shortcut = new Shortcut();
        $shortcut->shortcut_content = $request->shortcut_content;
        $shortcut->type = $request->type;

        return $shortcut->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shortcut  $shortcut
     * @return \Illuminate\Http\Response
     */
    public function show(Shortcut $shortcut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shortcut  $shortcut
     * @return \Illuminate\Http\Response
     */
    public function edit(Shortcut $shortcut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shortcut  $shortcut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shortcut $shortcut)
    {
        $shortcut->shortcut_content = $request->shortcut_content;
        $shortcut->save();
        return $shortcut;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shortcut  $shortcut
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shortcut $shortcut)
    {
        return $shortcut->delete();
    }
}
