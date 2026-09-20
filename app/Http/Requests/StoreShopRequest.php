<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'                     => ['required', 'string', 'max:255'],
            'normal_print_price'       => ['required', 'numeric', 'min:0'],
            'color_print_price'        => ['required', 'numeric', 'min:0'],
            'double_sided_print_price' => ['required', 'numeric', 'min:0'],
        ];
    }
}