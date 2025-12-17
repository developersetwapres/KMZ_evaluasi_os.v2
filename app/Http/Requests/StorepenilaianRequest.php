<?php

namespace App\Http\Requests;

use App\Models\Penilaian;
use Illuminate\Foundation\Http\FormRequest;

class StorepenilaianRequest extends FormRequest
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
            'nilai' => [
                'required',
                'array',
                'min:1',
            ],

            'nilai.*.kriteria_id' => [
                'required',
                'integer',
                'exists:kriterias,id',
            ],

            'nilai.*.skor' => [
                'required',
                'integer',
                'min:50',
                'max:100',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nilai.required' => 'Data penilaian wajib diisi.',
            'nilai.array' => 'Format data penilaian tidak valid.',
            'nilai.min' => 'Minimal harus ada satu penilaian.',

            'nilai.*.kriteria_id.required' => 'Kriteria wajib dipilih.',
            'nilai.*.kriteria_id.integer' => 'Kriteria tidak valid.',
            'nilai.*.kriteria_id.exists' => 'Kriteria tidak ditemukan.',

            'nilai.*.skor.required' => 'Skor wajib diisi.',
            'nilai.*.skor.integer' => 'Skor harus berupa angka.',
            'nilai.*.skor.min' => 'Skor minimal adalah 50.',
            'nilai.*.skor.max' => 'Skor maksimal adalah 100.',
        ];
    }
}
