var paginationModule = (function(){

    $(document).on('click', '.pagination a',function(event)
    {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        let myurl = $(this).attr('href');
        let page= (myurl.split('page='))[1];
        let objPagination = {
            url          :  new URL(myurl).pathname +'?page='+ page,
            page         :  page,
            eleContainer  : $("#instance_container")
        };
        getDataPagination(objPagination);

    });

    function getDataPagination(objPagination) {
        $.ajax({
            url     : objPagination.url,
            method  :'GET',
            datatype: "HTML",
            success : function (html) {
                objPagination.eleContainer.empty().html(html);
                //location.origin;
                //console.log(location.origin);
                //location.search = '?page=2';
                //location.hash = objPagination.page;

                history.replaceState({}, null, objPagination.url);
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }
    return {
        getDataPagination :getDataPagination
    }
}());