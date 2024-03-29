<?php

namespace App\Repositories;

use App\Contract\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Auth;

/**
 * Class EventRepository
 * @package App\Repositories
 */
class EventRepository implements EventRepositoryInterface
{
    /**
     * Splits the amount of events shown on the page into different pages
     *
     * @param int $pag
     * @return LengthAwarePaginator
     */
    public function paginate(int $pag): LengthAwarePaginator
    {
        return Event::paginate($pag);
    }

    /**
     * Calls the removal the event from the database
     *
     * @param int $eventId
     * @return bool
     */
    public function deleteEvent(int $eventId): bool
    {
        $event = Event::find($eventId);
        return $event->removeEvent($eventId);
    }
    
    /**
     * @param array $request
     * @return Event
     */
    public function create(array $request): Event
    {
        return Event::create($request);
    }

    /**
     * finds the event
     *
     * @param int $id
     * @return Event
     */
    public function find(int $id): Event
    {
        return Event::find($id);
    }

    /**
     * gets the events for the index
     *
     * @param int $num
     * @return Collection
     */
    public function getEvents(int $num): Collection
    {
        return Event::get()
            ->where('date', '>=', Carbon::now()->toDateString())
            ->sortBy('time')
            ->sortBy('date')
            ->take($num);
    }

    /**
     * checks if a user has joined the event
     *
     * @param int $event_id
     * @return bool
     */
    public function joinEvent(int $event_id): bool
    {
        $event = Event::find($event_id);
        $user = Auth::User();

        if ($event->eventUsers->contains($user) === true) {
            $event->eventUsers()->detach($user);
            return true;
        }

        $event->eventUsers()->attach($user);
        return false;
    }
}