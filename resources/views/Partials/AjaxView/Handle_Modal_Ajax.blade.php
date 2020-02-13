<div class="modal-content animated fadeInDown">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Information Room Register</h4>
        <h4 style="color: #6b0392;font-weight: bold">{{$data['mode']}}</h4>
        <small class="font-bold" style="color: midnightblue;font-size: 15px" id="informationHandle" hidden>
        </small>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-7" id="divRoomRegister">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Check in / Check out</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <form method="post" id="frmCheckInCheckOut">
                            @csrf
                            <input hidden type="text" class="form-control" name="id" value="{{$data['roomRegister']->id}}">
                            <input hidden type="text" class="form-control" name="id_room" value="{{$data['room']->id}}">
                            <input hidden type="text" class="form-control" name="number_customer_of_room" value="{{$data['room']->number_count}}">
                            <input hidden type="text" class="form-control" name="mode" value="22222">
                            <input hidden type="text" class="form-control" name="status" value="{{$data['roomRegister']->status}}">
                            <div class="follow_by_date">
                                <div class="i-checks">
                                    @foreach($data['roomPrice'] as $key => $price)
                                        <label style="padding-left: {{($key == 1) ? '20px' : '0px'}}" >
                                            <input type="radio"
                                                   value="{{$price->id}}"
                                                   id ="{{$price->id}}"
                                                   name="id_room_price"
                                                   {{($key == 0) ? 'checked': ''}}
                                                   onchange="typePrice(this)"
                                            > {{$price->type_price}}
                                            <span style="font-weight: bold">({{$price->price}})</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="form-group" id="data_5">
                                    <label class="font-normal">Choose date time check in / check out</label>
                                    <div class="input-daterange input-group" id="datepicker">
                                        <input type="text" class="form-control-sm form-control" name="date_check_in" value="{{$data['roomRegister']->date_check_in}}">
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="form-control-sm form-control" name="date_check_out" value="{{$data['roomRegister']->date_check_out}}">
                                    </div>
                                </div>
                                <div style="display: flex">
                                    <div class="form-group" id="chooseTime" style="width: 30%">
                                        <label class="font-normal">From time</label>
                                        <input class="form-control" type="time" id="time" name="fromTime" value="{{$data['roomRegister']->fromTime}}" readonly>
                                    </div>
                                    <div class="form-group" id="chooseTime" style="width: 30%;margin-left: 30px">
                                        <label class="font-normal">To time</label>
                                        <input class="form-control" type="time" id="time" name="toTime" value="{{$data['roomRegister']->toTime}}" readonly>
                                    </div>
                                </div>




                                <div class="form-group" style="width: 50%">
                                    <label class="">Room price</label>
                                    <input type="text" class="form-control" name="room_price_invoice" value="{{number_format($data['roomRegister']->room_price_invoice)}}" readonly>
                                </div>
                            </div>



                            <div class="form-group ">
                                <label class="">Note</label>
                                <div class="">
                                    <textarea type="text" class="form-control" name="note">{{$data['roomRegister']->note}}</textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-5" id="divService">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Information service</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <form method="post" id="frmService">
                            @csrf
                            <div class="form-group">
                                <div id="divAddService">
                                    <label class="font-normal">Choose services</label>
                                    <select  class="chosen-select"  name="services"  onchange="addNewService(this)" style="width: 400px;">
                                        <option value="0">--- Select service ----</option>
                                        @foreach($data['services'] as $service)
                                            <option
                                                    value="{{$service->id}}"
                                                    data-id="{{$service->id}}"
                                                    data-name="{{$service->service_name}}"
                                                    data-price="{{$service->service_price}}">
                                                {{$service->service_name}}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div>
                                <table class="table table-bordered" id="tableInformationService">
                                    <thead>
                                    <tr>
                                        <th>Service name</th>
                                        <th>Service count</th>
                                        <th>Service price</th>
                                        <th>Total</th>
                                        <th>Delete</th>
                                    </tr>
                                    <tr style="display: none" id="rowService">
                                        <td hidden>
                                            <input type="text" name="id" value="0">
                                        </td>
                                        <td hidden>
                                            <input type="text" name="id_service">
                                        </td>
                                        <td></td>
                                        <td>
                                            <input  type="text" name="count" onChange="sumPrice(this)">
                                        </td>
                                        <td>
                                            <input readonly type="text" name="service_price">
                                        </td>
                                        <td>15000</td>
                                        <td>
                                            <a href="javascript:void(false)" data-mode="service" data-idInstance="0" onclick="deleteInstance(this)">Delete</a>
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyInformationService">
                                    @if($data['roomRegisterService'] != null && count($data['roomRegisterService']) > 0 )
                                        @foreach($data['roomRegisterService'] as $item)
                                            <tr  id="rowService">
                                                <td hidden>
                                                    <input type="text" name="id" value="{{$item->id}}">
                                                </td>
                                                <td hidden>
                                                    <input type="text" name="id_service" value="{{$item->id_service}}">
                                                </td>
                                                <td>{{$item->serviceName}}</td>
                                                <td>
                                                    <input  type="text" name="count" onChange="sumPrice(this)" value="{{$item->count}}">
                                                </td>
                                                <td>
                                                    <input readonly type="text" name="service_price" data-price="{{$item->servicePrice}}" value="{{number_format($item->servicePrice)}}">
                                                </td>
                                                <td>{{number_format($item->price)}}</td>
                                                <td>
                                                    <a href="javascript:void(false)" data-mode="service" data-idInstance="{{$item->id}}" onclick="deleteInstance(this)">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                                <div style="text-align: right" id="totalServicePrice">
                                    <span>Total:</span>
                                    <input type="text" class="" disabled value="{{$data['invoiceService']}}" style="text-align: right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7" id="divCustomer">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Customers</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        Customers
                        <style>
                            div.chosen-container{
                                width: 50% !important;
                            }
                        </style>
                        <div id="divAddCustomer">
                            <button type="button" class="btn btn-outline btn-primary" onclick="addCustomer(this,'Not_Member')">Add new customers</button>
                            <label class="font-normal" style="margin-left: 10px">Choose customer is member</label>
                            <select  class="chosen-select"  name="services"  onchange="addCustomer(this,'Member')" style="width: 400px;">
                                <option value="0">--- Select customers ----</option>
                                @foreach($data['customers'] as $customer)
                                    <option
                                            value="{{$customer->id}}"
                                            data-id="{{$customer->id}}"
                                            data-fullName="{{$customer->fullName}}"
                                            data-phoneNumber="{{$customer->phoneNumber}}"
                                            data-identityCard="{{$customer->identityCard}}">
                                        {{$customer->fullName}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div style="margin-top: 10px">
                            <table class="table table-bordered" id="tableInformationCustomer">
                                <thead>
                                <tr>
                                    <th>Customer name</th>
                                    <th>Phone number</th>
                                    <th>Identity card</th>
                                    <th>Is member ? </th>
                                    <th>Delete</th>
                                </tr>
                                <tr style="display: none" id="rowCustomer" data-id_customer="0">
                                    <td hidden>
                                        <input type="text" name="id" value="0">
                                    </td>
                                    <td hidden>
                                        <input type="text" name="id_customer" value="0">
                                    </td>
                                    <td>
                                        <input  type="text" name="fullName">
                                    </td>
                                    <td>
                                        <input  type="text" name="phoneNumber">
                                    </td>
                                    <td>
                                        <input  type="text" name="identityCard">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="is_member">
                                    </td>
                                    <td>
                                        <a href="javascript:void(false)" data-mode="customer" data-idInstance="0" onclick="deleteInstance(this)">Delete</a>
                                    </td>
                                </tr>
                                </thead>
                                <tbody id="tbodyInformationCustomer">
                                    @if($data['roomRegisterCustomer'] != null && count($data['roomRegisterCustomer']) > 0 )
                                        @foreach($data['roomRegisterCustomer'] as $item)
                                            <tr id="rowCustomer" data-id_customer="0">
                                                <td hidden>
                                                    <input type="text" name="id" value="{{$item->id}}">
                                                </td>
                                                <td hidden>
                                                    <input type="text" name="id_customer" value="0">
                                                </td>
                                                <td>
                                                    <input  type="text" name="fullName" value="{{$item->fullName}}">
                                                </td>
                                                <td>
                                                    <input  type="text" name="phoneNumber" value="{{$item->phoneNumber}}">
                                                </td>
                                                <td>
                                                    <input  type="text" name="identityCard" value="{{$item->identityCard}}">
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="is_member" {{($item->is_member == 1) ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(false)" data-mode="customer" data-idInstance="{{$item->id}}" onclick="deleteInstance(this)">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if($data['mode'] === 'CheckOut')
                <div class="col-lg-5" id="divInvoice">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Information invoice</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" style="">
                        <form method="post" id="frmInvoice">
                            @csrf
                            <div>
                                <table class="table table-bordered" id="tableInformationInvoice">
                                    <thead>
                                    <tr>
                                        <th>Invoice Room</th>
                                        <th>Invoice Service</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbodyInformationInvoice">
                                    <tr id="rowInvoice">
                                        <td>
                                            <input type="text" name="invoice_room" style="width: 150px" readonly value="{{$data['roomRegister']->room_price_invoice}}">
                                        </td>
                                        <td>
                                            <input type="text" name="invoice_service" style="width: 150px" readonly value="{{$data['roomRegister']->service_invoice}}">
                                        </td>
                                        <td>
                                            <input type="text" name="invoice_price" style="width: 150px" readonly value="{{$data['roomRegister']->room_price_invoice + $data['roomRegister']->service_invoice}}">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal" id="closeModal">Close</button>
        <button type="button" class="btn btn-primary" id="save" onclick="saveInstance()">Save changes</button>

        @if($data['roomRegister']->id != 0 && $data['roomRegister']->status == 2)
            <button type="button" class="btn btn-success" onclick="checkInOrCancelOrderRoom('CheckIn')">Check in</button>
            <button type="button" class="btn btn-danger" onclick="checkInOrCancelOrderRoom('Cancel')">Cancel room order</button>
        @endif

    </div>
</div>

<script>
    $(document).ready(function() {

        console.log(formatter.format(500000) );
        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });
        $('.chosen-select').chosen({width: "100%"});

        $('.clockpicker').clockpicker({
            placement: 'top',
            align: 'left',
            donetext: 'Done'
        });

    });
</script>
