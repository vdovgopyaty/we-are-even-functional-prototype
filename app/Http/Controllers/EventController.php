<?php

namespace App\Http\Controllers;

use App\Event;
use App\Buyer;
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
        $events = Auth::user()->events()
            ->withCount('purchases')
            ->withCount('buyers')
            ->get();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
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
            'name' => 'required|max:60',
            'place' => 'max:30',
            'description' => 'max:255',
        ]);

        $event = $event->create($request->only([
            'name', 'place', 'description', 'image',
        ]));

        $buyer = new Buyer([
            'name' => Auth::user()['name'],
        ]);
        $event->buyers()->save($buyer);

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($event, 201);
        } else {
            return redirect()->route('events.show', $event);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $event = Auth::user()
            ->events()
            ->with(['purchases.buyers', 'purchases' => function ($query) {
                $query->withCount('buyers');
            }])
            ->withCount('buyers')
            ->withCount('purchases')
            ->find($id);

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return $event;
        } else {
            return view('events.show', compact('event'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Auth::user()->events()->find($id);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'name' => 'required|max:30',
            'place' => 'max:30',
            'description' => 'max:255',
        ]);

        $event = Auth::user()->events()->find($id);

        $event->update($request->only([
            'name', 'place', 'description', 'image',
        ]));

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($event, 200);
        } else {
            return redirect()->route('events.show', $event);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $event = Auth::user()->events()->find($id);
        $event->delete();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json(null, 204);
        } else {
            return redirect()->route('events.index');
        }
    }
}
