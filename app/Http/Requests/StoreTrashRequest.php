<?php

namespace App\Http\Requests;

use App\Models\Trash;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTrashRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('trash_create'),
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
            'trash.trashed_at' => [
                'required',
                'date_format:' . config('project.datetime_format'),
            ],
        ];
    }
}
