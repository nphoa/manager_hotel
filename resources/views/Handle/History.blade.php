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


    <div id="history_container">
        @include('Partials.AjaxView.History_Ajax')
    </div>



    {{--End Modal--}}
    <script src="{{asset('js/Common/server.Module.js')}}"></script>
    <script src="{{asset('js/Common/common.Module.js')}}"></script>
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.pagination a',function(event)
            {
                event.preventDefault();
                 $('li').removeClass('active');
                 $(this).parent('li').addClass('active');

                //
                let myurl = $(this).attr('href');
                let page= (myurl.split('page='))[1];
                alert(page);
                //
                let objPagination = {
                    method       : 'GET',
                    url          : '/history?page=' + page,
                    datatype     : "HTML",
                    headers      :  '',
                    data         :  ''
                };

                let htmlData = serverModule.callServiceByAjax(objPagination);

                $("div#history_container").empty().html(htmlData);
                // let objPagination = {
                //     url          : '/history?page=' + page,
                //     page         :  page,
                //     eleContainer  : $("#history_container")
                // };
                // paginationModule.getDataPagination(objPagination);
            });
        });
    </script>

@endsection