<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;
use App\Category;
use Illuminate\Http\Request;
class CategoryValidate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $categories = Category::where('parent_id', "=", 0)->pluck('id')->toArray();
        //$category = Request::get('id');
        //dd($this->id);
        return [
            'name' => "bail|required|min:3|max:20|unique:categories,name,".$this->id,
            'parent_id' => ["bail",
                            function ($attribute, $value, $fail) use ($categories)  {
                                if(!in_array($value, $categories)){
                                    return $fail(" $attribute không tồn tại");
                                } 
                            },
                            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Không được để trống tên danh mục",
            'name.unique' => "Không được trùng tên tên danh mục",
            'name.min' => "Tên danh mục không được nhỏ hơn :min",
            'name.max' => "Tên danh mục không được lớn hơn :max",
            'parent_id.required' => "Không được để trống danh mục",
            'parent_id.numeric' => "Danh mục phải là số",
        ];
    }
}
