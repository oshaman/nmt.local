<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->hasRole('video_editor') || \Auth::user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            $rules = [
                'token' => 'required|alpha_dash',
                'title' => ['required', 'string', 'between:4,255'],
                'outputtime' => 'date_format:"Y-m-d H:i"|nullable',
            ];

            return $rules;

        } else {
            $rules = [
                'value' => ['nullable', 'string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯІіЇіЄєёЁ0-9\-\s\,\:\?\!\.]+$#u'],
                'param' => 'nullable|digits:1',
            ];
            return $rules;
        }
    }
}
