<?php

namespace App\Http\Requests\Admin\Master\Sla;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceLevelAgreementRequest extends FormRequest
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
            'name'          => ['required', 'string', 'max:255', Rule::unique('service_level_agreements', 'name')],
            'description'   => ['required', 'string', 'max:255'],
            'target'        => ['required', 'integer'],
        ];
    }
}
