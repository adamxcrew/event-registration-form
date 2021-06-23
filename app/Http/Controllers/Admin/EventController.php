<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\PackageCategory as Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.event.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {
        DB::transaction(function () use ($request) {
            $event = Event::create($request->validated());
            $event->setPrice($request->prices);
        });

        return redirect()->route('event.index')->withSuccess('Created successfully.');
    }

    public function edit(Event $event)
    {
        $categories = Category::all();

        return view('admin.event.edit', compact('event', 'categories'));
    }

    public function update(EventRequest $request, Event $event)
    {

        DB::transaction(function () use ($event, $request) {
            $event->update($request->validated());
            $event->setPrice($request->prices);
        });

        return back()->withSuccess('Updated successfully.');
    }

    public function destroy($id)
    {
        Event::destroy($id);

        return back()->withSuccess('Deleted successfully.');
    }
}
