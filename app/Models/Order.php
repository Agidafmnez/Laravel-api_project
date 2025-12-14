<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    /**
     * An order belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
