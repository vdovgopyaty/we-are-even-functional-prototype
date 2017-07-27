<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $events = $user->events()->get();

        if ($request->ajax() || $request->wantsJson() || $request['api_token']) {
            return $events;
        } else {
            return view('events.index', compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $this->validate(request(), [
            'name' => 'required|max:30',
            'place' => 'max:30',
            'description' => 'max:255',
        ]);

        $event->create(
            request([
                'name', 'place', 'description', 'image'
            ])
        );

        if ($request->ajax() || $request->wantsJson() || $request['api_token']) {
            return response()->json($event, 201);
        } else {
            return redirect()->route('events.show', $event);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Event $event)
    {
        if ($request->ajax() || $request->wantsJson() || $request['api_token']) {
            return $event;
        } else {
            return view('events.show', compact('event'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->validate(request(), [
            'name' => 'required|max:30',
            'place' => 'max:30',
            'description' => 'max:255',
        ]);

        $event->update(
            request([
                'name', 'place', 'description', 'image'
            ])
        );

        if ($request->ajax() || $request->wantsJson() || $request['api_token']) {
            return response()->json($event, 200);
        } else {
            return redirect()->route('events.show', $event);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $event->delete();

        if ($request->ajax() || $request->wantsJson() || $request['api_token']) {
            return response()->json(null, 204);
        } else {
            return redirect()->route('events.index');
        }
    }
}
