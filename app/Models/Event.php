<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Auth;

/**
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'date',
        'time',
        'name',
        'description',
        'address'
    ];

    /**
     * @return string
     */
    public function getDateAttribute(): string
    {
        return $this->attributes['date'];
    }

    /**
     * @return string
     */
    public function getTimeAttribute(): string
    {
        return $this->attributes['time'];
    }

    /**
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->attributes['name'];
    }

    /**
     * @return string
     */
    public function getDescriptionAttribute(): string
    {
        return $this->attributes['description'];
    }

    /**
     * @return string
     */
    public function getAddressAttribute(): string
    {
        return $this->attributes['address'];
    }

    /**
     * @param string $date
     * @return void
     */
    public function setDateAttribute(string $date): void
    {
        $this->attributes['date'] = str_replace('/date/', '', $date);
    }

    /**
     * @param string $time
     * @return void
     */
    public function setTimeAttribute(string $time): void
    {
        $this->attributes['time'] = str_replace('/time/', '', $time);
    }

    /**
     * @param string $name
     * @return void
     */
    public function setNameAttribute(string $name): void
    {
        $this->attributes['name'] = str_replace('/string/', '', $name);
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescriptionAttribute(string $description): void
    {
        $this->attributes['description'] = str_replace('/string/', '', $description);
    }

    /**
     * @param string $address
     * @return void
     */
    public function setAddressAttribute(string $address): void
    {
        $this->attributes['address'] = str_replace('/string/', '', $address);
    }

    /**
     * @return BelongsToMany
     */
    public function eventUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @return BelongsToMany
     */
    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class);
    }

    /**
     * This function gets called when removing events
     *
     * @param int $id
     * @return bool
     */
    public function removeEvent(int $id): bool
    {
        $event = $this->find($id);
        if ($event) {
            $event->eventUsers()->detach();
            $event->restaurants()->detach();
            $event->delete();
            return true;
        }
        return false;
    }

    /**
     * in blade file used to check if user has joined
     *
     * @param int $event_id
     * @return bool
     */
    public function modelIf(int $event_id): bool
    {
        $event = $this->find($event_id);
        $user = Auth::user();
        if($event->eventUsers->contains($user) === true){ return true;}
        return false;
    }

    /**
     * @param int $event_id
     * @return int
     */
    public function countUsers(int $event_id): int
    {
        $event = $this->find($event_id);
        return $event->eventUsers->count();
    }
}
