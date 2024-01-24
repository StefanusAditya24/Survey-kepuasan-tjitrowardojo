<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $room_name
 * @property User $user
 */
class PatientRoom extends Model
{
    protected $fillable = [
        'room_name'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}