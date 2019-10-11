var serverModule = (function(){
    function validateResponse(response){
        if(!response.ok){
            throw new Error('Error request');
        }
        return response;
    }
    function readResponseAsJson(response){
        console.log(response);
        return response.json();
    }
    function logError(error){
        console.log(error);
    }
    async function callServiceByAjax(objDataSend) {
        let result = null;

        // let promise = await $.ajax({
        //      method    : objDataSend.method,
        //      url       : objDataSend.url,
        //      headers   : objDataSend.headers,
        //      data      : objDataSend.data,
        //      dataType  : objDataSend.datatype,
        //      success   : function (response,textStatus,xhr) {
        //          if(xhr.status === 200){
        //              result =  response;
        //          }
        //      },
        //      error   : function (error) {console.log(error)}
        // });'Content-Type': 'application/json'
        objDataSend.headers = 'Content-Type:application/html';
        console.log(objDataSend);
         await fetch(objDataSend.url).then(validateResponse)
                                                 .then(readResponseAsJson)
                                                 .then(data=>{
                                                     result = data;
                                                 })
         .catch(logError);
         return result;
    }
    async function callServiceByAjax2(objDataSend) {
        let result = null;

        // let promise = await $.ajax({
        //      method    : objDataSend.method,
        //      url       : objDataSend.url,
        //      headers   : objDataSend.headers,
        //      data      : objDataSend.data,
        //      dataType  : objDataSend.datatype,
        //      success   : function (response,textStatus,xhr) {
        //          if(xhr.status === 200){
        //              result =  response;
        //          }
        //      },
        //      error   : function (error) {console.log(error)}
        // });'Content-Type': 'application/json'
        //objDataSend.headers = 'Content-Type:application/html';
        console.log(objDataSend);
        await fetch(objDataSend.url,objDataSend).then(validateResponse)
            .then(readResponseAsJson)
            .then(data=>{
                result = data;
            })
            .catch(logError);
        return result;
    }
    return {
        callServiceByAjax :callServiceByAjax,
        callServiceByAjax2:callServiceByAjax2
    }
}());