@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <h2 class="card-header">Purchased Tickets</h2>
        <div class="card-body">
            @if($tickets->count())
                <table class="table table-striped">
                    <thead>
                    <th>Ticket Id</th>
                    <th>Type</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Price</th>
                    <th>Ticket Count</th>
                    <th>Status</th>
                    <th>Action</th>
                    </thead>

                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>
                                {{$ticket->uid}}
                            </td>
                            <td class="align-middle">
                                {{ $ticket->type }}
                            </td>
                            <td>
                                {{$ticket->origin}}
                            </td>
                            <td>
                                {{$ticket->destination}}
                            </td>
                            <td>
                                {{\Carbon\Carbon::parse($ticket->departure_date)->format('d M Y H:i')}}
                            </td>
                            <td>
                                ${{$ticket->price}}
                            </td>
                            <td>
                               @if($ticket->status === 'canceled')
                                    <span class="badge badge-danger">Canceled</span>
                                @elseif($ticket->status === 'refund')
                                    <span class="badge badge-warning">Refunded</span>
                                @else
                                    <span class="badge badge-success">OnTime</span>
                                @endif
                            </td>
                            <th>
                                {{$ticket->pivot->count}}
                            </th>
                            <th></th>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @else
                <h3 class="text-center">No Tickets Yet</h3>
            @endif
        </div>
    </div>
@endsection

