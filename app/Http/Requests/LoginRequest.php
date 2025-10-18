<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'nama'     => 'required|string',
            'password' => 'required|string',
        ];
    }
    public function authenticate()
    {
        // guard baru
        if (! Auth::guard('pengguna')->attempt($this->only('nama', 'password'), $this->boolean('remember'))) {
            throw ValidationException::withMessages([
                'nama' => 'Nama atau password salah.',
            ]);
        }
    }
}
