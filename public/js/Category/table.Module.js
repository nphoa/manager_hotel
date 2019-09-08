var tableModule = (function(){
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

    return {
        getDataForTable :getDataForTable

    }
}());