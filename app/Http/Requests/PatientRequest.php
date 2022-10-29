<?php

namespace App\Http\Requests;

use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => 'required|min:3',
            'birthdate' => 'date',
        ];
    }

    public function updateOrCreate(Patient $patient)
    {
        $patient->name = $this->name;
        $patient->birthdate = $this->birthdate;
        $patient->job = $this->job;
        $patient->address = $this->address;
        $patient->phone = $this->phone;
        $patient->notes = $this->notes;

        $patient->save();

        return $patient;
    }
}
