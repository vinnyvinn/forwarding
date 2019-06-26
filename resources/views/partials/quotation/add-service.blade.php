<h3>Add Service | <code style="color: green" id="currency"></code> <span id="notification" class="pull-right" style="overflow: hidden"></span></h3>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <select name="service" required id="service" class="form-control select2" data-placeholder="Search and select service">
                        <option value="">Search and select service</option>
                        @foreach($services as $service)
                            <option value="{{$service}}">{{ ucwords($service->name) }} ~  SP KES {{ $service->rate }} | USD {{ number_format(($service->rate / $exrate), 2) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group">
                    <input type="number" required id="service_units" name="service_units" placeholder="Quantity" class="form-control">
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <input type="number" required id="selling_price" name="selling_price" placeholder="Selling price" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <select name="tax" required id="tax" data-placeholder="Select tax" class="form-control select2">
                        <option value="">Select tax</option>
                        @foreach($taxs as $tax)
                            <option value="{{$tax}}">{{ ucwords($tax->Description) }} - {{ $tax->TaxRate }} %</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-block btn-sm btn-primary" onclick="addService()"><i class="fa fa-check"></i></button>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <table class="table table-striped table-responsive table-hover">
            <thead>
            <tr>
                <th>DESCRIPTION</th>
                <th class="text-right">QUANTITY</th>
                <th class="text-right">UNIT PRICE</th>
                <th class="text-right">TAX</th>
                <th class="text-right">TOTAL AMOUNT</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody id="service_table">
            </tbody>
        </table>
    </div>
</div>