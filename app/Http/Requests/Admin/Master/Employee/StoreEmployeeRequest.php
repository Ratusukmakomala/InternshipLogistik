<?php

namespace App\Http\Requests\Admin\Master\Employee;

use App\Models\User;
use App\Models\Employee;
use App\Models\Role;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email:dns', 'max:255', Rule::unique(User::class)],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id'   => ['required', 'exists:roles,id'],
            'code'      => ['required', 'string', Rule::unique(Employee::class)]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'role_id' => Role::findByName('admin')->id,
        ]);
    }
}
