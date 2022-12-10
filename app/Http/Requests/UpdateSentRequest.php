<?php

namespace App\Http\Requests;

use App\Models\Sent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSentRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('sent_edit'),
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
            'draft_id' => [
                'integer',
                'exists:drafts,id',
                'required',
            ],
            'sent.sent_at' => [
                'required',
                'date_format:' . config('project.datetime_format'),
            ],
        ];
    }
}
