<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Listing extends Model
{
    use HasFactory;

    protected $table = 'listings';

    protected $fillable = ['beds', 'baths', 'area', 'city', 'code', 'street', 'street_num', 'price'];

    // relationship
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    // scope
    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeWithFilter(Builder $query, array $filters): Builder
    {
        return $query->when(
            $filters['beds'] ?? false,
            fn($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false,
            fn($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            isset($filters['priceFrom']),
            fn($query) => $query->where('price', '>=', $filters['priceFrom'])
        )->when(
            isset($filters['priceTo']),
            fn($query) => $query->where('price', '<=', $filters['priceTo'])
        )->when(
            isset($filters['areaFrom']),
            fn($query) => $query->where('area', '>=', $filters['areaFrom'])
        )->when(
            isset($filters['areaTo']),
            fn($query) => $query->where('area', '<=', $filters['areaTo'])
        );
    }
}
