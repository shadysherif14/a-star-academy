<?php

namespace App\Http\Requests;

use App\Rules\AuthPassword;
use LVR\CreditCard\CardCvc;

use LVR\CreditCard\CardNumber;
use Illuminate\Validation\Rule;
use LVR\CreditCard\CardExpirationDate;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
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
            'number' => ['required', new CardNumber],
            'name' => 'required|string|max:255',
            'date' => ['required'],
            'month' => ['required', new CardExpirationMonth($this->get('year'))],
            'year' => ['required', new CardExpirationYear($this->get('month'))],
            'cv' => ['required', new CardCvc($this->get('number'))],
            'type' => ['required', Rule::in(['unlimited', 'one'])],
            'password' => ['required', new AuthPassword]
        ];

    }
}
