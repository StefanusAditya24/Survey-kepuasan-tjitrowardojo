<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author Adi Novanto <adinovanto07@gmail.com>
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PatientRoom extends Model
{
    protected $fillable = [
        'room_name'
    ];
}