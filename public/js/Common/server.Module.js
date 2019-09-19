var serverModule = (function(){
    async function callServiceByAjax(objDataSend) {
        let result = null;
        await $.ajax({
             method    : objDataSend.method,
             url       : objDataSend.url,
             headers   : objDataSend.headers,
             data      : objDataSend.data,
             success   : function (response,textStatus,xhr) {
                 if(xhr.status === 200){
                     result =  response;
                 }
             },
             error   : function (error) {console.log(error)}
        });
         return result;
    }

    return {
        callServiceByAjax :callServiceByAjax

    }
}());