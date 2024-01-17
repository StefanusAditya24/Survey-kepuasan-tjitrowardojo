<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string $name
 * @property string $phone_number
 * @property string $gender
 * @property Age $age
 * @property Education $education
 * @property Job $job
 * @property ServiceType $serviceType
 * @property PatientRoom $patientRoom
 * @property RespondentAnswer $answers
 */
class Respondent extends Model
{
    protected $fillable = [
        'name',
        'phone_number',
        'gender',
        'age_id',
        'education_id',
        'job',
        'service_type_id',
        'patient_room_id'
    ];

    public function gender(): Attribute
    {
        return Attribute::make(get: fn ($val) => $val === 'male' ? "Laki-Laki" : "Perempuan");
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(get: fn ($val) => Carbon::parse($val)->format('d-m-Y h:i:s'));
    }

    public function answers(): HasMany
    {
        return $this->hasMany(RespondentAnswer::class);
    }

    public function age(): BelongsTo
    {
        return $this->belongsTo(Age::class);
    }

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function patientRoom(): BelongsTo
    {
        return $this->belongsTo(PatientRoom::class);
    }
}
