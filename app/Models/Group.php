<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\HasUuid;

class Group extends Model
{
    use HasFactory,
        HasUuid;

    protected $fillable = [
        'group_name',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class, 'group_id', 'id');
    }
}
