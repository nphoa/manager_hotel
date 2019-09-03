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
            <div class="modal-dialog" style="max-width: 1200px !important;">
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
                                            <div class="form-group" id="data_5">
                                                <label class="font-normal">Choose date time check in / check out</label>
                                                <div class="input-daterange input-group" id="datepicker">
                                                    <input type="text" class="form-control-sm form-control" name="start" value="05/14/2014">
                                                    <span class="input-group-addon">to</span>
                                                    <input type="text" class="form-control-sm form-control" name="end" value="05/22/2014">
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
                                        <form method="post" id="frmCheckInCheckOut">
                                            @csrf
                                            <div class="form-group">
                                                <label class="font-normal">Choose services</label>
                                                <div>
                                                    <select  class="chosen-select" multiple="" name="services" onchange="addNewService(this)" style="width: 400px; display: none;" tabindex="-1">
                                                        <option value="United States">United States</option>
                                                        <option value="United Kingdom">United Kingdom</option>
                                                        <option value="Afghanistan">Afghanistan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div>
                                                <table class="table table-bordered" id="tableInformationService">
                                                    <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Service name</th>
                                                        <th>Service count</th>
                                                        <th>Service price</th>
                                                        <th>Total</th>
                                                    </tr>
                                                    <tr style="display: none" id="rowService">
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <input type="text" name="service_count">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="service_price">
                                                        </td>
                                                        <td>15000</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="tbodyInformationService">

                                                    </tbody>
                                                </table>
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
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>


    <script>
        $(document).ready(function(){
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });
            $('.chosen-select').chosen({width: "100%"});

            $("#save").on('click',function () {
                let dataForm = $("form#frmCheckInCheckOut").serializeArray();

                console.log($("select[name=services]").val());
            });
        });
        function addNewService(e) {
            let dataService  = $(e).val();
            if(dataService.length === 0){
                $("#tbodyInformationService").find("tr").remove();
                return;
            }
            dataService.forEach(function (item) {
                if(dataService.length < $("#tbodyInformationService").find("tr").length){
                    $("#tbodyInformationService").find("tr").remove();
                }
                let idItem = item.replace(/\s/g, "");
                let row = $("tr#"+idItem);
                if(row.length == 0){
                    //add new row
                    let rowServiceNew = $("#rowService").clone().css('display','');
                    rowServiceNew.attr('id',idItem);
                    rowServiceNew.find("td:eq(1)").text(item);
                    $("#tbodyInformationService").append(rowServiceNew);
                }
            });
        }
    </script>

@endsection