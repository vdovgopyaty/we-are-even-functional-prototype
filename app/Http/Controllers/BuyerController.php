<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
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
            ->buyers()->get();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $eventId)
    {
        $event = Auth::user()->events()->find($eventId);

        $buyer = $event->buyers()->create($request->only([
            'name',
        ]));

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($buyer, 201);
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
        $buyer = Auth::user()
            ->events()->find($eventId)
            ->buyers()->find($id);

        $buyer->update(request('name'));

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($buyer, 200);
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
        $buyer = Auth::user()
            ->events()->find($eventId)
            ->buyers()->find($id);

        $buyer->delete();

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json(null, 204);
        } else {
            return redirect()->route('events.show', $eventId);
        }
    }

    /**
     * Save a buyers amounts in purchase.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $eventId
     * @param $purchaseId
     * @return \Illuminate\Http\Response
     */
    public function saveAmounts(Request $request, $eventId, $purchaseId)
    {
        $purchase = Auth::user()
            ->events()->find($eventId)
            ->purchases()->find($purchaseId);

        $amounts = $request->except(['_token']);
        $sync = [];
        foreach ($amounts as $amount) {
            if ($amount) {
                $key = str_replace('buyer', '', array_search($amount, $amounts));
                $sync[$key] = ['amount' => floatval($amount)];
            }
        }

        $buyers = $purchase->buyers()->sync($sync);

        if ($request->ajax() || $request->route()->getPrefix() == 'api') {
            return response()->json($buyers, 200);
        } else {
            return redirect()->route('purchases.show', [$eventId, $purchase]);
        }
    }
}
