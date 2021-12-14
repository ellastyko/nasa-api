<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
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
        if ($request->get('category')) {

            $event_ids = EventCategory::where(['category_id' => 12])->get('event_id');

            $events = Event::whereIn('id', $event_ids);
            $count = $events->count();
            $events = $events->paginate($request->get('limit'));
        }
        else {
            $events = Event::paginate($request->get('limit'));
            $count = Event::count();
        }
        return response([
            'events' => $events,
            'count' => $count
        ]);
    }

}
