var categoryModule = (function(){
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
    function resetFrm(frmInstance,mode) {
        var eleInput =  $(frmInstance).find("input");
        if(mode === "Add"){
            eleInput.val('');
            $(frmInstance).find("input[name=id]").val(0);
        }
        eleInput.parent().parent().removeClass('has-error');
        eleInput.parent().find("span").text('').attr('hidden');

    }
    function AddOrModifyOrDeleteInstance(dataObj,paginationModule){
        $.ajax({
            url     :dataObj.url,
            data    :dataObj.frmInstanceData,
            method  :'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success : function () {
                //Load again new data by pagination
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
                resetFrm(dataObj.frmInstance,"Add");
            }
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            //Error validate server
            if(jqXHR.status === 422){
                var objErrorValidate = jqXHR.responseJSON.errors;
                for (var instanceProp in jqXHR.responseJSON.errors){
                    var inputInstanceProp = dataObj.frmInstance.find("input[name="+instanceProp+"]");
                    inputInstanceProp.parent().find("span").text(objErrorValidate[instanceProp][0]).removeAttr('hidden');
                    inputInstanceProp.parent().parent().addClass('has-error');
                }
            }
        });
    }

    return {
        AddOrModifyOrDeleteInstance : AddOrModifyOrDeleteInstance,
        getById                     : getById,
        resetFrm                    : resetFrm
    }
}());