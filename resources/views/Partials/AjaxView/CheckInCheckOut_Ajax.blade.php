<style>
    .product-imitation {
        background-color: #f8f8f9 !important;

    }
    span.titleSpan{
        font-weight: bold;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach($data['rooms'] as $room)
            @if ($room->status == 0)
                <?php $backgroundColor = '#0430b1'; ?>
            @elseif ($room->status == 1)
                <?php $backgroundColor = '#ce5375'; ?>
            @elseif($room->status == 2)
                <?php $backgroundColor = '#493163';?>
            @else
                <?php $backgroundColor = '#515667'; ?>
            @endif

            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box" style="height: 400px">
                        <div class="product-imitation" style="padding: 0px !important;">
                            <img src="https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg" style="width: 100%">
                        </div>
                        <div class="product-desc" style="padding: 10px !important;">
                            <figure class="imghvr-flip-diag-2" style="width: 100%;display: block !important; background-color:{{$backgroundColor}}  !important;">
                                <div class="" style="height: 150px;padding: 0px">
                                    <div style="padding: 10px;text-align: initial">
                                        <div class="room_code">
                                            <span class="titleSpan">Code :</span>
                                            <span>
                                                {{$room->room_id}}
                                            </span>
                                        </div>
                                        <div class="room_name">
                                            <span class="titleSpan">Name :</span>
                                            <span>
                                                {{$room->room_name}}
                                            </span>
                                        </div>
                                        <div class="number_count">
                                            <span class="titleSpan">Count number :</span>
                                            <span>
                                                {{$room->number_count}}
                                            </span>
                                        </div>
                                        <div class="statusName">
                                            <span class="titleSpan">Staus :</span>
                                            <span>
                                                 {{UtilHelpers::getStatusName($room->status)}}
                                            </span>
                                        </div>
                                        <div class="timeCheckIn">
                                            <span class="titleSpan">Check In Date  :</span>
                                            <span>
                                                 {{$room->date_check_in}}
                                            </span>
                                        </div>
                                        <div class="timeCheckOut">
                                            <span class="titleSpan">Check Out Date :</span>
                                            <span>
                                                  {{$room->date_check_out}}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <figcaption style="width: 100%">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                    class="btn btn-w-m btn-info"
                                                    {{$room->status != 0 ? 'disabled' : ''}}
                                                    data-toggle="modal"
                                                    data-target="#myModal2"
                                                    data-room_id= "{{$room->room_id}}"
                                                    data-room_register_id="0"
                                                    data-mode="CheckIn"
                                                    onclick="handle(this)">
                                                Check in</button>
                                        </div>

                                        <div class="col-md-6">
                                            <button type="button"
                                                    class="btn btn-w-m btn-info"
                                                    {{($room->status == 0 || $room->status == 2) ? 'disabled' : ''}}
                                                    data-toggle="modal"
                                                    data-target="#myModal2"
                                                    data-room_id = "{{$room->room_id}}"
                                                    data-room_register_id = "{{$room->room_register_id}}"
                                                    data-mode="CheckOut"
                                                    onclick="handle(this)">
                                                Check out</button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button"
                                                    class="btn btn-w-m btn-info"
                                                    {{$room->status == 0 ? 'disabled' : ''}}
                                                    data-toggle="modal"
                                                    data-target="#myModal2"
                                                    data-room_id = "{{$room->room_id}}"
                                                    data-room_register_id = "{{$room->room_register_id}}"
                                                    data-number_customer = "{{$room->number_count}}"
                                                    data-mode="Update"
                                                    onclick="handle(this)">
                                                Update</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                    class="btn btn-w-m btn-info"
                                                    {{$room->status != 0 ? 'disabled' : ''}}
                                                    data-toggle="modal"
                                                    data-target="#myModal2"
                                                    data-room_id = "{{$room->room_id}}"
                                                    data-room_register_id = "0"
                                                    data-number_customer = "{{$room->number_count}}"
                                                    data-mode="Order"
                                                    onclick="handle(this)">
                                                Room Order
                                            </button>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach




    </div>

    <div>
        {{$data['rooms']->links()}}

    </div>


</div>