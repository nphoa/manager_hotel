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
                            <th>Floor name</th>
                            <th>Room number</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="tbodyFloor">
                        <tr style="display: none" id="rowElement">
                            <td data-floor_name></td>
                            <td data-room_number></td>
                            <td data-custome>
                                <div>
                                    <button class="btn btn-outline btn-success  dim" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i></button>
                                    <button class="btn btn-outline btn-primary dim" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-outline btn-danger  dim " type="button"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        @foreach($floors as $key => $floor)
                            <tr>
                                <td>{{$floor->floor_name}}</td>
                                <td>{{$floor->room_number}}</td>
                                <td>
                                    <div>
                                        <button class="btn btn-outline btn-success  dim" type="button" onclick="getDetailFloor(0)" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i></button>
                                        <button class="btn btn-outline btn-primary dim" type="button" onclick="getDetailFloor({{$floor->id}})" data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit"></i></button>
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
{!! $floors->render() !!}

