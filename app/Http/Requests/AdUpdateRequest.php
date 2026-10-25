<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponse;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {


            throw new HttpResponseException(
                ApiResponse::sendResponse(422, 'Validation Errors', $validator->messages()->all())
            );


        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'text' => 'required',
            'phone' => 'required',
            'domain_id' => ['required', 'integer', 'exists:domains,id'],
            'ad_id' => ['required', 'integer', 'exists:ads,id'],

        ];
    }

    /**
     * Attributes .
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'Title',
            'text' => 'Description',
            'phone' => 'Phone number',
            'domain_id' => 'DomainId',
            'ad_id' => 'AdId',
        ];
    }
}
