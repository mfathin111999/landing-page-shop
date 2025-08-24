<?php

namespace App\Http\Requests;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $store = Store::whereHas('groups', function ($query) {
            $query->where('groups.user_id', $this->user()->id);
        })->where('id', $this->store_id)->first();
        
        return $store ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:128',
            'sku' => 'required|string|max:128',
            'sku_ref' => 'required|string|max:128',
            'variant' => 'required|string|max:128',
            'price_selling' => 'required|numeric',
            'price_cost' => 'required|numeric',
            'quantity' => 'required|numeric|max:50000',
        ];
    }
}
