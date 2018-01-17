<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (\Auth::user()->hasRole('admin')) || (\Auth::user()->hasRole('editor')) || \Auth::user()->canDo('UPDATE_POLLS');
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', ['required', 'max:255', 'regex:#^[\w-]#', 'unique:polls,alias'], function ($input) {
//  bind article in RouteServiceProvider

            if ($this->route()->hasParameter('poll') && $this->isMethod('post')) {
                $model = $this->route()->parameter('poll');
                if (null === $model) return true;
                return ($model->alias !== $input->alias) && !empty($input->alias);
            }

            return !empty($input->alias);
        });

        return $validator;
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
                'alias' => 'required',
                'title' => ['required', 'string', 'between:2,255'],
                'description' => ['required', 'string'],
                'question' => ['required', 'string', 'between:2,255'],
                'answer1' => ['required', 'string', 'between:2,255'],
                'answer2' => ['required', 'string', 'between:2,255'],
                'answer3' => ['required', 'string', 'between:2,255'],
                'answer4' => ['required', 'string', 'between:2,255'],
                'answer5' => ['required', 'string', 'between:2,255'],

                'img' => 'mimes:jpg,bmp,png,jpeg|max:5120',
                'alt' => ['nullable', 'string', 'between:2,255'],
                'imgtitle' => ['nullable', 'string', 'between:2,255'],


                'confirmed' => 'boolean|nullable',
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
