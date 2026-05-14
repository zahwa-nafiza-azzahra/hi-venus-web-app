<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'field_id'     => ['required', 'exists:fields,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'slot_hours'   => ['required', 'array', 'min:1'],
            'slot_hours.*' => ['integer', 'min:8', 'max:21'],
        ];
    }

    public function messages(): array
    {
        return [
            'booking_date.after_or_equal' => 'Tanggal pesanan tidak boleh di masa lalu.',
            'slot_hours.required'         => 'Silakan pilih minimal satu jam penggunaan.',
        ];
    }
}
