<style>
    .product-imitation {
        background-color: #f8f8f9 !important;

    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        @foreach($data['rooms'] as $room)

            <div class="col-md-3">
                <div class="ibox">
                    <div class="ibox-content product-box" style="height: 430px">
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
                            <figure class="imghvr-flip-diag-2" style="width: 100%;display: block !important;">
                                <div class="product-imitation" style="height: 120px">
                                    <div>
                                        <div class="code">
                                            <span>
                                                Code : {{$room->room_code}}
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                Name : {{$room->room_name}}
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                Count number : {{$room->number_count}}
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                Staus : {{$room->statusName}}
                                            </span>
                                        </div>
                                        <div>
                                            <span>
                                                 Check In Date  : '2019-09-01'
                                            </span>
                                            <span>
                                                Check Out Date : '2019-09-02'
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <figcaption style="width: 100%">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info">Check in</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info">Check out</button>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info">Room Transfer </button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-w-m btn-info">Room Order </button>
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




</div>