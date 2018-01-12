<?php

namespace Fresh\Nashemisto\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriorityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->canDo('UPDATE_PRIORITY');
    }

    public function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('category', ['required', 'digits_between:1,5'], function () {
            if ($this->route()->named('admin_priority') && $this->isMethod('post')) {
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
                'top1' => ['numeric', 'max:4294967294', 'digits_between:1,10', 'nullable'],
                'top2' => ['numeric', 'max:4294967294', 'digits_between:1,10', 'nullable'],
                'top3' => ['numeric', 'max:4294967294', 'digits_between:1,10', 'nullable'],
            ];
            return $rules;
        }
        return [
            //
        ];
    }
}
