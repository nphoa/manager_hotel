var serverModule = (function(){
    async function callServiceByPromiseAjax(objDataSend) {
        let result = null;
        await $.ajax({
             method    : objDataSend.method,
             url       : objDataSend.url,
             headers   : objDataSend.headers,
             data      : objDataSend.data,
             success   : function (response) {
                 // setTimeout(function() {
                 //     resolve(response);
                 // }, 300);
                 // console.log(response);
                 result =  response;
                 // if(response.status == 200){ resolve(response);}
                 // else{
                 //     reject(response)
                 // }
             },
             error   : function (error) {console.log(error)}
        });
         return result;
    }

    return {
        callServiceByPromiseAjax :callServiceByPromiseAjax

    }
}());