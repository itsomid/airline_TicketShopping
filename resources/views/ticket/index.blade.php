@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-start mb-2">
        <a href="{{ route('tickets.create') }}" class="btn btn-success">Add Ticket</a>
    </div>
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
    <div class="card card-default mb-3">
        <h2 class="card-header">Filters</h2>
        <div class="card-body">
            <form action="{{route('tickets.filter')}}" method="get">

                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="">Price From</label>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" name="price_from" aria-label="">
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">Price To</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" class="form-control" name="price_to" aria-label="">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="">Type</label>
                        <select name="type" class="form-control">
                            <option value="">Choose Type...</option>
                            <option value="flight">Flight</option>
                            <option value="train">Train</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="departure_date">Departure date</label>
                        <input type="text" id="departure_date" class="form-control" name="departure_date">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="">Capacity</label>
                        <input type="number" class="form-control" name="capacity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Origin</label>
                        <input type="text" class="form-control" name="origin">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Destination</label>
                        <input type="text" class="form-control" name="destination">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>

            </form>
        </div>
    </div>
    <div class="card card-default">
        <h2 class="card-header">Tickets</h2>
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
                            <td>
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
                                {{--                                {{$ticket->date}}--}}
                            </td>
                            <td>
                                ${{$ticket->price}}
                            </td>

                            <td>
                                {{$ticket->capacity}}
                            </td>


                            <td class="align-middle">
                                @if($ticket->status === 'available')
                                    <span class="badge badge-success">{{$ticket->status}}</span>
                                @elseif($ticket->status === 'sold')
                                    <span class="badge badge-secondary">Not Enough Capacity</span>
                                @else
                                    <span class="badge badge-danger">{{$ticket->status}}</span>
                                @endif
                            </td>
                            <th>

                                {{--TODO:change primary key to uid--}}


                                @if(\Auth::user()->isAdmin())
                                    <a href="{{route('tickets.purchasers',$ticket->id)}}" class="btn btn-info">View
                                        Purchasers</a>
                                @else
                                    @if($ticket->status === 'available' && $ticket->capacity)
                                        <form action="{{route('purchase.ticket',$ticket->id)}}" method="post"
                                              class="purchase mb-3">
                                            @csrf
                                            <input type="number" value="1" min="1" name="count">
                                            <button type="submit" class="btn btn-primary">Purchase</button>
                                        </form>

                                    @endif
                                @endif
                            </th>
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
