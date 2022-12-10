<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('sent.draft_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="draft">{{ trans('cruds.sent.fields.draft') }}</label>
        <x-select-list class="form-control" required id="draft" name="draft" :options="$this->listsForFields['draft']" wire:model="sent.draft_id" />
        <div class="validation-message">
            {{ $errors->first('sent.draft_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sent.fields.draft_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sent.sent_at') ? 'invalid' : '' }}">
        <label class="form-label required" for="sent_at">{{ trans('cruds.sent.fields.sent_at') }}</label>
        <x-date-picker class="form-control" required wire:model="sent.sent_at" id="sent_at" name="sent_at" />
        <div class="validation-message">
            {{ $errors->first('sent.sent_at') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sent.fields.sent_at_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.sents.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>