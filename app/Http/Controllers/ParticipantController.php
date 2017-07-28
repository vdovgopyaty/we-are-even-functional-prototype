<?php

namespace App\Http\Controllers;

use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $eventId
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $eventId)
    {
        $purchases = Auth::user()
            ->events()->find($eventId)
            ->participants()->get();

        if ($request->route()->getPrefix() == 'api') {
            return $purchases;
        } else {
            return view('purchases.index', compact('purchases'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @param Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $eventId, Participant $participant)
    {
        $participant->create(
            request([
                'name', 'event_id' => $eventId
            ])
        );

        if ($request->route()->getPrefix() == 'api') {
            return response()->json($participant, 201);
        } else {
            return redirect()->route('events.show', $eventId);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $eventId, $id)
    {
        $participant = Auth::user()
            ->events()->find($eventId)
            ->participants()->find($id);

        $participant->update(request('name'));

        if ($request->route()->getPrefix() == 'api') {
            return response()->json($participant, 200);
        } else {
            return redirect()->route('events.show', $eventId);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $eventId
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $eventId, $id)
    {
        $participant = Auth::user()
            ->events()->find($eventId)
            ->participants()->find($id);

        $participant->delete();

        if ($request->route()->getPrefix() == 'api') {
            return response()->json(null, 204);
        } else {
            return redirect()->route('events.show', $eventId);
        }
    }
}
