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
            <div class="modal-dialog" style="max-width: 1400px !important;">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Modal title</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
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
                                            <input hidden type="text" class="form-control" name="id">
                                            <input hidden type="text" class="form-control" name="id_room">
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
                            <div class="col-lg-6">
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
                dataForm.push({
                    name:'services',value:JSON.stringify(dataService)
                });
                console.log(dataForm);
                $.ajax({
                    url     :'/handle',
                    data    :dataForm,
                    method  :'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function (data) {
                        console.log(data);
                    }
                });

            });
        });
        function handleCheckIn(idRoom) {
            $("input[name=id_room]").val(idRoom);

        }
        function addNewService(e) {
            let dataService  = $(e).val();
            if(dataService.length === 0){
                $("#tbodyInformationService").find("tr").remove();
                return;
            }

            let row = $("tr#"+dataService);
            if(row.length == 0){
                //add new row
                let e_option = $(e).find("option[data-id="+dataService+"]");
                let rowServiceNew = $("#rowService").clone().css('display','');
                rowServiceNew.attr('id',dataService);
                rowServiceNew.find("td:eq(0)").children().val(e_option.attr('data-id'));
                rowServiceNew.find("td:eq(1)").text(e_option.attr('data-name'));
                rowServiceNew.find("td:eq(3)").children().val(e_option.attr('data-price'));
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
            let count_service = tr.find("td:eq(2)").children().val();
            let price_service = tr.find("td:eq(3)").children().val();
            let sumTotal = parseInt(count_service)  * parseFloat(price_service);
            tr.find("td:eq(4)").text(sumTotal);
            updateTotalPrice();

        }
        function deleteService(e) {
            $(e).parent().parent().remove();
            updateTotalPrice();
        }
        function updateTotalPrice() {
            let eleTr = $("tbody#tbodyInformationService").find("tr");
            let priceSum = 0;
            eleTr.each(function (index) {
                let price = parseFloat($(this).find("td:eq(4)").text());
                priceSum += price;
            });
            $("div#totalServicePrice").find("input").val(priceSum);
        }
    </script>

@endsection