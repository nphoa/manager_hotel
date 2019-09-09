@extends('Templates.layout')
@section('content')
    <style>
        button.dim {
            margin-bottom:0px !important;
            margin-top: -5px;
        }
        button.btn-success.dim {
            box-shadow: inset 0 0 0 #1872ab, 0 4px 0 0 #1872ab, 0 5px 5px #999999 !important;
        }
        button.btn-primary.dim {
            box-shadow: inset 0 0 0 #16987e, 0 5px 0 0 #16987e, 0 5px 5px #999999 !important;
        }
        button.btn-danger.dim {
            box-shadow: inset 0 0 0 #ea394c, 0 5px 0 0 #ea394c, 0 5px 5px #999999 !important;
        }
    </style>

    <div id="checkInCheckOut_container">
        @include('Partials.AjaxView.CheckInCheckOut_Ajax')
    </div>


    {{--Modal--}}
    <div>
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1500px !important;">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Information Room Register</h4>
                        <small class="font-bold" style="color: midnightblue;font-size: 15px" id="informationHandle" hidden>
                        </small>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-7">
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
                                            <input hidden type="text" class="form-control" name="id" value="0">
                                            <input hidden type="text" class="form-control" name="id_room">
                                            <input hidden type="text" class="form-control" name="number_customer_of_room">
                                            <div class="form-group" id="data_5">
                                                <label class="font-normal">Choose date time check in / check out</label>
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" class="form-control-sm form-control" name="date_check_in" value="{{now()}}">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" class="form-control-sm form-control" name="date_check_out" value="{{now()}}">
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="">Note</label>
                                                <div class="">
                                                    <textarea type="text" class="form-control" name="note"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
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
                                                <label class="font-normal">Choose services</label>
                                                <div>
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
                                                            <a href="javascript:void(false)" onclick="deleteService(this)">Delete</a>
                                                        </td>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyInformationService">

                                                    </tbody>
                                                </table>
                                                <div style="text-align: right" id="totalServicePrice">
                                                    <span>Total:</span>
                                                    <input type="text" class="" disabled value="0" style="text-align: right">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-7">
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
                                        {{--Customers--}}
                                        <style>
                                            div.chosen-container{
                                                width: 50% !important;
                                            }
                                        </style>
                                        <div>
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
                                                        <a href="javascript:void(false)" onclick="deleteCustomer(this)">Delete</a>
                                                    </td>
                                                </tr>
                                                </thead>
                                                <tbody id="tbodyInformationCustomer">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--End Modal--}}
    <script src="{{asset('js/Category/table.Module.js')}}"></script>


    <script>
        $(document).ready(function(){
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            $('.chosen-select').chosen({width: "100%"});

            $("#save").on('click',function () {
                var dataService = tableModule.getDataForTable($("tbody#tbodyInformationService"));
                var dataForm = $("form#frmCheckInCheckOut").serializeArray();
                var dataCustomer = tableModule.getDataForTable($("tbody#tbodyInformationCustomer"));
                dataForm.push(
                    {
                        name:'services',value:JSON.stringify(dataService)
                    },
                    {
                        name:'customers',value:JSON.stringify(dataCustomer)
                    }
                );
                $.ajax({
                    url     :'/handle',
                    data    :dataForm,
                    method  :'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function (data) {
                        if(data.status === 200){
                            $("small#informationHandle").removeAttr('hidden').text('Update success');
                        }
                    }
                });

            });
        });
        function handleCheckIn(element) {
            let mode = $(element).attr('data-mode');
            let count_customer = $(element).attr('data-number_customer');
            $("input[name=number_customer_of_room]").val(count_customer);
            if(mode == "checkIn"){
                let idRoom =  $(element).attr('data-room_id');
                $("input[name=id_room]").val(idRoom);
                return;
            }
            let idRoomRegister = $(element).attr('data-room_register_id');
            $.get('/getInfoDetail/'+idRoomRegister,function (response) {
                // console.log(response.result.roomRegister);
                //Binding data

                //console.log(response.result.roomRegisterService.length);
                if (response.status === 200){
                    //Binding info room register
                    let roomRegister = response.result.roomRegister;
                    $("input[name=id]").val(roomRegister.room_register_id);
                    $("input[name=id_room]").val(roomRegister.room_id);
                    $("input[name=date_check_in]").val(roomRegister.date_check_in);
                    $("input[name=date_check_out]").val(roomRegister.date_check_out);
                    $("textarea[name=note]").val(roomRegister.note);
                    console.log(response);
                    //Binding info room register service
                    $("tbody#tbodyInformationService").empty();
                    let roomRegisterService = response.result.roomRegisterService;
                    if(roomRegisterService.length > 0){
                        let trs = [];
                        for (let i =0;i < roomRegisterService.length;i++){
                            let tr = $("tr#rowService").clone().css('display','');
                            tr.attr("data-id_service",roomRegisterService[i].id_service);

                            tr.find("td:eq(0)").children().val(roomRegisterService[i].id);
                            tr.find("td:eq(1)").children().val(roomRegisterService[i].id_service);

                            tr.find("td:eq(2)").text(roomRegisterService[i].serviceName);
                            tr.find("td:eq(3)").children().val(roomRegisterService[i].count);
                            tr.find("td:eq(4)").children().val(roomRegisterService[i].servicePrice);
                            tr.find("td:eq(5)").text(roomRegisterService[i].servicePrice * roomRegisterService[i].count);
                            trs.push(tr);
                        }
                        $("tbody#tbodyInformationService").append(trs);
                    }
                    //Binding info room register customers
                    $("tbody#tbodyInformationCustomer").empty();
                    let roomRegisterCustomers = response.result.roomRegisterCustomer;
                    if(roomRegisterCustomers.length > 0){
                        let trs = [];
                        for (let i =0;i < roomRegisterCustomers.length;i++){
                            let tr = $("tr#rowCustomer").clone().css('display','');

                            tr.attr("data-id_customer",roomRegisterCustomers[i].id_customer);

                            tr.find("td:eq(0)").children().val(roomRegisterCustomers[i].id);
                            tr.find("td:eq(1)").children().val(roomRegisterCustomers[i].id_customer);

                            tr.find("td:eq(2)").children().val(roomRegisterCustomers[i].fullName);
                            tr.find("td:eq(3)").children().val(roomRegisterCustomers[i].phoneNumber);
                            tr.find("td:eq(4)").children().val(roomRegisterCustomers[i].identityCard);

                            if(roomRegisterCustomers[i].is_member == 1){
                                tr.find("td").children().attr("disabled",true);
                                tr.find("td:eq(5)").children().attr('checked','checked').attr('disabled',true);
                            }

                            trs.push(tr);
                        }
                        $("tbody#tbodyInformationCustomer").append(trs);
                    }
                }

            });

        }
        function addNewService(e) {
            let dataService  = $(e).val();
            if(dataService.length === 0){
                $("#tbodyInformationService").find("tr").remove();
                return;
            }

            let row = $("tr[data-id_service="+dataService+"]");
            if(row.length == 0){
                //add new row
                let e_option = $(e).find("option[data-id="+dataService+"]");
                let rowServiceNew = $("#rowService").clone().css('display','');
                rowServiceNew.attr('data-id_service',dataService);
                rowServiceNew.find("td:eq(0)").children().val(0);
                rowServiceNew.find("td:eq(1)").children().val(e_option.attr('data-id'));
                rowServiceNew.find("td:eq(2)").text(e_option.attr('data-name'));
                rowServiceNew.find("td:eq(4)").children().val(e_option.attr('data-price'));
                $("#tbodyInformationService").append(rowServiceNew);
            }else{
                alert('This service has exist !!!');
            }
            setTimeout(function () {
                $("select[name=services]").val(0);
                $('.chosen-select').trigger("chosen:updated");
            },500);

            //$("option#defaultValue").attr("selected","selected");
            // dataService.forEach(function (item) {
            //
            //     //let idItem = item.replace(/\s/g, "");
            //     let row = $("tr#"+item);
            //     console.log(row);
            //     if(row.length == 0){
            //         //add new row
            //         let e_option = $(e).find("option[data-id="+item+"]");
            //         let rowServiceNew = $("#rowService").clone().css('display','');
            //         rowServiceNew.attr('id',item);
            //         rowServiceNew.find("td:eq(1)").text(e_option.attr('data-name'));
            //         rowServiceNew.find("td:eq(3)").children().val(e_option.attr('data-price'));
            //         $("#tbodyInformationService").append(rowServiceNew);
            //     }
            // });
        }
        function sumPrice(e){
            let tr = $(e).parent().parent();
            let count_service = tr.find("td:eq(3)").children().val();
            let price_service = tr.find("td:eq(4)").children().val();
            let sumTotal = parseInt(count_service)  * parseFloat(price_service);
            tr.find("td:eq(5)").text(sumTotal);
            updateTotalPrice();

        }
        function deleteService(e) {
            $(e).parent().parent().remove();
            $idRoomRegisterService = $(e).parent().parent().find("td:eq(0)").children().val();
            // console.log($idRoomRegisterService);
            let headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            if($idRoomRegisterService !== "0"){
                $.ajax({
                    type: "POST",
                    url: '/deleteRoomRegisterService',
                    headers:headers,
                    data: {id:$idRoomRegisterService,del_flg:1},
                    success: function (response) {

                    },

                });
            }
            updateTotalPrice();
        }
        function updateTotalPrice() {
            let eleTr = $("tbody#tbodyInformationService").find("tr");
            let priceSum = 0;
            eleTr.each(function (index) {
                let price = parseFloat($(this).find("td:eq(5)").text());
                priceSum += price;
            });
            $("div#totalServicePrice").find("input").val(priceSum);
        }

        function addCustomer(e,mode) {
            //Check number customer of room
            let count_customer = $("input[name=number_customer_of_room]").val();
            let count_customer_html = $("#tbodyInformationCustomer").find('tr').length;
            if(count_customer < count_customer_html){alert('This room just have ' + count_customer +' '+'customer');return;}

            let rowCustomerNew = $("#rowCustomer").clone().css('display','');
            rowCustomerNew.attr('data-id_customer',0);
            rowCustomerNew.find("td:eq(0)").children().val(0);
            if(mode === 'Member'){
                let row = $("tr[data-id_customer="+$(e).val()+"]");
                if(row.length == 0){
                    let e_option = $(e).find("option[data-id="+$(e).val()+"]");
                    rowCustomerNew.attr('data-id_customer',e_option.attr('data-id'));
                    rowCustomerNew.find("td:eq(1)").children().val(e_option.attr('data-id'));
                    rowCustomerNew.find("td:eq(2)").children().val(e_option.attr('data-fullName'));
                    rowCustomerNew.find("td:eq(3)").children().val(e_option.attr('data-phoneNumber'));
                    rowCustomerNew.find("td:eq(4)").children().val(e_option.attr('data-identityCard'));
                    rowCustomerNew.find("td:eq(5)").children().attr("checked","checked");
                }else{
                    alert('This customer has exist !!!');
                    return;
                }
            }
            $("#tbodyInformationCustomer").append(rowCustomerNew);
        }

        function deleteCustomer(e) {
            $(e).parent().parent().remove();
            $idRoomRegisterCustomer = $(e).parent().parent().find("td:eq(0)").children().val();
            console.log($idRoomRegisterCustomer);
            let headers = {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            if($idRoomRegisterCustomer !== "0"){
                $.ajax({
                    type: "POST",
                    url: '/deleteRoomRegisterCustomer',
                    headers:headers,
                    data: {id:$idRoomRegisterCustomer,del_flg:1},
                    success: function (response) {
                        
                    },
                    
                });
            }

        }
    </script>

@endsection