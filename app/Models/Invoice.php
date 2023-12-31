<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'destination',
    ];

    protected $appneds = [
        'total_price',
    ];

    /**
     * Get the customer who created the invoice
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the orders which is related to the invoice
     */
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Get the total price of the invoice
     */
    public function getTotalPriceAttribute()
    {

        return $this->orders()->get()->sum('sub_price');
    }
}
