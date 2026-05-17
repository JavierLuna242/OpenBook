<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation (Sanitization).
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name'       => trim($this->name),
            'email'      => Str::lower(trim($this->email)),
            'program'    => trim($this->program),
            'student_id' => Str::upper(trim($this->student_id)),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'       => ['required', 'string', 'max:255'],
            'email'      => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@unab\.edu\.co$/'
            ],
            'program'    => ['required', 'string', 'max:255'],
            'student_id' => ['required', 'string', 'regex:/^U00[0-9]{6}$/'],
            'password'   => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required'          => __('messages.val_name_required'),
            'name.max'               => __('messages.val_name_max'),
            'email.required'         => __('messages.val_email_required'),
            'email.email'            => __('messages.val_email_email'),
            'email.max'              => __('messages.val_email_max'),
            'email.unique'           => __('messages.val_email_unique'),
            'email.regex'            => __('messages.val_email_domain'),
            'program.required'       => __('messages.val_program_required'),
            'program.max'            => __('messages.val_program_max'),
            'student_id.required'    => __('messages.val_student_id_required'),
            'student_id.regex'       => __('messages.val_student_id_format'),
            'password.required'      => __('messages.val_password_required'),
            'password.min'           => __('messages.val_password_min'),
            'password.confirmed'     => __('messages.val_password_confirmed'),
        ];
    }
}
