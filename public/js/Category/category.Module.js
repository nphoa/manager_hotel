var categoryModule = (function(){
    function reloadData(url) {
        $.ajax({
            url     :url,
            method  :'GET',
            success : function (response) {
                var lengthProps = Object.keys(response.data).length;
                console.log(lengthProps);
            }
        });
    }
    function getById(dataObj) {
        $.ajax({
            url     :dataObj.url,
            method  :'GET',
            success : function (response) {
                for(var instance in response.data){
                    $(dataObj.frmInstance).find("input[name="+instance+"]").val(response.data[instance]);
                }
            }
        });
    }
    function resetFrm(frmInstance) {
        $(frmInstance).find("input").val('');
        $(frmInstance).find("input[name=id]").val(0);
    }
    function create(dataObj,paginationModule){
        console.log(dataObj);
        $.ajax({
            url     :dataObj.url,
            data    :dataObj.frmInstanceData,
            method  :'POST',
            success : function (response) {
                var objPagination = {
                    url          : dataObj.url_load_page,
                    page         : dataObj.page,
                    eleContainer : dataObj.eleContainer
                };
                paginationModule.getDataPagination(objPagination);
                // for(var instance in  response.data){
                //     $(dataObj.rowElement).find("td[data-"+instance+"]").text(response.data[instance]);
                // }
                // $(dataObj.rowElement).css('display','');
                // $(dataObj.tbodyInstance).append(dataObj.rowElement);
                resetFrm(dataObj.frmInstance);

            }
        });
    }
    return {
        create   :create,
        getById  :getById,
        resetFrm :resetFrm
    }
}());