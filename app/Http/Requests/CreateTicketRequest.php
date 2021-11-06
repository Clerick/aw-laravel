<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Message;

class CreateTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => ['required', 'string', 'min:4', 'max:255', 'alpha_dash'],
            'user_email' => ['required', 'string', 'min:6', 'max:255', 'email'],
            'subject' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'in:' . implode(',', Message::AUTHORS)],
            'content' => ['required', 'string']
        ];
    }
}
