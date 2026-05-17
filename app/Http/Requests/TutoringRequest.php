<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TutoringRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subject' => 'required|string',
            'topics' => 'required|string',
            'price' => 'nullable|numeric|min:0',
            'scheduled_days' => 'required|array|min:1',
            'availability' => 'required|array|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'subject.required' => __('messages.val_subject_required'),
            'topics.required' => __('messages.val_topics_required'),
            'price.required' => __('messages.val_price_required'),
            'price.numeric' => __('messages.val_price_numeric'),
            'price.min' => __('messages.val_price_min'),
            'scheduled_days.required' => __('messages.val_days_required'),
            'availability.required' => __('messages.val_availability_required'),
        ];
    }
}
