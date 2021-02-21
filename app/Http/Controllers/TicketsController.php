<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{

    public function __constructor()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $tickets = Ticket::available()->get();
        $tickets = Ticket::orderBy('status','asc')->get();
        return view('ticket.index', ['tickets' => $tickets]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }




    public function filter(Request $request)
    {
//        return $request;
        if ($request->filled('price_from') || $request->filled('price_to')) {
            $tickets = Ticket::price($request->price_from, $request->price_to)->get();
        }

        if ($request->filled('type')) {
            $tickets = Ticket::type($request->type)->get();
        }

        if ($request->filled('departure_date')) {

            $tickets = Ticket::departureDate($request->departure_date)->get();
        }
        if ($request->filled('capacity')){
            $tickets = Ticket::capacity($request->capacity)->get();
        }
        if ($request->filled('origin')) {

            $tickets = Ticket::origin($request->origin)->get();
        }
        if ($request->filled('destination')) {

            $tickets = Ticket::destination($request->destination)->get();
        }
        return view('ticket.index', ['tickets' => $tickets]);
    }


}
