<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChannelRequest extends FormRequest
{
    /**
     * @return mixed
     */
    public function authorize()
    {
        return \Auth::user()->canDo();
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'required|unique:channels,alias|max:255|alpha_dash', function ($input) {
            if ($this->isMethod('post')) {
                $model = $this->route()->parameter('channel');
                if (null === $model) return true;
                return (($model->alias !== $input->alias));
            }

            return !empty($input->alias);
        });

        $validator->sometimes('title', 'unique:channels,title', function ($input) {
            if ($this->route()->hasParameter('title') && $this->isMethod('post')) {
                $model = $this->route()->parameter('title');

                if (null === $model) return true;
                return (($model->name !== $input->cat) && !empty($input->cat));
            }

            return !empty($input->cat);
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
                'title' => ['required', 'between:5, 32', 'regex:#^[а-яА-ЯІіЇіЄє\s\'-\(\)]+$#u'],
                'confirmed' => 'boolean|nullable',
            ];
            return $rules;
        }

        return [
            //
        ];
    }
}
