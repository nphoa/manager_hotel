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

    <div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Search</h5>
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
                    <div class="ibox-content">
                        <form id="searchHistory">
                            <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Room code</label>
                                    <input type="text" name="roomCode" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>Room name</label>
                                    <input type="text" name="roomName" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group data_1">
                                    <label>Check-In date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" name="checkInDate" value="03/04/2014">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group data_1">
                                    <label>Check-Out date</label>
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control" name="checkOutDate" value="03/04/2014">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-5 m-b-xs">
                                <select class="form-control-sm form-control input-s-sm inline">
                                    <option value="0">Option 1</option>
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select>
                            </div>
                            <div class="col-sm-4 m-b-xs">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" name="options" id="option1" autocomplete="off" checked=""> ASC
                                    </label>
                                    <label class="btn btn-sm btn-white">
                                        <input type="radio" name="options" id="option2" autocomplete="off"> DESC
                                    </label>

                                </div>
                            </div>
                            <div class="col-sm-3 m-b-xs">
                                <button class="btn btn-success" onclick="search()">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



    </div>
    <div id="history_container">
        @include('Partials.AjaxView.History_Ajax')
    </div>



    {{--End Modal--}}
    <script src="{{asset('js/Common/server.Module.js')}}"></script>
    <script src="{{asset('js/Common/common.Module.js')}}"></script>
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                 $('li').removeClass('active');
                 $(this).parent('li').addClass('active');

                let myurl = $(this).attr('href');
                let page= (myurl.split('page='))[1];
                let dataForm = commonModule.getDataForForm($("form#searchHistory"));
                let objPagination = {
                    method       : 'POST',
                    url          : '/history?page=' + page,
                    datatype     : "html",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data         :  dataForm
                };

                let htmlData = serverModule.callServiceByAjax(objPagination);
                htmlData.then((response)=>{
                    $("div#history_container").empty().html(response);
                })
            });
        });
        function search() {
            let dataForm = commonModule.getDataForForm($("form#searchHistory"));

        }
    </script>

@endsection