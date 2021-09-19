<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class CompanyRequest extends FormRequest
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

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
            'data' => ['errors' => $validator->errors()],
            'message' => 'Los datos proporcionados no son válidos',
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email',
            'logo' => 'dimensions:min_width=100,min_height=200|image'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.email' => 'Email is not email type',
            'logo.dimensions' => 'Dimensions are exceeded',
            'logo.image' => 'Logo is not image type'
        ];
    }
}
