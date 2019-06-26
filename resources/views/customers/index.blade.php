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
                    <div class="card-header">
                        <h4 class="card-title">Customers</h4>
                    </div>
                    <div class="card-body">
                    
                        <div class="table-responsive">
                            <table id="dtforall" class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Account</th>
                                    <th>Telephone</th>
                                    {{--<th>Created</th>--}}
                                    {{--<th class="text-nowrap">Action</th>--}}
                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ ucwords($customer->Name) }}</td>
                                        <td>{{ ucfirst($customer->Contact_Person) }}</td>
                                        <td>{{ $customer->Account }}</td>
                                        <td>
                                            {{ $customer->Telephone }}
                                        </td>
                                        {{--<td>--}}
                                            {{--<div class="row">--}}
                                                {{--<button class="btn btn-sm btn-warning" data-toggle="modal" data-target=".bs-example-modal-lg{{$customer->DCLink}}"><i class="fa fa-plus"></i></button>--}}

                                                {{--<div class="modal fade bs-example-modal-lg{{$customer->DCLink}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">--}}
                                                    {{--<div class="modal-dialog modal-lg">--}}
                                                        {{--<div class="modal-content">--}}
                                                            {{--<div class="modal-header">--}}
                                                                {{--<h4 class="modal-title" id="myLargeModalLabel">Add As Lead</h4>--}}
                                                                {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-body">--}}
                                                                {{--<div class="col-12">--}}
                                                                    {{--<div class="card">--}}
                                                                        {{--<div class="card-body">--}}
                                                                            {{--<form class="form-material m-t-40" action="{{ route('leads.store') }}" method="post">--}}
                                                                                {{--{{ csrf_field() }}--}}
                                                                                {{--<div class="row">--}}
                                                                                    {{--<div class="col-sm-6">--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="name">Name <span class="help">(Customer or Company Name)</span></label>--}}
                                                                                            {{--<input type="text" value="{{ ucwords($customer->Name) }}" required id="name" name="name" class="form-control" placeholder="Name">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="contact_person">Contact Person</label>--}}
                                                                                            {{--<input type="text" required id="contact_person" value="{{ ucfirst($customer->Contact_Person) }}" name="contact_person" class="form-control" placeholder="Contact Person">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="email">Email </label>--}}
                                                                                            {{--<input type="email" required id="email" name="email" class="form-control" placeholder="Email">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="phone">Phone </label>--}}
                                                                                            {{--<input type="text" required id="phone" name="phone" class="form-control" placeholder="Phone">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                                {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                    {{--</div>--}}
                                                                                    {{--<div class="col-sm-6">--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="telephone">Telephone </label>--}}
                                                                                            {{--<input type="text" id="telephone" name="telephone" value="{{ $customer->Telephone }}" class="form-control" placeholder="Telephone">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="address">Address </label>--}}
                                                                                            {{--<input type="text" id="address" name="address" class="form-control" placeholder="Address">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<label for="location">Physical Location </label>--}}
                                                                                            {{--<input type="text" id="location" name="location" class="form-control" placeholder="Physical Location ">--}}
                                                                                            {{--<span class="help-block text-muted">--}}
                                                                                            {{--<small>A block of help text that breaks onto a new line and may extend beyond one line.</small>--}}
                                                                                            {{--</span>--}}
                                                                                        {{--</div>--}}
                                                                                        {{--<div class="form-group">--}}
                                                                                            {{--<br>--}}
                                                                                            {{--<input class="btn btn-block btn-primary" type="submit" value="Save">--}}
                                                                                        {{--</div>--}}
                                                                                    {{--</div>--}}
                                                                                {{--</div>--}}
                                                                            {{--</form>--}}
                                                                        {{--</div>--}}
                                                                    {{--</div>--}}
                                                                {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="modal-footer">--}}
                                                                {{--<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<!-- /.modal-content -->--}}
                                                    {{--</div>--}}
                                                    {{--<!-- /.modal-dialog -->--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                         
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
