@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.draft.title_singular') }}:
                    {{ trans('cruds.draft.fields.id') }}
                    {{ $draft->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.id') }}
                            </th>
                            <td>
                                {{ $draft->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.to') }}
                            </th>
                            <td>
                                {{ $draft->to }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.cc') }}
                            </th>
                            <td>
                                {{ $draft->cc }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.bcc') }}
                            </th>
                            <td>
                                {{ $draft->bcc }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.subject') }}
                            </th>
                            <td>
                                {{ $draft->subject }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.draft.fields.message') }}
                            </th>
                            <td>
                                {{ $draft->message }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('draft_edit')
                    <a href="{{ route('admin.drafts.edit', $draft) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.drafts.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection