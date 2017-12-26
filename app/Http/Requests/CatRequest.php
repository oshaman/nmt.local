<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
{
    public function authorize()
    {
        return  \Auth::user()->canDo('UPDATE_ARTICLES');
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('alias', 'required|unique:categories,alias|max:255|alpha_dash', function ($input) {
            if ($this->route()->hasParameter('cat') && $this->isMethod('post')) {
                $model = $this->route()->parameter('cat');
                if (null === $model) return true;

                return (($model->alias !== $input->alias)  && !empty($input->alias));
            }

            return !empty($input->alias);
        });

        $validator->sometimes('name', 'unique:categories,name', function ($input) {
            if ($this->route()->hasParameter('name') && $this->isMethod('post')) {
                $model = $this->route()->parameter('name');

                if (null === $model) return true;
                return (($model->name !== $input->cat)  && !empty($input->cat));
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
                'name' => ['required', 'between:5, 32', 'regex:#^[а-яА-ЯІіЇіЄє\s\'-\(\)]+$#u'],
                'confirmed' => 'boolean|nullable',
            ];
            return $rules;
        }

        return [
            //
        ];
    }
}
