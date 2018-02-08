<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class column extends FormRequest
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
        return [
            'name'=>'required',//required不能为空
            'type'=>'required',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'=>'栏目名称',
            'type'=>'栏目类型',
        ];
    }

    /**
     * 定义字段名中文
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'tag_ids.required'=>'必须选择标签',
            'name.required'=>'栏目名称不能为空',
            'type.required'=>'栏目类型不能为空'
        ];
    }
}
