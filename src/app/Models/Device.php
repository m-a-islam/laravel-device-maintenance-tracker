<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Device extends Model
{
    protected $fillable = ['name', 'serial_number', 'status'];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
