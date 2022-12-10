<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('setting_edit'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'outgoing_server' => [
                'string',
                'required',
            ],
            'outgoing_port' => [
                'string',
                'required',
            ],
            'incoming_server' => [
                'string',
                'required',
            ],
            'incoming_port' => [
                'string',
                'required',
            ],
        ];
    }
}
