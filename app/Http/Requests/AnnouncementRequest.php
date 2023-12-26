<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'title' => 'required|max:20',
            'description' => 'required|max:250',
            'price' => 'required|max:30',
            'image' => 'required',
        ]; 
    }

    public function messages()
    {
        return [
            'title.required' => __('ui.titReq'),
            'title.max' => 'Il campo Titolo non può essere più lungo di :max caratteri',
            'description.required' => __('ui.desReq'),
            'price.required' => __('ui.priReq'),
            'image.required' => __('ui.tempImgReq'),
        ];
    }
}
