<?php

namespace App\Http\Requests;

use App\Models\Draft;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDraftRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('draft_edit'),
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
            'to' => [
                'string',
                'required',
            ],
            'cc' => [
                'string',
                'nullable',
            ],
            'bcc' => [
                'string',
                'nullable',
            ],
            'subject' => [
                'string',
                'required',
            ],
            'message' => [
                'string',
                'required',
            ],
        ];
    }
}
