<?php

namespace App\Http\Requests;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'intervention_id' => 'integer|exists:interventions,id',
            'amount' => 'numeric',
        ];
    }

    public function updateOrCreate(Payment $payment)
    {
        $payment->intervention_id = $this->intervention_id;
        $payment->amount = $this->amount;

        return $payment->save();
    }
}
