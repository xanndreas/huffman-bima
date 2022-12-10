<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory;
    use HasAdvancedFilter;
    use SoftDeletes;

    public $table = 'settings';

    public $orderable = [
        'id',
        'outgoing_server',
        'outgoing_port',
        'incoming_server',
        'incoming_port',
    ];

    public $filterable = [
        'id',
        'outgoing_server',
        'outgoing_port',
        'incoming_server',
        'incoming_port',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'outgoing_server',
        'outgoing_port',
        'incoming_server',
        'incoming_port',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
