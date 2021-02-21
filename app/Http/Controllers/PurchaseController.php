<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    public function purchaseTicket(Ticket $ticket, Request $request)
    {


        $user_old_tickets_count = 0;
        $ticket_count = $request->count;
        $user = Auth::user();

        $final_price = $ticket->price * $ticket_count;
        if ($user->credit < $final_price) {
            return redirect()->back()->with('error', 'You Dont have enough credit to buy these tickets');
        }
        if ($ticket->capacity < $ticket_count){
            return redirect()->back()->with('error', 'Not enough Capacity to buy ' .$ticket_count. ' tickets');
        }


        $user->credit = $this->updateUserCredit($user->credit, $ticket->price,$ticket_count, 'purchase');
        $user->save();

        if (!count($user->tickets()->where('ticket_id', $ticket->id)->get())) {

            $user->tickets()->attach([$ticket->id => ['count' => $ticket_count]]);
        } else {
            $user_old_tickets_count = $user->tickets()->where('ticket_id', $ticket->id)->first()->pivot->count;
            $ticket->users()->updateExistingPivot($user->id, [
                'count' => $ticket_count + $user_old_tickets_count
            ]);
        }

        $ticket->capacity = $ticket->capacity - $ticket_count;
        if ($ticket->capacity === 0) {
            $ticket->status = 'sold';
        }
        $ticket->save();


        return redirect()->back()->with('info', 'Ticket purchased successfully');
    }

    public function refund(Ticket $ticket)
    {

//        return $ticket->users;

        if ($ticket->status !== 'canceled') {
            return abort(404);
        }

        foreach ($ticket->users as $user) {

            $user->credit = $this->updateUserCredit($user->credit, $ticket->price,$user->pivot->count, 'refund');
            $user->save();

        }


        $ticket->status = 'refund';
        $ticket->save();

        return redirect()->back()->with('info', 'The Ticket was refunded');

    }

    public function updateUserCredit($credit, $ticket_price,$ticket_count, $type)
    {
        $final_price = $ticket_price * $ticket_count;
        if ($type === 'purchase')
            return $credit - $final_price;
        elseif ($type === 'refund')

            return $credit + $final_price;
        else
            return $credit;

    }
}
