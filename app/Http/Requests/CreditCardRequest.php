<?php

namespace App\Http\Requests;

use LVR\CreditCard\{CardCvc, CardNumber, CardExpirationYear, CardExpirationMonth};
use Illuminate\Foundation\Http\FormRequest;

class CreditCardRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' => ['required', new CardNumber],
            'card_holdername' => 'required|string|max:255',
            'card_expiry_mm' => ['required', new CardExpirationMonth($this->get('card_expiry_yy'))],
            'card_expiry_yy' => ['required', new CardExpirationYear($this->get('card_expiry_mm'))],
            'card_cvn' => ['required', new CardCvc($this->get('card_number'))],
        ];

    }
}
