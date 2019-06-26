<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Current DSR</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Return Back</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">DSR</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-stripped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ESL REF</th>
                                    <th>Client REF</th>
                                    <th>Shipper</th>
                                    <th>Shipper Line</th>
                                    <th>BL NO</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>ETA</th>
                                    <th>Original Docs Rcvd</th>
                                    <th>DATE ENTRY LODGED</th>
                                    <th>DUTY PAYMENTS MADE ON</th>
                                    <th>DATE ENTRY PASSED</th>
                                    <th>DATE CNTR TRANSFERRED TO CFS</th>
                                    <th>VERIFICATION DATE</th>
                                    <th>RELEASED DATE</th>
                                    <th>CFS</th>
                                    <th>REMARKS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dsrs as $dsr)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ strtoupper($dsr->file_number) }}</td>
                                        <td>{{ strtoupper($dsr->ctm_ref ) }}</td>
                                        <td>{{ ucwords($dsr->shipper) }}</td>
                                        <td>{{ ucwords($dsr->shipping_line) }}</td>
                                        <td>{{ strtoupper($dsr->bl_number) }}</td>
                                        <td>{{ ucfirst($dsr->desc) }}</td>
                                        <td>{{ $dsr->quote->cargo->cargo_qty }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
</body>
</html>