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
            'intervention_id' => 'numeric|exists:interventions,id',
            'teeth' => 'array',
        ];
    }

    public function updateOrCreate(InterventionHistory $history)
    {
        $history->intervention_id = $this->intervention_id;
        $history->teeth = json_encode($this->teeth);
        $history->description = $this->description;

        return $history->save();
    }
}
