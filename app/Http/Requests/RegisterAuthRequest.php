<?php

namespace App\Http\Requests;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        /*$user =  User::where([
            ['email', '=', $this->email],
        ])->first();

        if($user != null){*/
            return [
                'name' => 'required|string',
                'email' => 'email|unique:users',
                'password' => 'required|string|min:6|max:10|confirmed',
                'role' => 'require|string',
                'phoneNumber' => 'string',
                'address' => 'json',
                'about' => 'string',
                'additionalFields' => 'string',
                'credentials' => 'file|array',
                
            ];
        /*}
        else{

            return [
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|max:10|confirmed',
                'role' => 'require|string',
                'phoneNumber' => 'string',
                'address' => 'json',
                'about' => 'string',
                'additionalFields' => 'string',
                'credentials' => 'file|array',
                
            ];
        }*/
    }
}
