<?php

namespace App\Models;

use App\Enums\RecordStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'username',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => RecordStatus::class,
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class)
            ->using(RoleUser::class)
            ->withTimestamps()
            ->wherePivotNull('deleted_at');
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function urbanServiceCategories(): HasMany
    {
        return $this->hasMany(UrbanServiceCategory::class);
    }

    public function urbanServices(): HasMany
    {
        return $this->hasMany(UrbanService::class);
    }

    public function historicalAttractionCategories(): HasMany
    {
        return $this->hasMany(HistoricalAttractionCategory::class);
    }

    public function historicalAttractions(): HasMany
    {
        return $this->hasMany(HistoricalAttraction::class);
    }

    public function scholars(): HasMany
    {
        return $this->hasMany(Scholar::class);
    }

    public function announcementCategories(): HasMany
    {
        return $this->hasMany(AnnouncementCategory::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function projectCategories(): HasMany
    {
        return $this->hasMany(ProjectCategory::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function projectMedia(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }

    public function mapCategories(): HasMany
    {
        return $this->hasMany(MapCategory::class);
    }

    public function mapLocations(): HasMany
    {
        return $this->hasMany(MapLocation::class);
    }

    public function mapMedia(): HasMany
    {
        return $this->hasMany(MapMedia::class);
    }

    public function rentalCategories(): HasMany
    {
        return $this->hasMany(RentalCategory::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function safaeiCategories(): HasMany
    {
        return $this->hasMany(SafaeiCategory::class);
    }

    public function licenseOnlineServices(): HasMany
    {
        return $this->hasMany(LicenseOnlineService::class);
    }

    public function socialLinks(): HasMany
    {
        return $this->hasMany(SocialLink::class);
    }
}
