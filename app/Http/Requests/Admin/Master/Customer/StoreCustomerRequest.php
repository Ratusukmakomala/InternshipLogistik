<?php

namespace App\Http\Requests\Admin\Master\Customer;

use App\Models\Role;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'code'      => ['required', 'string', 'max:255', Rule::unique(Customer::class)],
            'name'      => ['required', 'string', 'max:255'],
            'phone'     => ['required', 'string', 'max:15'],
            'address'   => ['required', 'string'],
            'zip_code'  => ['required', 'string', 'max:10'],
            'type'      => ['required', 'string'],
            'email'     => ['required', 'string', 'lowercase', 'email:dns', 'max:255', Rule::unique(User::class)],
            'password'  => ['required', 'confirmed', Password::defaults()],
            'role_id'   => ['required', 'exists:roles,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'role_id' => Role::findByName('mitra')->id,
        ]);
    }
}
