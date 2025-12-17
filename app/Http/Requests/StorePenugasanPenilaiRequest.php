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
            'siklus_id' => [
                'required',
                'exists:siklus,id',
            ],
            'outsourcing_id' => [
                'required',
                'exists:outsourcings,id',
            ],
            'penilai_id' => [
                'nullable',
                'exists:users,id',
            ],
            'tipe_penilai' => [
                'required',
                Rule::in(['atasan', 'penerima_layanan', 'teman']),
            ],
            'bobot_penilai' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
            'status' => [
                'nullable',
                Rule::in(['completed', 'draft', 'incomplete']),
            ],
            'catatan' => [
                'nullable',
                'string',
            ],

            // mencegah duplikasi uq_penugasan
            'unique_penugasan' => [
                function ($attribute, $value, $fail) {
                    $exists = PenugasanPenilai::where('siklus_id', $this->siklus_id)
                        ->where('outsourcing_id', $this->outsourcing_id)
                        ->where('penilai_id', $this->penilai_id)
                        ->where('tipe_penilai', $this->tipe_penilai)
                        ->exists();

                    if ($exists) {
                        $fail('Penugasan penilai dengan kombinasi yang sama sudah ada.');
                    }
                }
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'siklus_id.required' => 'Siklus wajib dipilih.',
            'siklus_id.exists' => 'Siklus tidak valid.',

            'outsourcing_id.required' => 'Pegawai outsourcing wajib dipilih.',
            'outsourcing_id.exists' => 'Pegawai outsourcing tidak valid.',

            'penilai_id.exists' => 'Penilai yang dipilih tidak valid.',

            'tipe_penilai.required' => 'Tipe penilai wajib dipilih.',
            'tipe_penilai.in' => 'Tipe penilai tidak valid.',

            'bobot_penilai.numeric' => 'Bobot penilai harus berupa angka.',
            'bobot_penilai.min' => 'Bobot penilai minimal 0.',
            'bobot_penilai.max' => 'Bobot penilai maksimal 100.',

            'status.in' => 'Status penugasan tidak valid.',

            'catatan.string' => 'Catatan harus berupa teks.',
        ];
    }
}
