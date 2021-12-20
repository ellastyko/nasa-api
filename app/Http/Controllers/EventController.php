<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventCategory;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit');

        if ($request->has('category')) {

            $event_ids = EventCategory::whereIn('category_id', $request->input('category'))->get('event_id');
            $events = Event::whereIn('id', $event_ids);

            $count = $events->count();
            $events = $events->paginate($limit);
        }
        else {
            $count = Event::count();
            $events = Event::paginate($limit);
        }
        return response([
            'events' => $events,
            'count' => $count
        ]);
    }

}
