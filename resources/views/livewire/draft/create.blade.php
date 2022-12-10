<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('draft.to') ? 'invalid' : '' }}">
        <label class="form-label required" for="to">{{ trans('cruds.draft.fields.to') }}</label>
        <input class="form-control" type="text" name="to" id="to" required wire:model.defer="draft.to">
        <div class="validation-message">
            {{ $errors->first('draft.to') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.draft.fields.to_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('draft.cc') ? 'invalid' : '' }}">
        <label class="form-label" for="cc">{{ trans('cruds.draft.fields.cc') }}</label>
        <input class="form-control" type="text" name="cc" id="cc" wire:model.defer="draft.cc">
        <div class="validation-message">
            {{ $errors->first('draft.cc') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.draft.fields.cc_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('draft.bcc') ? 'invalid' : '' }}">
        <label class="form-label" for="bcc">{{ trans('cruds.draft.fields.bcc') }}</label>
        <input class="form-control" type="text" name="bcc" id="bcc" wire:model.defer="draft.bcc">
        <div class="validation-message">
            {{ $errors->first('draft.bcc') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.draft.fields.bcc_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('draft.subject') ? 'invalid' : '' }}">
        <label class="form-label required" for="subject">{{ trans('cruds.draft.fields.subject') }}</label>
        <input class="form-control" type="text" name="subject" id="subject" required wire:model.defer="draft.subject">
        <div class="validation-message">
            {{ $errors->first('draft.subject') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.draft.fields.subject_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('draft.message') ? 'invalid' : '' }}">
        <label class="form-label required" for="message">{{ trans('cruds.draft.fields.message') }}</label>
        <textarea class="form-control" name="message" id="message" required wire:model.defer="draft.message" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('draft.message') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.draft.fields.message_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.drafts.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>