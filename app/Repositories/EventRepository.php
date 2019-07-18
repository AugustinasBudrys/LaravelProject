<?php

namespace App\Repositories;

use App\Contract\EventRepositoryInterface;
use App\Models\Event;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
     * Request the creation of new event entry into database
     *
     * @param Request $request
     * @return Event
     */
    public function create(Request $request): Event
    {
        return Event::create($request->all());
    }

    /**
     * @param int $id
     * @return Event
     */
    public function find(int $id): Event
    {
        return Event::find($id);
    }

    /**
     * @param int $num
     * @return Collection
     */
    public function getEvents(int $num): Collection
    {
       return Event::take($num)->where('date', '>=', Carbon::now()->toDateString())->get()->sortBy('date');
    }
}