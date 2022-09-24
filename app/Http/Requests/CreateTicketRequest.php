<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateTicketRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'numbers.*' => 'required|integer|max:60|min:1'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório!',
            'numbers.*.required' => 'O campo numeros é obrigatório!',
            'numbers.*.integer' => 'Os valor tem que ser inteiro!',
            'numbers.*.max' => 'O valor tem que ser de 1 a 60!',
            'numbers.*.min' => 'O valor tem que ser de 1 a 60!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
