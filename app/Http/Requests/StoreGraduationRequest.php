<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGraduationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // GANTI DARI 'false' MENJADI 'true'
        // Ini mengizinkan semua user yang sudah login
        // untuk mencoba mengirimkan form ini.
        // Logika semester kita sudah ada di Controller, jadi di sini aman.
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
            'parent_name' => 'required|string|max:255',
            'toga_size' => 'required|string|in:S,M,L,XL,XXL', // Pastikan nilainya hanya ini
            'ipk' => 'required|numeric|between:0,4.00', // IPK harus angka antara 0-4
            'ips' => 'required|numeric|between:0,4.00', // IPS harus angka antara 0-4
        ];
    }
}

