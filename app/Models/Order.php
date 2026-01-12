<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total',
        'shipping_address',
        'rental_start',
        'rental_end',
        'payment_method',
        'paid_at',
        'notes',
        'customer_name',
        'customer_email',
        'customer_phone',
    ];

    protected $dates = [
        'rental_start',
        'rental_end',
        'paid_at',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        return $query;
    }

    // Accessor untuk status badge class
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'pending' => 'badge bg-warning',
            'paid' => 'badge bg-info',
            'processing' => 'badge bg-primary',
            'shipped' => 'badge bg-secondary',
            'delivered' => 'badge bg-success',
            'cancelled' => 'badge bg-danger',
            default => 'badge bg-light text-dark',
        };
    }

    // Accessor untuk status display name
    public function getStatusDisplayAttribute()
    {
        return match($this->status) {
            'pending' => 'Pending Payment',
            'paid' => 'Paid',
            'processing' => 'Processing',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            default => ucfirst($this->status),
        };
    }

    // Check if order can be cancelled
    public function canBeCancelled()
    {
        return in_array($this->status, ['pending', 'paid']);
    }

    // Check if order can be marked as paid
    public function canBeMarkedAsPaid()
    {
        return $this->status === 'pending';
    }

    // Get rental duration in days
    public function getRentalDurationAttribute()
    {
        if ($this->rental_start && $this->rental_end) {
            return Carbon::parse($this->rental_start)->diffInDays(Carbon::parse($this->rental_end)) + 1;
        }
        return null;
    }

    // Get customer display name
    public function getCustomerDisplayNameAttribute()
    {
        return $this->customer_name ?: ($this->user ? $this->user->name : 'Guest');
    }

    // Get customer email
    public function getCustomerDisplayEmailAttribute()
    {
        return $this->customer_email ?: ($this->user ? $this->user->email : null);
    }
}
