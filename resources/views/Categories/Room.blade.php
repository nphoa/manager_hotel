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

    <div id="room_container">
        @include('Partials.AjaxView.Room_Ajax')
    </div>

    {{--Modal--}}
    <div>
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY" style="width: 600px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Modal title</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Add Room</h5>
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
                                    <form method="post" id="frmRoom">

                                        <input hidden type="text" class="form-control" name="id">
                                        <div class="form-group  row  ">
                                            <label class="col-sm-2 col-form-label">Room code</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="room_code">
                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Room name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="room_name">

                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Choose type</label>
                                            <div class="col-sm-10">
                                                <select class="form-control m-b" name="id_type">
                                                    @foreach($roomTypes as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach

                                                </select>
                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Choose floor</label>
                                            <div class="col-sm-10">
                                                <select class="form-control m-b" name="id_floor">
                                                    @foreach($floors as $floor)
                                                        <option value="{{$floor->id}}">{{$floor->floor_name}}</option>
                                                    @endforeach
                                                </select>
                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Number count</label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="number_count">

                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Note</label>
                                            <div class="col-sm-10">
                                                <textarea type="text" class="form-control" name="note"></textarea>
                                            </div>
                                        </div>
                                    </form>
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

    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@4"></script>
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>
    <script src="{{asset('js/Category/category.Module.js')}}"></script>
    <script type="text/javascript">
        tippy('clickMe', {
            content: 'Tooltip',
        });
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    let objPagination = {
                        url          : '/rooms?page=' + page,
                        page         :  page,
                        eleContainer  : $("#room_container")
                    };
                    paginationModule.getDataPagination(objPagination);
                }
            }
        });
        $(document).ready(function () {
            var objDataView = {
                eleContainer: $("#room_container"),
                url_instance_by_pagination: '/rooms?page=',
                url_AddOrModifyOrDeleteInstance: '/create_Room',
                frmInstance: $("form#frmRoom"),
            };

            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                let myurl = $(this).attr('href');
                let page = (myurl.split('page='))[1];

                let objPagination = {
                    url: objDataView.url_instance_by_pagination + page,
                    page: page,
                    eleContainer: objDataView.eleContainer
                };
                paginationModule.getDataPagination(objPagination);
            });

            $("#save").on('click', function () {
                let page = window.location.hash.replace('#', '');
                let dataObj = {
                    url: objDataView.url_AddOrModifyOrDeleteInstance,
                    url_load_page: objDataView.url_instance_by_pagination + page,
                    page: page,
                    eleContainer: objDataView.eleContainer,
                    frmInstanceData: objDataView.frmInstance.serializeArray(),
                    frmInstance: objDataView.frmInstance
                };
                categoryModule.AddOrModifyOrDeleteInstance(dataObj, paginationModule);
            });
            objDataView.frmService.find("input").on('change', function () {
                $(this).parent().parent().removeClass('has-error');
                $(this).parent().find("span").text('').attr('hidden');
            });
        });
        function getDetailRoom(id){
            let frmInstance =  $("form#frmRoom");
            if(id == 0 ){
                categoryModule.resetFrm(frmInstance,"Add");
                return;
            }
            categoryModule.resetFrm(frmInstance,"Edit");
            let dataObj = {
                url         : '/getByIdRoom/'+id,
                frmInstance : frmInstance
            };
            categoryModule.getById(dataObj);
        }
        function deleteInstance(id) {
            let params = {
                id      : id,
                del_flg : 1
            };
            let page = window.location.hash.replace('#', '');
            let lengthItemOfPage = $("tbody#tbodyService").find("tr").length;
            page = (lengthItemOfPage === 1) ? (page - 1) : page;
            let dataObj = {
                url             : '/create_Room',
                url_load_page   : '/rooms?page=' + page,
                page            :  page ,
                eleContainer    : $("#room_container"),
                frmInstanceData : params,
                frmInstance     : $("form#frmRoom")
            };
            categoryModule.AddOrModifyOrDeleteInstance(dataObj,paginationModule);
        }

    </script>
@endsection




