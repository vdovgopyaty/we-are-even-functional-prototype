<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
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
            ->purchases()->get();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return $purchases;
        } else {
            return view('purchases.index', compact('purchases'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $eventId
     * @return \Illuminate\Http\Response
     */
    public function create($eventId)
    {
        $event = Auth::user()->events()->find($eventId);

        return view('purchases.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Purchase $purchase
     * @param $eventId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $eventId, Purchase $purchase)
    {
        $this->validate(request(), [
            'name' => 'required|max:60',
            'description' => 'max:255',
        ]);

        $event = Auth::user()->events()->find($eventId);

        $purchase = $event->purchases()->create($request->only([
            'name', 'description', 'image',
        ]));

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($purchase, 201);
        } else {
            return redirect()->route('purchases.show', [$event, $purchase]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $eventId
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $eventId, $id)
    {
        $purchase = Auth::user()->events()->find($eventId)
            ->purchases()->with(['event.buyers.purchases' => function ($query) use ($id) {
                $query->where('purchases.id', '=', $id);
            }])->with('buyers.purchases')->find($id);

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return $purchase;
        } else {
            return view('purchases.show', compact('purchase'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $eventId
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Purchase $purchase
     */
    public function edit($eventId, $id)
    {
        $purchase = Auth::user()
            ->events()->find($eventId)
            ->purchases()->with('buyers')->find($id);

        return view('purchases.edit', compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $eventId, $id)
    {
        $purchase = Auth::user()
            ->events()->find($eventId)
            ->purchases()->find($id);

        $purchase->update($request->only([
            'name', 'description', 'image',
        ]));

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($purchase, 200);
        } else {
            return redirect()->route('purchases.show', [$eventId, $purchase]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $eventId
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $eventId, $id)
    {
        $purchase = Auth::user()
            ->events()->find($eventId)
            ->purchases()->find($id);

        $purchase->delete();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json(null, 204);
        } else {
            return redirect()->route('events.show');
        }
    }
}
