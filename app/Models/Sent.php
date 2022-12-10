<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sent extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'sents';

    public $orderable = [
        'id',
        'draft.to',
        'sent_at',
    ];

    public $filterable = [
        'id',
        'draft.to',
        'sent_at',
    ];

    protected $fillable = [
        'draft_id',
        'sent_at',
    ];

    protected $dates = [
        'sent_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function draft()
    {
        return $this->belongsTo(Draft::class);
    }

    public function getSentAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function setSentAtAttribute($value)
    {
        $this->attributes['sent_at'] = $value ? Carbon::createFromFormat(config('project.datetime_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
