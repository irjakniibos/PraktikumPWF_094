<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $ownerRule = Rule::exists('users', 'id');

        if ($this->user()?->role !== 'admin') {
            $ownerRule = Rule::exists('users', 'id')->where(fn ($query) => $query->where('role', '!=', 'admin'));
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'quantity' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'numeric', 'min:0'],
            'user_id' => ['required', $ownerRule],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'quantity.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'quantity.min' => 'Jumlah produk tidak boleh kurang dari 0.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
            'price.min' => 'Harga produk tidak boleh kurang dari 0.',

            'user_id.required' => 'Pemilik produk wajib dipilih.',
            'user_id.exists' => 'Pemilik yang dipilih tidak valid atau tidak diizinkan.',
        ];
    }
}