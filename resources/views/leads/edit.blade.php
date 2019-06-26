@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Lead</h4>
                        <form class="form-material m-t-40" action="{{ route('leads.update', $lead->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="help">(Customer or Company Name)</span></label>
                                        <input type="text" required id="name" value="{{ $lead->name }}" name="name" class="form-control" placeholder="Name">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_person">Contact Person</label>
                                        <input type="text" required id="contact_person" value="{{ $lead->contact_person }}" name="contact_person" class="form-control" placeholder="Contact Person">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="text" required id="email" name="email" value="{{ $lead->email }}" class="form-control" placeholder="Email">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone </label>
                                        <input type="text" required id="phone" name="phone" value="{{ $lead->phone }}" class="form-control" placeholder="Phone">
                                        {{--<span class="help-block text-muted">
                                            <small>A block of help text that breaks onto a new line and may extend beyond one line.</small>
                                        </span>--}}
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="telephone">Telephone </label>
                                        <input type="text" id="telephone" name="telephone" value="{{ $lead->telephone }}" class="form-control" placeholder="Telephone">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address </label>
                                        <input type="text" id="address" name="address" value="{{ $lead->address }}" class="form-control" placeholder="Address">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <label for="location">Physical Location </label>
                                        <input type="text" id="location" name="location" value="{{ $lead->location }}" class="form-control" placeholder="Physical Location ">
                                        {{--<span class="help-block text-muted">--}}
                                        {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                        {{--</span>--}}
                                    </div>
                                    <div class="form-group">
                                        <br>
                                        <input class="btn pull-right btn-primary" type="submit" value="Update">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

