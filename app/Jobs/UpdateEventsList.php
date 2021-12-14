<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use GuzzleHttp;

class UpdateEventsList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

            $response = Http::acceptJson()->get("https://eonet.gsfc.nasa.gov/api/v2.1/categories?api_key=".env('NASA_KEY'));
            $categories = $response->collect('categories');

            foreach ($categories as $category) {

                Category::firstOrCreate([
                    'id' => $category['id'],
                    'title' => $category['title'],
                ]);
            }

            $response = Http::acceptJson()->get("https://eonet.gsfc.nasa.gov/api/v2.1/events?api_key=".env('NASA_KEY'));

            $events = $response->collect('events');

            foreach ($events as $event) {
                $obj = Event::firstOrCreate([
                    'code' => $event['id'],
                    'title' => $event['title'],
                    'date' => date("Y-m-d", strtotime($event['geometries'][0]['date'])),
                    'lng' => $event['geometries'][0]['coordinates'][0],
                    'lat' => $event['geometries'][0]['coordinates'][1],
                ]);
                if ($obj->wasRecentlyCreated == true) {

                    foreach ($event['categories'] as $category) {

                        EventCategory::create([
                            'event_id' => $obj->id,
                            'category_id' => $category['id']
                        ]);
                    }

                }
            }


    }
}
