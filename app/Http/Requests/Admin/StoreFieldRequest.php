<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreFieldRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'field_type_id' => 'required|exists:field_types,id',
            'name' => 'required|string|max:255',
            'price_offpeak' => 'required|numeric|min:0',
            'price_peak' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'field_type_id.required' => 'Tipe lapangan harus dipilih.',
            'field_type_id.exists' => 'Tipe lapangan tidak valid.',
            'name.required' => 'Nama lapangan harus diisi.',
            'name.max' => 'Nama lapangan maksimal 255 karakter.',
            'price_offpeak.required' => 'Harga off-peak harus diisi.',
            'price_offpeak.numeric' => 'Harga off-peak harus berupa angka.',
            'price_offpeak.min' => 'Harga off-peak tidak boleh negatif.',
            'price_peak.required' => 'Harga peak harus diisi.',
            'price_peak.numeric' => 'Harga peak harus berupa angka.',
            'price_peak.min' => 'Harga peak tidak boleh negatif.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.mimes' => 'Gambar harus bertipe: jpeg, png, jpg, gif.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
