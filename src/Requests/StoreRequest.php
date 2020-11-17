<?php

namespace Qihucms\Feedback\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     *sometimes
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:1000'],
            'file' => ['max:255'],
            'contact' => ['max:255']
        ];
    }

    public function attributes()
    {
        return trans('feedback::feedback');
    }
}