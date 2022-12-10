<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trash extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'trashes';

    public $orderable = [
        'id',
        'draft.to',
        'trashed_at',
    ];

    public $filterable = [
        'id',
        'draft.to',
        'trashed_at',
    ];

    protected $fillable = [
        'draft_id',
        'trashed_at',
    ];

    protected $dates = [
        'trashed_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function draft()
    {
        return $this->belongsTo(Draft::class);
    }

    public function getTrashedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setTrashedAtAttribute($value)
    {
        $this->attributes['trashed_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
