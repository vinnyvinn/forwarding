@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-center" style="margin-top: 24px">
                    <strong style="color: red">Oops!!</strong> Migrating Data,</h2>
            </div>
            <div class="col-sm-5">
                <div class="card">

                    <div class="card-body">
                        <div class="card-title">
                            {{--<h3 class="text-center">Report an <strong style="color: red">Error</strong></h3>--}}
                            <h4>We are migrating and making the database ready. Hold on  <br> <br>
                            {{--<h4>There might be a problem due to, <br> <br>--}}
                            {{--1. Permission Error - You do not have the permission to perform this action <br>--}}
                            {{--2. System Error - An error just occurred--}}
                                {{--<br>--}}
                                {{--Contact System Admin or Report the Error below.--}}
                            </h4>

                            <h4>We will inform you as soon as we are done</h4>

                        </div>
                        {{--<form action="{{ url('/error') }}" method="post">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="error">Please type your error here and we will have a look at it.</label>--}}
                                {{--<textarea class="form-control" name="error" id="error" cols="30" rows="6"></textarea>--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-primary pull-right">Submit</button>--}}
                        {{--</form>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('/images/error.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

