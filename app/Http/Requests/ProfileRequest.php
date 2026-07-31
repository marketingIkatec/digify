<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class ProfileRequest extends FormRequest
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $this->id,
            'password' => [ $this->id ? 'nullable' : 'required', 'confirmed', Rules\Password::defaults()],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Por favor, digite o nome.',
            'email.required' => 'Por favor, digite o e-mail.',
            'email.email' => 'Por favor, digite um e-mail válido.',
            'email.unique' => 'O e-mail já está em uso. Por favor, escolha outro e-mail.',
            'password.required' => 'Por favor, digite a senha.',
        ];
    }
}
