<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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

        $validator->sometimes('alias', ['required', 'max:255', 'regex:#^[\w-]#', 'unique:articles,alias'], function ($input) {
//  bind article in RouteServiceProvider

            if ($this->route()->hasParameter('article') && $this->isMethod('post')) {
                $model = $this->route()->parameter('article');
                if (null === $model) return true;
                return ($model->alias !== $input->alias)  && !empty($input->alias);
            }

            return !empty($input->alias);
        });

        $validator->sometimes('img', 'mimes:jpg,bmp,png,jpeg|max:5120|required', function ($input) {
//  bind article in RouteServiceProvider
            if ($this->route()->named('create_article') && $this->isMethod('post')) {
                return true;
            }

            return false;
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
                'title' => ['required', 'string', 'between:4,255'],
                'preview' => ['required', 'string'],
                'category_id' => ['digits_between:1,4', 'nullable', 'required'],
                'tags' => 'array',
                'img' => 'mimes:jpg,bmp,png,jpeg|max:5120',
                'imgalt' => ['string', 'nullable'],
                'imgtitle' => ['string', 'nullable'],
                'content' => 'string|nullable',
                'confirmed' => 'boolean|nullable',
                'outputtime' => 'date_format:"Y-m-d H:i"|nullable',
                'view' => ['digits_between:1,10', 'nullable', 'max:4294967295'],
            ];

            if ($this->request->has('tags')) {
                foreach ($this->request->get('tags') as $key => $val) {
                    $rules['tags.' . $key] = ['digits_between:1,10', 'nullable'];
                }
            }
            return $rules;

        } else {
            $rules = [
                'value' => ['nullable', 'string', 'between:1,255', 'regex:#^[a-zA-zа-яА-ЯІіЇіЄєёЁ0-9\-\s\,\:\?\!\.]+$#u'],
                'param' => 'nullable|digits:1',
            ];
            return $rules;
        }
    }

    public function messages()
    {
        return [
            'tags.*.*' => 'Не допустимі символи в полі Теги',
        ];
    }
}
