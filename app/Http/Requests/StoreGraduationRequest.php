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
        return true; // Wajib true agar user bisa submit
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // KITA HAPUS validasi nik, phone, address dari sini
            // Karena inputnya tidak ada di form HTML.
            // Data dummy-nya nanti diurus oleh Controller.
            
            'parent_name'  => 'required|string|max:255',
            'toga_size'    => 'required|in:S,M,L,XL,XXL',
            'ipk'          => 'required|numeric|between:0.00,4.00',
            'ips'          => 'required|numeric|between:0.00,4.00', // Wajib diisi sesuai form
            'thesis_title' => 'required|string|max:500',
        ];
    }
}