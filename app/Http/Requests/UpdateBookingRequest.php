<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => 'exists:users,id',
            'room_id' => 'exists:rooms,id',
            'hotel_id' => 'exists:hotels,id',
            'check_in' => 'date',
            'check_out' => 'date|after:check_in',
            'total_price' => 'numeric|min:0',
            'status' => 'string|in:NEW,PENDING,CONFIRMED,CANCELLED',
        ];
    }
}
