<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserCreditRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function customersList()
    {
        $users = User::customers()->get();
        return view('admin.customers_list', ['users' => $users]);
    }

    public function customerEditCredit(User $user)
    {
        return view('admin.edit_credit', ['user' => $user]);
    }

    public function customerUpdateCredit(UpdateUserCreditRequest $request, User $user)
    {
        $user->credit = $request->credit;
        $user->save();
        return redirect()->back()->with('info', 'user credit has been updated successfully');
    }

    public function adminCanceledTickets()
    {
        $tickets = Ticket::adminCanceledTickets()->get();
        return view('admin.canceled_tickets', ['tickets' => $tickets]);
    }

    public function ticketPurchasers(Ticket $ticket)
    {
         $users = $ticket->users;

        return view('admin.purchasers_special_tickets',['users'=>$users,'ticket'=>$ticket]);
    }

}
