@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.trash.title_singular') }}:
                    {{ trans('cruds.trash.fields.id') }}
                    {{ $trash->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.trash.fields.id') }}
                            </th>
                            <td>
                                {{ $trash->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.trash.fields.draft') }}
                            </th>
                            <td>
                                @if($trash->draft)
                                    <span class="badge badge-relationship">{{ $trash->draft->to ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.trash.fields.trashed_at') }}
                            </th>
                            <td>
                                {{ $trash->trashed_at }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('trash_edit')
                    <a href="{{ route('admin.trashes.edit', $trash) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.trashes.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection