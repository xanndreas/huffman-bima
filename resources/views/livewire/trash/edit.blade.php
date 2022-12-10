<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('trash.draft_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="draft">{{ trans('cruds.trash.fields.draft') }}</label>
        <x-select-list class="form-control" required id="draft" name="draft" :options="$this->listsForFields['draft']" wire:model="trash.draft_id" />
        <div class="validation-message">
            {{ $errors->first('trash.draft_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.trash.fields.draft_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('trash.trashed_at') ? 'invalid' : '' }}">
        <label class="form-label required" for="trashed_at">{{ trans('cruds.trash.fields.trashed_at') }}</label>
        <x-date-picker class="form-control" required wire:model="trash.trashed_at" id="trashed_at" name="trashed_at" />
        <div class="validation-message">
            {{ $errors->first('trash.trashed_at') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.trash.fields.trashed_at_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.trashes.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>