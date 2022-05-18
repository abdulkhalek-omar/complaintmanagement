<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Gate::allows('admin_access');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'surname' => [
                'string',
                'max:100',
            ],
            'firstname' => [
                'string',
                'max:100'
            ],
            'street' => [
                'string',
                'min:5',
                'max:255',
            ],
            'fk_place_id' => [
                'integer',
//                'exists:place.id',
            ],
            'fk_state_id' => [
                'integer',
//                'exists:state.id',
            ],
            'fk_country_id' => [
                'integer',
//                'exists:country.id',
            ],
        ];
    }
}
