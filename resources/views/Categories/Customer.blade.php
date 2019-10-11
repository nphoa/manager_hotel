@extends('Templates.layout')
@section('content')
{{--    {{--}}
{{--        dd($customers)--}}
{{--    }}--}}
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
    <div id="customer_container">
        @include('Partials.AjaxView.Customer_Ajax')
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
                                    <h5>Add customer</h5>
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
                                    <form method="post" id="frmCustomer">
                                        @csrf
                                        <input hidden type="text" class="form-control" name="id">
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Full name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="fullName">
                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Birthday</label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="birthday">
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="address">
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Phone number</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phoneNumber">
                                                <span style="color: red" hidden>
                                                    ABC
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">Identity card</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="identityCard">
                                            </div>
                                        </div>
                                        <div class="form-group  row">
                                            <label class="col-sm-2 col-form-label">National</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="national">
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
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>
    <script src="{{asset('js/Category/category.Module.js')}}"></script>
    <script type="text/javascript">

        $(window).on('hashchange', function() {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    let objPagination = {
                        url          : '/customers?page=' + page,
                        page         :  page,
                        eleContainer  : $("#floor_container")
                    };
                    paginationModule.getDataPagination(objPagination);
                }
            }
        });
        $(document).ready(function () {
            var objDataView = {
                eleContainer                    : $("#customer_container"),
                url_customers_by_pagination     : '/customers?page=',
                url_AddOrModifyOrDeleteInstance : '/create_Customer',
                frmCustomer                     : $("form#frmCustomer"),
            };

            $(document).on('click', '.pagination a',function(event)
            {
                //event.preventDefault();

                $('li').removeClass('active');
                $(this).parent('li').addClass('active');

                let myurl = $(this).attr('href');
                let page= (myurl.split('page='))[1];

                let objPagination = {
                    url          : objDataView.url_customers_by_pagination + page,
                    page         :  page,
                    eleContainer  : objDataView.eleContainer
                };
                if (history.pushState) {
                    window.history.pushState("object or string", "Page Title", "/newURL");
                } else {
                    document.location.href = "/newURL";
                }
                paginationModule.getDataPagination(objPagination);

            });

            $("#save").on('click',function () {
                let page = window.location.hash.replace('#', '');
                let dataObj = {
                    url             : objDataView.url_AddOrModifyOrDeleteInstance,
                    url_load_page   : objDataView.url_customers_by_pagination + page,
                    page            : page,
                    eleContainer    : objDataView.eleContainer,
                    frmInstanceData : objDataView.frmCustomer.serializeArray(),
                    frmInstance     : objDataView.frmCustomer
                };
                categoryModule.AddOrModifyOrDeleteInstance(dataObj,paginationModule);
            });
            objDataView.frmCustomer.find("input").on('change', function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).parent().find("span").text('').attr('hidden');
            });
            $(".btnAdd").on('click',function () {
                let idCustomer = $(this).attr('data-idCustomer');
                getDetailCustomer(idCustomer,objDataView.frmCustomer);
            });
            $(".btnModify").on('click',function () {
                let idCustomer = $(this).attr('data-idCustomer');
                getDetailCustomer(idCustomer,objDataView.frmCustomer);
            });
            $(".btnDelete").on('click',function () {
                let idCustomer = $(this).attr('data-idCustomer');
                let params = {
                    id      : idCustomer,
                    del_flg : 1
                };
                let page = window.location.hash.replace('#', '');
                let lengthItemOfPage = $("tbody#tbodyFloor").find("tr").length;
                page = (lengthItemOfPage === 1) ? (page - 1) : page;
                let dataObj = {
                    url             : objDataView.url_AddOrModifyOrDeleteInstance,
                    url_load_page   : objDataView.url_customers_by_pagination + page,
                    page            :  page ,
                    eleContainer    : objDataView.eleContainer,
                    frmInstanceData : params,
                    frmInstance     : objDataView.frmCustomer
                };
                categoryModule.AddOrModifyOrDeleteInstance(dataObj,paginationModule);
            });
        });
        function getDetailCustomer(id,frmCustomer){
            if(id == 0 ){
                categoryModule.resetFrm(frmCustomer,"Add");
                return;
            }
            categoryModule.resetFrm(frmCustomer,"Edit");
            let dataObj = {
                url         : '/getByIdCustomer/'+id,
                frmInstance : frmCustomer
            };
            categoryModule.getById(dataObj);
        }

    </script>
@endsection