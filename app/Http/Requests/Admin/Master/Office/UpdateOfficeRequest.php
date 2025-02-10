<?php

namespace App\Http\Requests\Admin\Master\Office;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeRequest extends FormRequest
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
            'parent_id' => ['nullable', 'exists:offices,id'],
            'code'      => ['required', 'string', 'max:255', Rule::unique('offices', 'code')->ignore($this->office->id)],
            'name'      => ['required', 'string', 'max:255'],
            'region'    => ['required', 'string', 'max:255'],
            'type'      => ['required', 'string', 'max:255', 'in:KCU,KC,KCP'],
            'address'   => ['required', 'string', 'max:255'],
            'zip_code'  => ['required', 'string', 'max:255'],
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
                return 'KCU';
                break;
            case 1:
                return 'KC';
                break;
            default:
                return 'KCP';
                break;
        }
    }
}
