<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

abstract class baseRequest extends FormRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $currentUser = Auth::user();
        $this->merge([
            'currentSaldo' => $currentUser->saldo,
        ]);
    }
}
