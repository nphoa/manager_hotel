var serverModule = (function(){
    function validateResponse(response){
        console.log(response.headers.get('Content-Type'));
        if(!response.ok){
            throw new Error('Error request');
        }
        return response;
    }
    function readResponseAsJson(response){
        let content_type = response.headers.get('Content-Type');
        if(content_type == 'application/html')
        {
            return response.text();
        }
        return response.json();
    }
    function logError(error){
        console.log(error);
    }
    async function callServiceByAjax(objDataSend) {
        let result = null;
        let url = objDataSend.url;
        if (objDataSend.method == 'GET'){
            objDataSend = {};
        }
        console.log(objDataSend);
        await fetch(url,objDataSend).then(validateResponse)
            .then(readResponseAsJson)
            .then(data=>{
                result = data;
            })

            .catch(logError);
        console.log(result);
         return result;
    }
    return {
        callServiceByAjax :callServiceByAjax,
    }
}());