@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.trash.title_singular') }}:
                    {{ trans('cruds.trash.fields.id') }}
                    {{ $trash->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('trash.edit', [$trash])
        </div>
    </div>
</div>
@endsection