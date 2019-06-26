@extends('layouts.main')
@section('content')
    <div class="row page-titles m-b-0">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">All Quotations</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Quotation</li>
            </ol>
        </div>
       
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Quotations</h4>
                    
                    <div class="comment-widgets m-b-20">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table id="dtforall" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Job Number</th>
                                            <th>Status</th>
                                            <th>Generate On</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                        </thead>
                                       
                                        <tbody id="customers">
                                        @foreach($quotations as $quotation)
                                               <tr>

                                                <td>
                                                    <?php $qte = $quotation->quote_id ? $quotation->quote_id : $quotation->id;?>
                                                    QU00{{ ucwords($qte.'/'.\Carbon\Carbon::parse($quotation->created_at)->format('y')) }}</td>
                                                <td>{{ ucwords($quotation->customer ? $quotation->customer->Name :'') }}</td>
                                                <td>@if (ucwords($quotation->project_int == 0))
                                                    No Job Number Set
                                                @else
                                                {{ ucwords($quotation->project_int) }}
                                                @endif</td>
                                               
                                                <td>
                                                        @if(ucwords($quotation->status === 'approved'))
                                                        <span class="badge badge-success">{{ ucwords($quotation->status)}}</span>

                                                        @elseif (ucwords($quotation->status === 'declined'))
                                                         <span class="badge badge-danger">{{ ucwords($quotation->status)}}</span>

                                                         @elseif (ucwords($quotation->status === 'accepted'))
                                                         <span class="badge badge-success">{{ ucwords($quotation->status)}}</span>

                                                         @elseif (ucwords($quotation->status === 'checked'))
                                                         <span class="badge badge-info">{{ ucwords($quotation->status)}}</span>

                                                         @elseif (ucwords($quotation->status === 'Pending'))
                                                         <span class="badge badge-warning">{{ ucwords($quotation->status)}}</span>

                                                        @else
                                                        <span class="badge badge-dark">{{ ucwords($quotation->status)}}</span>

                                                @endif
                                            
                                            
                                               

                                            </td>
                                                <td>{{ \Carbon\Carbon::parse($quotation->created_at)->format('d-M-y') }}</td>
                                                <td class="text-nowrap">
                                                    <a href=" {{ url('quotation/'. $quotation->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                </td>
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
        </div>
    </div>
    </div>
@endsection
