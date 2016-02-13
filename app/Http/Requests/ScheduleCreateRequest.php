<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ScheduleCreateRequest extends Request
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
            'repeat'            => 'required',
            'doctor_id'         => 'required|integer',
            'schedule_start'    => 'required|date_format:h:i A',
            'schedule_end'      => 'required|date_format:h:i A|after:schedule_start',
            'date'              => 'required|date_format:Y-m-d',
            'quota'             => 'required|integer',
        ];
    }
}
