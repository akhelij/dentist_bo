<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterventionRequest;
use App\Models\Appointment;
use App\Models\Intervention;
use App\Models\Patient;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            'today_appointments' => Appointment::whereDate('date', today())->with('patient')->get(),
            'appointments_count' => Appointment::count(),
            'payments_total' => Payment::all()->sum('amount'),
            'chart' => $chart
        ];
    }

    public function show($param) {
        if($param == "payment") {
            $result = Payment::select(DB::raw('MONTH(created_at) as labels, SUM(amount) as data'))->whereBetween('created_at', [now()->subYears(1), now()])->groupBy('labels')->get();
        } else {
            $model = app('App\Models\\'.Str::ucfirst($param));
            $result = $model::select(DB::raw('MONTH(created_at) as labels, COUNT(id) as data'))->whereBetween('created_at', [now()->subYears(1), now()])->groupBy('labels')->get();
        }
        // $chart['labels'] = $result->pluck('labels');
        // $chart['labels'] = array_pad($result->pluck('labels')->toArray(), -4, 0);
        $chart['labels'] = array(1, 2, 3, 4);
        $chart['data'] = array_pad($result->pluck('data')->toArray(), -4, 0);
        return [
            'status' => 'success',
            'data'   => $chart
        ];
    }
}
