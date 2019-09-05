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

            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box" style="height: 400px">
                        <div class="product-imitation" style="padding: 0px !important;">
                            <img src="https://image.shutterstock.com/image-photo/bright-spring-view-cameo-island-260nw-1048185397.jpg" style="width: 100%">
                        </div>
                        <div class="product-desc" style="padding: 10px !important;">
                            {{--                        <span class="product-price">--}}
                            {{--                            $10--}}
                            {{--                        </span>--}}
                            {{--                        <small class="text-muted">Category</small>--}}
                            {{--                        <a href="#" class="product-name"> Product</a>--}}
                            {{--                        <div class="small m-t-xs">--}}
                            {{--                            Many desktop publishing packages and web page editors now.--}}
                            {{--                        </div>--}}
                            {{--                        <div class="m-t text-righ">--}}
                            {{--                            <a href="#" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>--}}
                            {{--                        </div>--}}
                            <figure class="imghvr-flip-diag-2" style="width: 100%;display: block !important; background-color:{{($room->status == 0 ? '#3955a7':'#ce5375' )}}  !important;">
                                <div class="" style="height: 150px;padding: 0px">
                                    <div style="padding: 10px;text-align: initial">
                                        <div class="room_code">
                                            <span class="titleSpan">Code :</span>
                                            <span>
                                                {{$room->id}}
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
                                            <button type="button" class="btn btn-w-m btn-info" {{$room->status != 0 ? 'disabled' : ''}} data-toggle="modal" data-target="#myModal2" onclick="handleCheckIn({{$room->id}})">Check in</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info" {{$room->status == 0 ? 'disabled' : ''}}>Check out</button>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info" {{$room->status == 0 ? 'disabled' : ''}}>Room Transfer </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info" {{$room->status != 0 ? 'disabled' : ''}}>Room Order </button>
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