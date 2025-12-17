<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePenugasanPenilaiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:250',
            'jabatan_id' => 'nullable|exists:jabatans,id',
            'kode_pegawai' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('outsourcings', 'kode_pegawai')->ignore($this->outsourcing),
            ],
            'unit_kerja' => 'nullable|string|max:191',
            'status' => 'required|in:aktif,nonaktif',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'kode_pegawai.unique' => 'Kode pegawai sudah digunakan orang lain.',
        ];
    }
}
