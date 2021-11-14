<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Message;

class CreateTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_name' => ['required', 'string', 'min:4', 'max:255', 'alpha_dash'],
            'user_email' => ['required', 'string', 'max:255', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'in:' . implode(',', Message::AUTHORS)],
            'content' => ['required', 'string'],
            'ftp_login' => ['nullable', 'string', 'max:255', 'required_with:ftp_password'],
            'ftp_password' => ['nullable', 'string', 'max:255', 'required_with:ftp_login']
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        if (request()->isJson()) {
            throw new HttpResponseException(response()->json([
                'message' => 'Validation Exception',
                'data' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST));
        } else {
            parent::failedValidation($validator);
        }
    }

    public function hasCredentials()
    {
        return $this->has('ftp_login') && $this->has('ftp_password');
    }
}
