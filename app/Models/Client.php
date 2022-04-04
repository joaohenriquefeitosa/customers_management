<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Client extends Model
{
    use HasFactory,
        HasUuid;

    protected $fillable = [
        'client_name',
        'client_document',
        'foundation_date',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
