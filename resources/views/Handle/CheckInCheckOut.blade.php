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
    <div id="modalHandle">
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 1500px !important;">
                {{--Append by ajax--}}
            </div>
        </div>
    </div>
{{--    @include('Partials.AjaxView.Handle_Modal_Ajax')--}}



    {{--End Modal--}}
    <script src="{{asset('js/Category/table.Module.js')}}"></script>
    <script src="{{asset('js/Common/server.Module.js')}}"></script>
    <script>

        $(document).ready(function(){
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
                if($("input[name=mode]").val() == 'checkOut'){
                    var dataInvoice = tableModule.getDataForTable($("tbody#tbodyInformationInvoice"));
                    dataForm.push({name:'invoice',value:JSON.stringify(dataInvoice)});
                }
                $.ajax({
                    url     :'/handle',
                    data    :dataForm,
                    method  :'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success : function (data) {
                        //console.log(data.result.room_price_invoice);
                        if(data.status === 200){
                            $("small#informationHandle").removeAttr('hidden').text('Update success');
                            $("input[name=room_price_invoice]").val(data.result.room_price_invoice);
                        }
                    }
                });

            });

            $('#myModal2').on('hidden.bs.modal', function () {
                $("div#modalHandle").find("div.modal-dialog").empty();
            });
        });
        function saveInstance() {
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
            if($("input[name=mode]").val() == 'checkOut'){
                var dataInvoice = tableModule.getDataForTable($("tbody#tbodyInformationInvoice"));
                dataForm.push({name:'invoice',value:JSON.stringify(dataInvoice)});
            }
            $.ajax({
                url     :'/handle',
                data    :dataForm,
                method  :'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function (data) {
                    //console.log(data.result.room_price_invoice);
                    if(data.status === 200){
                        $("small#informationHandle").removeAttr('hidden').text('Update success');
                        $("input[name=room_price_invoice]").val(data.result.room_price_invoice);
                    }
                }
            });
        }
        function handle(element) {
            let mode = $(element).attr('data-mode');
            let id_room = $(element).attr('data-room_id');
            let idRoomRegister = $(element).attr('data-room_register_id');
            //let count_customer = $(element).attr('data-number_customer');
            //$("input[name=number_customer_of_room]").val(count_customer);

            // let idRoomRegister = 0 ;
             //if(mode != "checkIn"){
               //  idRoomRegister = $(element).attr('data-room_register_id');
             //}

            let objDataSend = {
                method : 'GET',
                headers : '',
                url: '/getInfoDetail/'+mode+'/'+id_room+'/'+idRoomRegister,
                data: '',
            };
            let promiseAjaxServer =  serverModule.callServiceByAjax(objDataSend);
            //console.log(promiseAjaxServer);
            //$("div#modalHandle").find("div.modal-dialog").empty().append(promiseAjaxServer);
                promiseAjaxServer
                    .then(response=>{
                        $("div#modalHandle").find("div.modal-dialog").empty().append(response);
                        $("input[name=mode]").val(mode);
                        changeModeForm(mode);
                    });
                //     .catch(error => {console.log('reject');})


            // $.get('/getInfoDetail/'+idRoomRegister,function (response) {
            //     //Binding data
            //     if (response.status === 200){
            //         //Binding info room register
            //         let roomRegister = response.result.roomRegister;
            //         $("input[name=id]").val(roomRegister.room_register_id);
            //         $("input[name=id_room]").val(roomRegister.room_id);
            //         $("input[name=date_check_in]").val(roomRegister.date_check_in);
            //         $("input[name=date_check_out]").val(roomRegister.date_check_out);
            //         $("input[name=currentTime]").val(roomRegister.currentTime);
            //         $("input[name=id_room_price]").filter("#"+roomRegister.id_room_price).attr("checked","checked");
            //         $("input[name=toTime]").val(roomRegister.toTime);
            //         $("textarea[name=note]").val(roomRegister.note);
            //         $("input[name=room_price_invoice]").val(roomRegister.room_price_invoice);
            //         //Binding info room register service
            //         let roomRegisterService = response.result.roomRegisterService;
            //         if(roomRegisterService.length > 0){
            //             let trs = [];
            //             for (let i =0;i < roomRegisterService.length;i++){
            //                 let tr = $("tr#rowService").clone().css('display','');
            //                 tr.attr("data-id_service",roomRegisterService[i].id_service);
            //
            //                 tr.find("td:eq(0)").children().val(roomRegisterService[i].id);
            //                 tr.find("td:eq(1)").children().val(roomRegisterService[i].id_service);
            //
            //                 tr.find("td:eq(2)").text(roomRegisterService[i].serviceName);
            //                 tr.find("td:eq(3)").children().val(roomRegisterService[i].count);
            //                 tr.find("td:eq(4)").children().val(roomRegisterService[i].servicePrice);
            //                 tr.find("td:eq(5)").text(roomRegisterService[i].servicePrice * roomRegisterService[i].count);
            //                 tr.find("td:eq(6)").children().attr('data-idInstance',roomRegisterService[i].id).attr('onClick','deleteInstance(this)');
            //                 trs.push(tr);
            //             }
            //             $("tbody#tbodyInformationService").append(trs);
            //         }
            //         //Binding info room register customers
            //         let roomRegisterCustomers = response.result.roomRegisterCustomer;
            //         if(roomRegisterCustomers.length > 0){
            //             let trs = [];
            //             for (let i =0;i < roomRegisterCustomers.length;i++){
            //                 let tr = $("tr#rowCustomer").clone().css('display','');
            //
            //                 tr.attr("data-id_customer",roomRegisterCustomers[i].id_customer);
            //
            //                 tr.find("td:eq(0)").children().val(roomRegisterCustomers[i].id);
            //                 tr.find("td:eq(1)").children().val(roomRegisterCustomers[i].id_customer);
            //
            //                 tr.find("td:eq(2)").children().val(roomRegisterCustomers[i].fullName);
            //                 tr.find("td:eq(3)").children().val(roomRegisterCustomers[i].phoneNumber);
            //                 tr.find("td:eq(4)").children().val(roomRegisterCustomers[i].identityCard);
            //
            //                 if(roomRegisterCustomers[i].is_member == 1){
            //                     tr.find("td").children().attr("disabled",true);
            //                     tr.find("td:eq(5)").children().attr('checked','checked').attr('disabled',true);
            //                 }
            //                 tr.find("td:eq(6)").children().attr('data-idInstance',roomRegisterCustomers[i].id).attr('onClick','deleteInstance(this)');
            //                 trs.push(tr);
            //             }
            //             $("tbody#tbodyInformationCustomer").append(trs);
            //         }
            //         //Binding to table invoice if is mode check out
            //         if(mode == 'checkOut'){
            //             let trInvoice = $("tbody#tbodyInformationInvoice").find("tr").css('display','');
            //             trInvoice.find('td:eq(0)').children().val(roomRegister.room_price_invoice);
            //             trInvoice.find('td:eq(1)').children().val(roomRegister.service_invoice);
            //             trInvoice.find('td:eq(2)').children().val(parseFloat(roomRegister.room_price_invoice) + parseFloat(roomRegister.service_invoice));
            //             changeModeForm('checkout');
            //         }
            //     }
            // });

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
        }
        function sumPrice(e){
            let tr = $(e).parent().parent();
            let count_service = tr.find("td:eq(3)").children().val();
            let price_service = tr.find("td:eq(4)").children().val();
            let sumTotal = parseInt(count_service)  * parseFloat(price_service);
            tr.find("td:eq(5)").text(sumTotal);
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


        function typePrice(e) {
            let typePrice = $(e).val();
            if(typePrice === '2'){
                $("input[name=toTime]").val('').removeAttr('readonly');
                $("input[name=fromTime]").val('').removeAttr('readonly');
            }else{
                $("input[name=toTime]").val('').attr('readonly','readonly');
                $("input[name=fromTime]").val('').attr('readonly','readonly');
            }
        }
        
        function changeModeForm(mode) {
            let params = ['input','a','textarea'];
            let room_register_form = $("div#divRoomRegister").find("div.ibox-content");
            let room_register_customer_form = $("tbody#tbodyInformationCustomer");
            let room_register_service_form = $("tbody#tbodyInformationService");
            let btnSaveHandle = $("button#save");

            if(mode == 'CheckOut'){
                btnSaveHandle.html('Check out');

                //Room register
                params.filter((item)=>{
                    room_register_form.find(item).attr('disabled',true);
                });

                //Room register customer
                $("div#divAddCustomer").hide();
                params.filter((item)=>{
                    if(item == 'a'){
                        room_register_customer_form.find(item + "[data-mode=customer]").removeAttr('onClick');
                    }else{
                        room_register_customer_form.find(item).attr('disabled',true);
                    }
                });

                //Room register service
                $("div#divAddService").hide();
                params.filter((item)=>{
                    if(item == 'a'){
                        room_register_service_form.find(item + "[data-mode=service]").removeAttr('onClick');
                    }else{
                        room_register_service_form.find(item).attr('disabled',true);
                    }
                });
                return;
            }

           // room_register_customer_form.empty();
           // room_register_service_form.empty();
            //divInvoice.attr('hidden','hidden');
           // btnSaveHandle.html('Save');
            if(mode == 'Update'){
                params.filter((item)=>{
                    room_register_form.find(item).attr('disabled',true);
                });
            }
            if(mode == 'CheckIn' || mode == 'Order'){
                params.filter((item)=>{
                    room_register_form.find(item).removeAttr('disabled',true);
                });
            }
            $("div#divAddCustomer").show();
            params.filter((item)=>{
                room_register_customer_form.find(item).removeAttr('disabled',true);
            });
            $("div#divAddService").show();
            params.filter((item)=>{
                room_register_service_form.find(item).removeAttr('disabled',true);
            });

        }
        
        function deleteInstance(e) {

            let mode = $(e).attr('data-mode');
            let idInstance = $(e).attr('data-idInstance');
            let objDataSend = {
                method : 'POST',
                headers : {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/deleteRoomRegisterService',
                data: {
                    id:idInstance,
                    del_flg:1
                },
            };
            if(mode == 'customer'){
                objDataSend.url = '/deleteRoomRegisterCustomer';
            }
            //Call ajax to server
            if(idInstance != "0"){
                let promiseAjaxServer = serverModule.callServiceByAjax(objDataSend);
                promiseAjaxServer
                    .then(response=>{
                        $(e).parent().parent().remove();
                    })
                    .catch(error => {console.log('reject');})
            }

        }

        function checkInOrderRoom() {
            
        }
    </script>

@endsection