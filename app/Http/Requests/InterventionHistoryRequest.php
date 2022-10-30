<?php

namespace App\Http\Requests;

use App\Models\InterventionHistory;
use Illuminate\Foundation\Http\FormRequest;

class InterventionHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'patient_id' => 'numeric|exists:patients,id',
            'tooths' => 'json',
            'total_amount' => 'numeric',
        ];
    }

    public function updateOrCreate(InterventionHistory $history)
    {
        $history->intervention_id = $this->intervention_id;
        $history->tooths = $this->tooth;
        $history->description = $this->description;

        return $history->save();
    }
}
