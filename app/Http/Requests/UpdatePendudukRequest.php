<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePendudukRequest extends FormRequest
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
            "name" => 'required|max:255',
            "nik"=> 'required|unique:penduduks',
            "phone_number"=> 'required|numeric|digits_between:1,13',
            "address"=> 'required',
            'gender' => 'required|in:L,P',
            "tgl_lahir"=> 'required',
            "kabupaten_id"=>'required'
        ];
    }
}
