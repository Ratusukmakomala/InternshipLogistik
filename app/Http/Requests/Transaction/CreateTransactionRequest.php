<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransactionRequest extends FormRequest
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
            'shipping_form'         => ['required','string', 'max:255'],
            'type_of_goods'         => ['required','string', 'max:255'],
            'sla_id'                => ['required','integer', 'exists:service_level_agreements,id'],
            'kind_of_delivery'      => ['required','string', 'in:document, package'],
            'type'                  => ['required','string', 'in:customer, partner'],
            'delivery_type'         => ['required','string', 'in:cod, non cod'],
            'weight'                => ['required','numeric'],
            'volume'                => ['required','numeric'],
            'item_value'            => ['required','numeric'],
            'base_price'            => ['required','numeric'],
            'tax_price'             => ['required','numeric'],
            'note'                  => ['nullable','string', 'max:255'],

            // Transaction to partner
            'patner_id'             => ['required_if:type,partner','integer', 'exists:partners,id'],

            // Transaction to customer
            'sender_id'             => ['required_if:type,customer','integer', 'exists:customers,id'],
            'receiver_id'           => ['required_if:type,customer','integer', 'exists:customers,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'kind_of_delivery'  => $this->convertKindOfDeliveryType($this->kind_of_delivery),
            'type'              => $this->convertType($this->type),
            'delivery_type'     => $this->convertDeliveryType($this->delivery_type),
        ]);
    }

    private function convertKindOfDeliveryType($type)
    {
        switch ($type) {
            case 0:
                return 'document';
                break;
            default:
                return 'package';
                break;
        }
    }

    private function convertType($type)
    {
        switch ($type) {
            case 0:
                return 'customer';
                break;
            default:
                return 'partner';
                break;
        }
    }

    private function convertDeliveryType($type)
    {
        switch ($type) {
            case 0:
                return 'cod';
            default:
                return 'non cod';
        }
    }
}
