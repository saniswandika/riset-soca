<?php

namespace App\Http\Requests;

use App\Models\rekomendasi_rehabilitasi_sosial;
use Illuminate\Foundation\Http\FormRequest;

class Updaterekomendasi_rehabilitasi_sosialRequest extends FormRequest
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
        $rules = rekomendasi_rehabilitasi_sosial::$rules;
        
        return $rules;
    }
}
