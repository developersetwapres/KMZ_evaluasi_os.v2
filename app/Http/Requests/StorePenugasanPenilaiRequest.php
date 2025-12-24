<?php

namespace App\Http\Requests;

use App\Models\PenugasanPenilai;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePenugasanPenilaiRequest extends FormRequest
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
            'atasan' => ['required', 'uuid', 'exists:master_pegawais,uuid'],
            'penerima_layanan' => ['required', 'uuid', 'exists:master_pegawais,uuid'],
            'teman' => ['required', 'uuid', 'exists:outsourcings,uuid'],
        ];
    }

    public function messages(): array
    {
        return [
            'atasan.required' => 'Penilai atasan wajib dipilih.',
            'atasan.uuid' => 'Format penilai atasan tidak valid.',
            'atasan.exists' => 'Penilai atasan tidak ditemukan.',

            'penerima_layanan.required' => 'Penilai penerima layanan wajib dipilih.',
            'penerima_layanan.uuid' => 'Format penilai penerima layanan tidak valid.',
            'penerima_layanan.exists' => 'Penilai penerima layanan tidak ditemukan.',

            'teman.required' => 'Penilai teman wajib dipilih.',
            'teman.uuid' => 'Format penilai teman tidak valid.',
            'teman.exists' => 'Penilai teman tidak ditemukan.',
        ];
    }
}
