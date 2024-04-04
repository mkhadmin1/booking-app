<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'city_id',
        'rating',
        'manager_id',
    ];
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }
    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }


}
