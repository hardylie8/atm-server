<?php

namespace App\Http\Requests;

class transferRequest extends baseRequest
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
            'recipientId' => ['required', 'string', 'exists:users,id'],
            'transferValue' => ['required', 'lt:currentSaldo', 'integer'],
        ];
    }
}
