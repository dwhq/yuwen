<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class url extends FormRequest
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
            'title'=>'required',//required不能为空
            'url'=>'required',
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
            'title'=>'链接名称',
            'account'=>'链接地址',
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
            'title.required'=>'链接名称不能为空',
            'account.required'=>'链接地址不能为空'
        ];
    }
}
