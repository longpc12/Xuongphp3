<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'slug' => 'required|max:10|unique:products,slug,' . $this->route('id'),
            'name_product' => 'required|max:100',
            'thumbnail_url' => 'image|mimes:jpg,jpeg,gif',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'nullable|numeric|lt:price_regular',
            'description' => 'nullable|string|max:255',
            'quantity' => 'nullable|integer|min:0',
            'input_day' => 'required|date',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Slug là bắt buộc.',
            'slug.max' => 'Slug không được vượt quá 10 ký tự.',
            'slug.unique' => 'Slug này đã tồn tại.',
            'name_product.required' => 'Tên sản phẩm là bắt buộc.',
            'name_product.max' => 'Tên sản phẩm không được vượt quá 100 ký tự.',
            'thumbnail_url.image' => 'Ảnh đại diện phải là một tệp hình ảnh.',
            'thumbnail_url.mimes' => 'Ảnh đại diện phải có định dạng: jpg, jpeg, hoặc gif.',
            'price_regular.required' => 'Giá gốc là bắt buộc.',
            'price_regular.numeric' => 'Giá gốc phải là một số.',
            'price_regular.min' => 'Giá gốc phải lớn hơn hoặc bằng 0.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là một số.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'description.string' => 'Mô tả phải là một chuỗi.',
            'description.max' => 'Mô tả không được vượt quá 255 ký tự.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 0.',
            'input_day.required' => 'Ngày nhập hàng là bắt buộc.',
            'input_day.date' => 'Ngày nhập hàng phải là một ngày hợp lệ.',
            'category_id.required' => 'Danh mục là bắt buộc.',
            'category_id.exists' => 'Danh mục không tồn tại.',
        ];
    }
}
