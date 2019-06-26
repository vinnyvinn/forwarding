<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Pos Reports</h4>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped tbl-agency" id="customers">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Supplier</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>PO Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pos as $po)
                                <tr>
                                    <td>{{ $po->po_no }}</td>
                                    <td>{{ $po->supplier ? ucfirst($po->supplier->Name) :''}}</td>
                                    <td>{{ucfirst($po->user->name) }}</td>
                                    <td>{{ucfirst($po->status)}}</td>
                                    <td>{{ \Carbon\Carbon::parse($po->po_date)->format('d-M-y')}}</td>
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

<style>

    #customers {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;

        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
</style>
