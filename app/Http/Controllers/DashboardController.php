<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Intervention;
use App\Models\Patient;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'patients_count' => Patient::count(),
            'interventions_count' => Intervention::count()
        ];
    }

}
