@extends('layouts.app')

@section('content')

    <div class="card card-default">
        <h2 class="card-header">Customers List</h2>
        <div class="card-body">
            @if($users->count())
                <table class="table table-striped table-responsive-lg" >
                    <thead>
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Credit</th>
                        <th>Action</th>

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
                              {{$user->credit}}
                            </td>


                            <th>

                                <a href="{{route('customer.edit.credit',$user)}}" class="btn btn-primary">Edit Credit</a>

                            </th>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            @else
                <h3 class="text-center">No Users Yet</h3>
            @endif
        </div>
    </div>
@endsection

