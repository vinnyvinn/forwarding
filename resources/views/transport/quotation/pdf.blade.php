<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-md-12">
    <div class="table-responsive m-t-40" style="clear: both;">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">GRT/LOA</th>
                <th class="text-right">RATE</th>
                <th class="text-right">UNITS</th>
                <th class="text-right">Tax</th>
                <th class="text-right">Total (Incl)</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody id="q_service">
            @foreach($quotation->services as $service)
                <tr>
                    <td>{{ ucwords($service->description) }}</td>
                    <td class="text-right">{{ $service->grt_loa }}</td>
                    <td class="text-right">{{ $service->rate }}</td>
                    <td class="text-right">{{ $service->units }}</td>
                    <td class="text-right">{{ $service->tax }}</td>
                    <td class="text-right">{{ number_format($service->total) }}</td>
                    <td class="text-right">
                        <button data-toggle="modal" data-target=".bs-example-modal-lg{{$service->id}}" class="btn btn-xs btn-primary">
                            <i class="fa fa-pencil"></i>
                        </button>
                        <div class="modal fade bs-example-modal-lg{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myLargeModalLabel">Edit Service</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <form style="text-align: left !important;" id="update_service{{$service->id}}" onsubmit="event.preventDefault(); submitForm(this, '/update-service');" action="" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="description text-left">Description <span class="help">(Customer or Company Name)</span></label>
                                                            <input type="text" value="{{ ucwords($service->description) }}" required id="description" name="description" class="form-control" placeholder="Description">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="grt_loa">GRT/LOA</label>
                                                            <input type="text" required id="grt_loa" value="{{ $service->grt_loa  }}" name="grt_loa" class="form-control" placeholder="GRT/LOA" readonly>
                                                        </div>
                                                        <input type="hidden" name="service_id" value="{{ $service->id }}">
                                                        <input type="hidden" name="tariff_type" value="{{ $service->tariff->type }}">
                                                        <div class="form-group">
                                                            <label for="rate">Rate </label>
                                                            <input type="text" required id="rate" {{ $service->tariff->type == \Esl\helpers\Constants::TARIFF_KPA ? 'readonly' : ' ' }} value="{{ $service->rate }}" name="rate" class="form-control" placeholder="Rate">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="units">Units </label>
                                                            <input type="text" required id="units" name="units" value="{{ $service->units }}" class="form-control" placeholder="Units">
                                                        </div>
                                                        <div class="form-group">
                                                            <br>
                                                            <input class="btn btn-block btn-primary" type="submit" value="Update">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <button onclick="deleteService({{ $service->id }})" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    <div class="pull-right m-t-30 text-right">
        <p id="sub_ex">Total (Excl) $ : {{ number_format($quotation->services->sum('total')) }}</p>
        <p id="total_tax">Tax $ : {{ number_format($quotation->services->sum('total_tax')) }} </p>
        <p id="sub_in">Total (Incl) $ : {{ number_format($quotation->services->sum('total')) }} </p>
        <hr>
        <h3 id="total_amount"><b>Total (Incl) $ :</b> {{ number_format($quotation->services->sum('total')) }}</h3>
    </div>
    <div class="clearfix"></div>
    <hr>
    <div class="text-right">
        <button class="btn btn-success" type="submit"> Request Approval </button>
    </div>
</div>
</body>
</html>