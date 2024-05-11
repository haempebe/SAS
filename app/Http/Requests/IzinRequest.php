<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzinRequest extends FormRequest
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
            'nama'           => 'required',
            'role'           => 'required',
            'jenis_izin'     => 'required',
            'jam_mulai'      => 'nullable',
            'jam_berakhir'   => 'nullable',
            'keterangan'     => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama harus diisi',
            'role.required' => 'Role harus diisi',
            'jenis_izin.required' => 'Jenis izin harus diisi',
            'keterangan.required' => 'Keterangan harus diisi',
        ];
    }
}
