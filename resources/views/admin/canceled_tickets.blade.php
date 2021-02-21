@extends('layouts.app')

@section('content')

    @if (session('info'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('info') }}
                </div>
            </div>
        </div>
    @elseif (session('error'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <div class="card card-default">
        <h2 class="card-header">Canceled Tickets</h2>
        <div class="card-body">
            @if($tickets->count())
                <table class="table table-striped">
                    <thead>
                    <th>Ticket Id</th>
                    <th>Type</th>
                    <th>Price</th>

                    <th>Departure Date</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Capacity</th>
                    <th>Ticket Status</th>

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
                                ${{$ticket->price}}
                            </td>

                            <td>
                                {{\Carbon\Carbon::parse($ticket->departure_date)->format('d M Y H:i')}}
                                {{--                                {{$ticket->date}}--}}
                            </td>

                            <td>
                                {{$ticket->origin}}
                            </td>
                            <td>
                                {{$ticket->destination}}
                            </td>
                            <td>
                                {{$ticket->capacity}}

                            </td>
                            <td>
                                @if($ticket->status === 'available')
                                    <span class="badge badge-success">{{$ticket->status}}</span>
                                @elseif($ticket->status === 'sold')
                                    <span class="badge badge-secondary">{{$ticket->status}}</span>
                                @else
                                    <span class="badge badge-danger">{{$ticket->status}}</span>
                                @endif
                            </td>
                            <th>

                                {{--TODO:change primary key to uid--}}
                                @if($ticket->status === 'canceled' && $ticket->users)
                                    <a href="{{route('ticket.refund',[$ticket])}}"
                                       class="btn btn-primary">Refund</a>
                                    <a href="{{route('tickets.purchasers',$ticket->id)}}" class="btn btn-info">View
                                        Purchasers</a>
                                @endif
{{--                                @if($ticket->pivot->users)--}}
{{--                                    <a href="{{route('tickets.purchasers',$ticket->id)}}" class="btn btn-info">View--}}
{{--                                        Purchasers</a>--}}
{{--                                    @endif--}}
                            </th>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @else
                <h3 class="text-center">No Canceled Tickets Yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/flatpickr.min.css">
@endsection
@section('scripts')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script type="text/javascript">
        $("#btn").click(function () {
            alert("Handler for .click() called.");
        });

        $("#departure_date").flatpickr({
            enableTime: false,
            dateFormat: "d M Y",
        });
    </script>
@endsection
