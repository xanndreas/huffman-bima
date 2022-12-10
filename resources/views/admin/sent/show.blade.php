@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.sent.title_singular') }}:
                    {{ trans('cruds.sent.fields.id') }}
                    {{ $sent->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.sent.fields.id') }}
                            </th>
                            <td>
                                {{ $sent->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sent.fields.draft') }}
                            </th>
                            <td>
                                @if($sent->draft)
                                    <span class="badge badge-relationship">{{ $sent->draft->to ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.sent.fields.sent_at') }}
                            </th>
                            <td>
                                {{ $sent->sent_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('sent_edit')
                    <a href="{{ route('admin.sents.edit', $sent) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.sents.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection