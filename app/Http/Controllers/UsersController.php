<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserCreditRequest;
use App\Http\Requests\UserEditProfileRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{


    public function editProfile(User $user)
    {
        return view('user.edit_profile',['user'=>$user]);
    }

    public function updateProfile(UserEditProfileRequest $request,User $user)
    {

        $data = $request->all();
        $user->update($data);
        return redirect(route('profile.edit', ['user' => $user]))
            ->with('info', 'Your profile has been updated successfully.');
    }
    public function purchasedTickets()
    {
        $user = Auth::user();
        $tickets = $user->tickets;

        return view('user.purchased_tickets', ['tickets' => $tickets]);
    }
}
