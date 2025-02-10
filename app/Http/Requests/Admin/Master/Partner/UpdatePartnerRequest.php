<?php

namespace App\Http\Requests\Admin\Master\Partner;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'type' => ['required', 'string'],
            'code' => ['required', 'string'],
            'name' => ['required', 'string'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'type' => $this->convertType($this->type),
        ]);
    }

    private function convertType($type)
    {
        $newType = '';
        switch ($type) {
            case "0":
                $newType = 'marketplace';
                break;
            case "1":
                $newType = 'pemerintah';
                break;
            default:
                $newType = 'perbankan';
                break;
        }

        return $newType;
    }
}
