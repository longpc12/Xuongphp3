<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $categoryId = $this->route('id');

        return [
            'name_category' => [
                'required',
                'min:5',
                'max:255', 
                Rule::unique('categories', 'name_category')->ignore($categoryId),],
        ];
    }


    public function messages(): array
    {
        return [
            'name_category.required' => 'Tên danh mục là bắt buộc.',
            'name_category.min' => 'Tên danh mục tối thiểu là 5 ký tự',
            'name_category.max' => 'Tên danh mục không được vượt quá 255 ký tự',
            'name_category.unique' => 'Tên danh mục này đã có rồi',
        ];
    }
}
