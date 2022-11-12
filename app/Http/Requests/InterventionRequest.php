<?php

namespace App\Http\Requests;

use App\Http\Controllers\InterventionHistoryController;
use App\Models\Intervention;
use App\Models\Patient;
use Illuminate\Foundation\Http\FormRequest;

class InterventionRequest extends FormRequest
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
            'total_amount' => 'numeric',
            'history'   => 'sometimes'
        ];
    }

    public function updateOrCreate(Intervention $intervention)
    {
        $intervention->patient_id = $this->patient_id;
        $intervention->description = $this->description;
        $intervention->total_amount = $this->total_amount;
        $intervention->save();
        if($this->history)
        {
            $this->history->intervention_id = $intervention->id();
            InterventionHistoryController::store($this->history);
        }

        return $intervention;
    }
}
