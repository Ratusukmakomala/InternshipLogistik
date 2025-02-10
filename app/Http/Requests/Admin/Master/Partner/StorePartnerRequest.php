<?php

namespace App\Http\Requests\Admin\Master\Partner;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'type' => ['required', 'string', 'in:marketplace, pemerintah, perbankan'],
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
        switch ($type) {
            case 0:
                return 'marketplace';
                break;
            case 1:
                return 'pemerintah';
                break;
            default:
                return 'perbankan';
                break;
        }
    }
}
