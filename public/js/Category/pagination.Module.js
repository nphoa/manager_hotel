var paginationModule = (function(){
    function getDataPagination(objPagination) {
        $.ajax({
            url     : objPagination.url,
            method  :'GET',
            datatype: "HTML",
            success : function (html) {
                objPagination.eleContainer.empty().html(html);
                location.hash = objPagination.page;
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }

    return {
        getDataPagination :getDataPagination

    }
}());