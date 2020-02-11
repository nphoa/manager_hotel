var commonModule = (function(){
    function getDataForTable(tbodyElement) {
        var data = [];
        tbodyElement.find("tr").each(function (index,tr) {
            let objDataTr = {};
            let countProps = $(tr).find("td").length;
            for (let i = 0;i <= countProps ; i++){
                let td = $(tr).find("td:eq("+i+")");
                if(td.children().attr("name") !== undefined){
                    if(td.children().is("input[type=checkbox]")){
                        if(td.children().is(":checked")){
                            objDataTr[td.children().attr("name")] = 1;
                        }else{
                            objDataTr[td.children().attr("name")] = 0;
                        }
                    }else{
                        objDataTr[td.children().attr("name")] = td.children().val();
                    }
                }

            }
            data.push(objDataTr);
        });
        return data;
    }
    function checkObjectExistInArrayByKeyName(array,keyName) {
        let result = false;
        for (let obj of array){
            if(obj.name === keyName){
                result = true;
                break;
            }
        }
        return result;
    }
    function getDataForForm(form) {
        var data = [];
        form.find("input,textarea").each(function (index,input) {
            let objProp = {};
            if(checkObjectExistInArrayByKeyName(data,$(input).attr('name')) === false){
                if($(input).is('input[type=radio]') && $(input).is(':checked') === false ){
                    //Note : Dùng return false trong if else của function each js thì là như  lệnh break trong php
                    //Note : Dùng return  trong if else của function each js thì là như  lệnh continue trong php
                    return;
                }
                objProp.name = $(input).attr('name');
                objProp.value = $(input).val();
                data.push(objProp);
            }

        });

        return data;
    }
    return {
        getDataForTable :getDataForTable,
        getDataForForm:getDataForForm

    }
}());