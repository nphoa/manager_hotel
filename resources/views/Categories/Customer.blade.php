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
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Customer </h5>
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
                    <div class="row">
                        <div class="col-sm-5 m-b-xs"><select class="form-control-sm form-control input-s-sm inline">
                                <option value="0">Option 1</option>
                                <option value="1">Option 2</option>
                                <option value="2">Option 3</option>
                                <option value="3">Option 4</option>
                            </select>
                        </div>
                        <div class="col-sm-4 m-b-xs">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" name="options" id="option1" autocomplete="off" checked=""> Day
                                </label>
                                <label class="btn btn-sm btn-white">
                                    <input type="radio" name="options" id="option2" autocomplete="off"> Week
                                </label>
                                <label class="btn btn-sm btn-white active">
                                    <input type="radio" name="options" id="option3" autocomplete="off"> Month
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group"><input placeholder="Search" type="text" class="form-control form-control-sm"> <span class="input-group-append"> <button type="button" class="btn btn-sm btn-primary">Go!
                                    </button> </span></div>

                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Full name</th>
                                <th>Birthday</th>
                                <th>Address</th>
                                <th>Phone number</th>
                                <th>Identity card</th>
                                <th>National</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="tbodyCustomer">
                            @foreach($customers as $key => $customer)
                                <tr style="display: none" id="rowElement">
                                    <td data-fullName></td>
                                    <td data-birthday></td>
                                    <td data-address></td>
                                    <td data-phoneNumber></td>
                                    <td data-identityCard></td>
                                    <td data-national></td>
                                    <td data-custome>
                                        <div>
                                            <button class="btn btn-outline btn-success  dim" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-outline btn-primary dim" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-outline btn-danger  dim " type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$customer->fullName}}</td>
                                    <td>{{$customer->birthday}}</td>
                                    <td>{{$customer->address}}</td>
                                    <td>{{$customer->phoneNumber}}</td>
                                    <td>{{$customer->identityCard}}</td>
                                    <td>{{$customer->national}}</td>
                                    <td>
                                        <div>
                                            <button class="btn btn-outline btn-success  dim" type="button" onclick="getDetailCustomer(0)" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i></button>
                                            <button class="btn btn-outline btn-primary dim" type="button" onclick="getDetailCustomer({{$customer->id}})" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-outline btn-danger  dim " type="button"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

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
    <script src="{{asset('js/Category/category.Module.js')}}"></script>
    <script>
        $(document).ready(function () {
            //categoryModule.create(frmCustomerData);
        });
        $("#save").on('click',function () {
            var dataObj = {
                url             : '/create_Customer',
                frmInstanceData : $("form#frmCustomer").serializeArray(),
                rowElement      : $("#rowElement").clone(),
                tbodyInstance   : $("#tbodyCustomer"),
                frmInstance     : $("#frmCustomer")
            };
            categoryModule.create(dataObj);
        });
        function getDetailCustomer(id){
            if(id === 0 ){
                var csrfToken = $("input[name=_token]").val();
                categoryModule.resetFrm($("#frmCustomer"));
                $("input[name=_token]").val(csrfToken);
                return;
            }
            var dataObj = {
                url         : '/getById/'+id,
                frmCustomer : $("#frmCustomer")
            };
            categoryModule.getById(dataObj);
        }

    </script>
@endsection