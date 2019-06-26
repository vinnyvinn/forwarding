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
        
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-primary">
                    <div class="card-header">
                        <h4 class="card-title text-white">Customer Name: {{ ucwords($customer->Name) }}</h4>
                        <hr>
                        <h4 class="card-title text-white">Jobs In Progress<button class="btn btn-info pull-right">Generate Client DSR</button></h4>
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                <tr>
                                    <th>BL/SO NO</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody id="customers">
                                    
                                @foreach($dms as $dm)
                                    @if($dm->status ==0)
                                        <tr>
                                        <td>{{ $dm->bl_number }}</td>
                                        <td>{{ ucwords($dm->customer ? $dm->customer->Name :'') }}</td>
                                        <td>{{ ucwords($dm->customer ? $dm->customer->Contact_Person :'') }}</td>
                                        <td>{{ $dm->customer ? $dm->customer->Telephone :'' }}</td>
                                         <td>{{ ucwords($dm->quote->type ) }}</td>
                                         <td>{{ ucwords($dm->status == 0 ? 'In process' : 'Completed' ) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>
                                        <td class="text-right">
                                            @if($dm->status == 0)
                                                <a href=" {{ url('dms/edit/'. $dm->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline-success">
                    <div class="card-header">
                        <h4 class="card-title text-white">Completed Jobs</h4>
                    </div>
                    <div class="card-body">

                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                <tr>
                                    <th>BL/SO NO</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Telephone</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created</th>

                                </tr>
                                </thead>
                                <tbody id="customers">
                                @foreach($dms as $dm)
                                    @if($dm->status ==1)
                                        <tr>
                                            <td>{{ $dm->bl_number }}</td>
                                            <td>{{ ucwords($dm->customer ? $dm->customer->Name :'') }}</td>
                                            <td>{{ ucwords($dm->customer ? $dm->customer->Contact_Person :'') }}</td>
                                            <td>{{ $dm->customer ? $dm->customer->Telephone:'' }}</td>
                                             <td>{{ ucwords($dm->quote->type ) }}</td>
                                              <td>{{ ucwords($dm->status == 0 ? 'In process' : 'Completed' ) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($dm->created_at)->format('d-M-y') }}</td>

                                        </tr>
                                        @endif
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
@section('scripts')
    <script>
        var customer = $('#search_lead');

        customer.on('keyup', function () {
            axios.post('{{ url('/search-dms') }}',{
                'search_item': customer.val()
            }).then( function (response) {
                $('#customers').empty().append(response.data.output);
            })
                .catch( function (error) {
                    console.log(error)
                });
        });
    </script>
@endsection
