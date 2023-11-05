<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\View\View;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::orderBy('date_start', 'asc')->get();

        return view('events', ['events' => $events]);
    }

    public function update(string $event, EventRequest $request)
    {
        $e = Event::find($event);

        $e->name = $request->name;
        $e->description = $request->description;
        $e->image_url = $request->image_url;
        $e->date_start = $request->date_start;
        $e->date_end = $request->date_end;
        $e->category_id = $request->category_id;

        $e->save();

        return redirect()->route('events')->with('success', 'Event has been updated successfully');;
    }


    public function edit(string $event): View
    {

        $categories = Category::all();

        $e = Event::find($event);
        $e->date_start = Carbon::parse($e->date_start)->format('Y-m-d');
        $e->date_end = Carbon::parse($e->date_end)->format(('Y-m-d'));

        return view('event.edit', ['event' => $e, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::all();

        return view('event/add', ['categories' => $categories]);
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        Event::create($data);

        return redirect()->route('events');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events')->with('success', 'Event deleted successfully');
    }
}
