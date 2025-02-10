<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'transaction_from'      => ['nullable', 'date'],
            'transaction_to'        => ['nullable', 'date'],
            'transaction_type'      => ['nullable', 'in:customer,partner'],
            'delivery_type'         => ['nullable', 'in:cod,non cod'],
            'transaction_status'    => ['nullable', 'in:pending,on delivery,success,failed'],
            'partner_name'          => ['nullable', 'string'],
            'sender_name'           => ['nullable', 'string'],
            'receiver_name'         => ['nullable', 'string'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'transaction_type'      => $this->convertType($this->transaction_type),
            'delivery_type'         => $this->convertDeliveryType($this->delivery_type),
            'transaction_status'    => $this->convertStatus($this->transaction_status),
        ]);
    }

    private function convertType($type)
    {
        switch ($type) {
            case "0":
                return 'customer';
                break;
            case "1":
                return 'partner';
                break;
            default:
                return null;
                break;
        }
    }

    private function convertDeliveryType($deliveryType)
    {
        switch ($deliveryType) {
            case "0":
                return 'cod';
                break;
            case "1":
                return 'non cod';
                break;
            default:
                return null;
                break;
        }
    }

    private function convertStatus($status)
    {
        switch ($status) {
            case "0":
                return 'pending';
                break;
            case "1":
                return 'on delivery';
                break;
            case "2":
                return 'success';
                break;
            case "3":
                return 'failed';
                break;
            default:
                return null;
                break;
        }
    }
}
