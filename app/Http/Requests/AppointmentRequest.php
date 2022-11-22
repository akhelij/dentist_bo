<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'patient_id' => 'numeric|exists:patients,id',
            'date' => 'required|datetime'
        ];
    }

    public function updateOrCreate(Appointment $appointment)
    {
        $appointment->patient_id = $this->patient_id;
        $appointment->date = $this->date;

        $appointment->save();

        return $appointment;
    }
}
