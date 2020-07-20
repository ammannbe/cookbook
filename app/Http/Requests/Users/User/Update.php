<?php

namespace App\Http\Requests\Users\User;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = auth()->user()->id;
        $name = auth()->user()->author->name;
        return [
            'name'  => ['string', 'max:255', "unique:users,name,{$name}"],
            'email' => ['email', 'max:255', "unique:users,email,{$userId}"],
        ];
    }
}
