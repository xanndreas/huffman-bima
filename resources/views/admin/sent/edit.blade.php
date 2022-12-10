@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.sent.title_singular') }}:
                    {{ trans('cruds.sent.fields.id') }}
                    {{ $sent->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('sent.edit', [$sent])
        </div>
    </div>
</div>
@endsection