<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'services';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'icon',
        'order',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    /**
     * Boot the model to automatically handle slug creation.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title, '-', null);
            }
        });
    }

    /**
     * Get all portfolio showcase items associated with this service.
     */
    public function portfolioItems(): HasMany
    {
        return $this->hasMany(PortfolioItem::class, 'service_id')->orderBy('order', 'asc');
    }

    /**
     * Scope a query to only include active services.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order services by display order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Generate direct WhatsApp order URL for this service.
     */
    public function getWhatsappOrderUrlAttribute(): string
    {
        $phone = Setting::get('whatsapp_number', '967770000000');
        $phoneClean = preg_replace('/[^0-9]/', '', $phone);
        $message = "مرحباً منصة أنجز، أود الاستفسار وطلب خدمة: " . $this->title;
        return "https://wa.me/{$phoneClean}?text=" . urlencode($message);
    }
}
