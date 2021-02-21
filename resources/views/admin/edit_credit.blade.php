@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <h2 class="card-header">Update Profile</h2>
        <div class="card-body">


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
            <div class="row">

                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="col-md-12 mb-3 credit">
                                <span>Customer Name: </span>
                                <span>{{$user->name}}</span>
                            </div>
                            <div class="col-md-12 mb-3 credit">
                                <span>Customer Email: </span>
                                <span>{{$user->email}}</span>
                            </div>
                            <div class="col-md-12 mb-3 credit">
                                <span>Customer Credit: </span>
                                <span>${{$user->credit}}</span>
                            </div>
                            <form class="form-horizontal" method="POST"
                                  action="{{route('customer.update.credit',$user)}}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Credit</label>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="text" class="form-control" name="credit" aria-label=""
                                                   value="{{ $user->credit }}">

                                        </div>
                                        @if ($errors->has('credit'))
                                            <span class="help-block">
                                                <strong class="text-danger">{{ $errors->first('credit') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update Credit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </div>

@endsection

