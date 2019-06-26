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
            <div class="card card-body printableArea">
                <h3 class="text-center">Purchase Order</h3>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <img src="{{ asset('images/logo.png') }}" alt="">
                                {{--<h4>Express Shipping & Logistics (EA) Limited</h4>--}}
                                <h4>Cannon Towers <br>
                                    6th Floor, Moi Avenue Mombasa - Kenya <br>
                                    Email :agency@esl-eastafrica.com or ops@esl-eastafrica.com <br>
                                    Web: www.esl-eastafrica.com</h4>
                            </address>
                        </div>
                        <div class="pull-right">
                            <div class="pull-right">
                                <div id="add_customer" class="col-sm-12">
                                    <div class="col-sm-12">
                                        <h4><b>Vendor Details</b></h4>
                                        <div class="form-group">
                                            <label for="customer"><h4>Search Vendor</h4></label>
                                            <input type="text" id="vendor" class="form-control" placeholder="Search supplier">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="display"></div>
                                    </div>
                                </div>
                                <address id="client_details">
                                    <br>
                                    <p class="pull-right"><b>Date : </b> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
                                </address>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-12 table-responsive m-t-40">
                        <form id="cargo_details" action="" onsubmit="event.preventDefault(); addPOdata(this)">
                            <h4>Generate Purchase Order</h4>
                            {{--<div class="col-sm-12">--}}
                                <hr>
                            {{--</div>--}}
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group"><label for="">PO Number</label>
                                        <input type="text" readonly required value="LPO000{{ $poNumber }}" name="po_no" id="po_no" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group"><label for="">PO Date</label>
                                        <input type="text" required value="" name="po_date" id="po_date" class="form-control datepicker">
                                    </div>
                                </div>
                                <input type="hidden" value="{{ $quotation->id }}" name="quotation_id">
                                <input type="hidden" value="{{ $quotation->project_int }}" name="project_id">
                                <input type="hidden" id="supplier_id" name="supplier_id">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button style="margin-top: 26px" class="btn btn-primary pull-right">Add Detail</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <h3>Select Item | <code style="color: green" id="currency"></code> <span id="notification" class="pull-right" style="overflow: hidden"></span></h3>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for=""><b>Stock Items</b></label>
                                                <select name="service" required id="service" onchange="populateItem()" class="form-control select2" data-placeholder="Search and select item">
                                                    <option value="">Search and select service</option>
                                                    @foreach($sservices as $service)
                                                        <option value="{{$service}}">{{ ucwords($service->Description_2) }} ~ {{ ucwords($service->Description_1) }} ~ {{ ucwords($service->Description_3) }} <b style="text-align: right">{{ in_array($service->StockLink,$qitem) ? 'In Project' : 'Not In Project' }} </b></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for=""><b>Item Description</b></label>
                                                <input id="item_description" name="item_description" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="number" required id="service_units" name="service_units" placeholder="Quantity" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input type="number" required id="selling_price" name="selling_price" placeholder="Rate" class="form-control">
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
                                            <button class="btn btn-block btn-sm btn-primary" onclick="addItem()"><i class="fa fa-check"></i></button>
                                        </div>
                                        <div class="col-sm-12">
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <table class="table table-striped table-responsive table-hover">
                                        <thead>
                                        <tr>
                                            <th>DESCRIPTION</th>
                                            <th class="text-right">QUANTITY</th>
                                            <th class="text-right">RATE</th>
                                            <th class="text-right">TAX</th>
                                            <th class="text-right">TOTAL AMOUNT</th>
                                            {{--<th class="text-right">Action</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody id="service_table">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <div class="col-sm-12">
                                <h3 id="total_amount"><b id="iccurenyc">Total :</b> 0</h3>
                            <this.data.currency == 'USD' ? (getSelectedService.rate / this.data.exrate) : /div>
                            <div class="col-sm-12">
                                <button onclick="storeServiceData()" class="btn btn-block btn-primary">Save</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var search_item = $('#vendor');
        var display_search = $('#display');
        var data = {
            'currency' : '',
            'exrate' : '{{ $exrate }}',
            'DCLink':'',
            'inputCur':'',
            'polines':{},
            'po_detail':{}
        }
        search_item.on('keyup', function () {

            if(search_item.val() == "") {
                display_search.html("")
            }
            else {
                axios.post('/search-vendor', {'search_item' : search_item.val()})
                    .then( function (response) {
                        console.log(response.data);
                        display_search.empty().append(response.data.output);
                    })
                    .catch( function (response) {
                        console.log(response.data);
                    });
            }
        });

        function populateItem() {

            if($('#service').val() === "" || $('#service').val() === null){
                return true;
            }
            var selected = document.getElementById("service");
            var getSelectedService = JSON.parse(selected.options[selected.selectedIndex].value);

            $('#item_description').val(getSelectedService.Description_2 + ' ' + getSelectedService.Description_1 + ' ' + getSelectedService.Description_3);
        }

        function fillData(dclink) {
            axios.get('{{ url('/get-vendor') }}/' + dclink)
                .then( function (response) {
                    var vendor = response.data.vendor;

                    $('#add_customer').hide();
                    $('#client_details').empty().append(
                        '<div class="col-sm-12"><h4><b>To</b></h4>'+
                        '<h4 id="client-name"> Name : ' + vendor.Name + '</h4>'+
                        '<h4 id="contact-person">Contact Person : ' + vendor.Contact_Person + '</h4>'+
                        '<h4 id="contact-person">PIN : ' + vendor.Tax_Number + '</h4>'+
                        '<h4 id="contact-phone">Phone : ' + vendor.Telephone + '</h4>'+
                        '<h4 id="contact-email">Email : ' + vendor.EMail + '</h4></div>'
                    );

                    $('#supplier_id').val(dclink);

                    this.data.currency = vendor.iCurrencyID == 1 ? 'USD' : 'KES';
                    this.data.inputCur = vendor.iCurrencyID == 1 ? 'USD' : 'KES';

                    $('#iccurenyc').empty().append(vendor.iCurrencyID == 1 ? 'TOTAL USD : ' : 'TOTAL KES : ');
                    $('#currency').empty().append('CURRENCY ' + this.data.currency);
                    alert('Your input currency is '+ this.data.currency);
                })
                .catch( function (response) {
                    console.log(response.data);
                });

            this.data.DCLink = dclink;
            display_search.empty();
        }

        function addPOdata(form) {
            var formId = form.id;
            var cargo = $('#'+formId);
            var poDetail = cargo.serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            this.data.po_detail = poDetail;

            cargo.empty();
        }

        function addItem() {

            console.log(this.data.inputCur);

            var  service_selling = 0;
            var checkit = 0;

            if($('#service').val() === "" || $('#service').val() === null){
                alert('Select One Item');
                return true;
            }

            if($('#tax').val() === "" || $('#tax').val() === null){
                alert('Select Tax');
                return true;
            }

            var selected = document.getElementById("service")
            var getSelectedService = JSON.parse(selected.options[selected.selectedIndex].value);

            var sTax = document.getElementById("tax");
            var selectedTax = JSON.parse(sTax.options[sTax.selectedIndex].value);

            var service_units = $('#service_units').val();
            service_selling = $('#selling_price').val();
            var item_description = $('#item_description').val();

            checkit = this.data.inputCur == 'USD' ? (parseFloat(service_selling) * parseFloat(this.data.exrate)) : service_selling;

            if(service_units === "" || service_units === null){
                alert('Enter quantity');
            }

            else if (this.data.DCLink === ''){
                alert('No supplier added');
            }
            else if (Object.keys(this.data.po_detail).length < 1){
                alert('No PO detail added');
            }
            else if (service_selling === "" || service_selling === null){
                alert('Enter Rate');
            }

            else if(getSelectedService.ItemGroup == null || getSelectedService.ItemGroup == ""){
                console.log(checkit);
                alert('Item not mapped to GL Account, Contact Finance');
            }
            else {


                // if(this.data.inputCur == 'KES'){
                    addServiceToData({
                        'id':((Object.keys(this.data.polines).length) + 1),
                        'rate': service_selling,
                        'stock_link': getSelectedService.StockLink,
                        'tax_code' : selectedTax.Code,
                        'tax_description' : selectedTax.Description,
                        'tax_id' : selectedTax.idTaxRate,
                        'tax': parseFloat(((selectedTax.TaxRate * (service_selling * service_units)) / 100)),
                        'qty':service_units,
                        'description': item_description,
                        'total': parseFloat((((selectedTax.TaxRate * (service_selling * service_units)) / 100) +
                            (service_selling * service_units)))
                    })
                // }
                //
                // else {
                //     addServiceToData({
                //         'id':((Object.keys(this.data.polines).length) + 1),
                //         'rate': (service_selling * this.data.exrate),
                //         'stock_link':getSelectedService.StockLink,
                //         'tax_code' : selectedTax.Code,
                //         'tax_description' : selectedTax.Description,
                //         'tax_id' : selectedTax.idTaxRate,
                //         'tax': parseFloat(((selectedTax.TaxRate * (service_selling * service_units)) / 100)),
                //         'qty':service_units,
                //         'description': item_description,
                //         'total': parseFloat((((selectedTax.TaxRate * (service_selling * service_units)) / 100) +
                //             (service_selling * service_units)))
                //     })
                // }

                resetForm();
            }
        }

        function storeServiceData() {
            if (Object.keys(this.data.polines).length > 0 && this.data.DCLink !== ''){
                cssLoader();
                axios.post('{{url('/add-purchase-order')}}', this.data)
                    .then( function (response) {
                        swal({
                            icon: "success",
                            text: "Purchase order added successfully!",
                        });

                        window.location.href = '{{ url('dms/edit/') }}/' + response.data.dms;
                    })
                    .catch( function (response) {
                        console.log(response.data);
                    });
            }
            else {
                var errorMsg = '';
                if (Object.keys(this.data.polines).length < 1){
                    errorMsg = errorMsg + '1. No service added \n';
                }

                if (Object.keys(this.data.po_detail).length < 1){
                    errorMsg = errorMsg + '1. No client details added \n';
                }

                if (this.data.DCLink === ''){
                    errorMsg += '2. No vendor added'

                }
                console.log(errorMsg);
                alert(errorMsg);
                return true;

            }
        }

        function resetForm() {
            $('#service').val(1).trigger('change.select2');
            $('#tax').val(1).trigger('change.select2');
            $('#service_units').val('');
            $('#selling_price').val('');
            $('#item_description').val('');
        }

        function addServiceToData(service) {
            console.log(service);
            $('#service_table').append('<tr id="' + service.id + '">' +
                '<td>' + service.description + '</td>' +
                '<td class="text-right">' + Number(service.qty).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.rate).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.tax).toFixed(2) + '</td>' +
                '<td class="text-right">' + Number(service.total).toFixed(2)+ '</td>' +
                '<td class="text-right"><button onclick="deleteSerive(this)" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button></td>' +
                '</tr>');
            this.data.polines[service.id] = service;
            $('#total_amount').empty().append('<b>TOTAL : '+ this.data.currency + '</b> ' + getTotal())

        }

        function deleteSerive(service) {
            service_id = service.parentNode.parentNode;

            console.log(this.data);
            delete this.data.polines[service_id.id];
            service_id.parentNode.removeChild(service_id);
            $('#total_amount').empty().append('<b>TOTAL : '+ this.data.currency + '</b> ' + getTotal())

        }

        function getTotal() {
            if (Object.keys(this.data.polines).length > 0){
                return Object.values(this.data.polines).reduce(function (a,b) {
                    return (a + b.total).toFixed(2);
                },0);
            }
            else{
                return 0;
            }
        }


    </script>
@endsection