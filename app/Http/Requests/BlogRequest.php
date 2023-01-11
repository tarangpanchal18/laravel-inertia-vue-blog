<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->method() != "POST") {
            return auth()->user()->id === $this->blog->user_id;
        }

        return auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validate = [
            'title' => ['required', 'min:5', 'max:50'],
            'description' => ['required', 'min:50', 'max:5000'],
            'status' => ['required'],
        ];

        if ($this->method() != "POST") {
            $validate['title'][] = Rule::unique('blogs')->ignore($this->blog->id);
        }

        return $validate;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.unique' => 'Please Make Unique Blog Title.',
        ];
    }


}
