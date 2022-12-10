<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('setting.outgoing_server') ? 'invalid' : '' }}">
        <label class="form-label required" for="outgoing_server">{{ trans('cruds.setting.fields.outgoing_server') }}</label>
        <input class="form-control" type="text" name="outgoing_server" id="outgoing_server" required wire:model.defer="setting.outgoing_server">
        <div class="validation-message">
            {{ $errors->first('setting.outgoing_server') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.outgoing_server_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.outgoing_port') ? 'invalid' : '' }}">
        <label class="form-label required" for="outgoing_port">{{ trans('cruds.setting.fields.outgoing_port') }}</label>
        <input class="form-control" type="text" name="outgoing_port" id="outgoing_port" required wire:model.defer="setting.outgoing_port">
        <div class="validation-message">
            {{ $errors->first('setting.outgoing_port') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.outgoing_port_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.incoming_server') ? 'invalid' : '' }}">
        <label class="form-label required" for="incoming_server">{{ trans('cruds.setting.fields.incoming_server') }}</label>
        <input class="form-control" type="text" name="incoming_server" id="incoming_server" required wire:model.defer="setting.incoming_server">
        <div class="validation-message">
            {{ $errors->first('setting.incoming_server') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.incoming_server_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('setting.incoming_port') ? 'invalid' : '' }}">
        <label class="form-label required" for="incoming_port">{{ trans('cruds.setting.fields.incoming_port') }}</label>
        <input class="form-control" type="text" name="incoming_port" id="incoming_port" required wire:model.defer="setting.incoming_port">
        <div class="validation-message">
            {{ $errors->first('setting.incoming_port') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.setting.fields.incoming_port_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>