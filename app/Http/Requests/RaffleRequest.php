<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RaffleRequest extends FormRequest
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
        return [
            'title'             => 'required|string',
            'quantity_tickets'  => 'required|numeric ',
            'cost_per_ticket'   => 'required|numeric',
            'description'       => 'required|string ',
            /* 'type_id'           => 'required|numeric|exists:raffle_types,id', */
            'category_id'       => 'required|numeric|exists:raffle_categories,id',
            'status'            => 'required',
            'start_date'        => 'required',
            'raffle_date'       => 'required',
            'end_date'          => 'required',
            //'company_id'        => 'sometimes|numeric|exists:companies,id'
        ];
    }
}
