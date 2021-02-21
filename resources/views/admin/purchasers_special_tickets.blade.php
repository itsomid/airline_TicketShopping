@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <h4 class="card-header">Purchaser of Ticket <strong style="font-size: 2rem">{{$ticket->origin}} - {{$ticket->destination}}</strong></h4>
        <div class="card-body">
            @if($users->count())
                <table class="table table-striped table-responsive-lg" >
                    <thead>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Tickets Count</th>
                        <th>Purchase Date</th>


                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{$user->id}}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{$user->pivot->count}}
                            </td>
                            <th>

                                {{\Carbon\Carbon::parse($user->pivot->created_at)->format('d M Y H:i')}}

                            </th>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @else
                <h3 class="text-center">No Users for this ticket yet</h3>
            @endif
        </div>
    </div>
@endsection

