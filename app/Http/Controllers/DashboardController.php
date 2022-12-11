<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Appointment;
use App\Models\Intervention;
use App\Models\Patient;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $result = Payment::select(DB::raw('MONTH(created_at) as labels, SUM(amount) as data'))->whereBetween('created_at', [now()->subYears(1), now()])->groupBy('labels')->get();
        $chart['labels'] = $result->pluck('labels');
        $chart['data'] = $result->pluck('data');

        return [
            'patients_count' => Patient::count(),
            'interventions_count' => Intervention::count(),
            'today_appointments' => Appointment::whereDate('date', today())->get(),
            'appointments_count' => Appointment::count(),
            'payments_total' => Payment::all()->sum('amount'),
            'chart' => $chart
        ];
    }

}
