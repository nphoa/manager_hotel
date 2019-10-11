@extends('Templates.layout')
@section('content')

    <div>
        <button id="uploadImage" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">Upload image</button>
    </div>
    <div id="instance_container_ajax">
        @include('Partials.AjaxView.Image_Ajax')
    </div>

    {{--Modal--}}
    <div>
        <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="" id="frmUpload" enctype="multipart/form-data">
                    <div class="modal-content animated flipInY" style="width: 900px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Modal title</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12">
                            <div class="ibox">
                                <div class="ibox-title">
                                    <h5>Upload image</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li><a href="#" class="dropdown-item">Config option 1</a>
                                            </li>
                                            <li><a href="#" class="dropdown-item">Config option 2</a>
                                            </li>
                                        </ul>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content" style="">
                                    <div  id="drag_files" class="drag-drop"  action="" enctype="multipart/form-data" style="border:1px dashed #1ab394;padding: 20px 20px;min-height:120px  ">
                                        <div class="drag-files-label" style="cursor: pointer;text-align: center;font-size: 16px">
                                            <span><strong>Drop files here or click to upload. </strong><br> (This is just a demo dropzone. Selected files are not actually uploaded.)</span>
                                        </div>
                                        <input name="file" type="file" style="text-align: center"/>
                                    </div>
                                    <div style="width: 300px;height: 300px">
                                        <img src="" alt="" id="imgReview" style="width: 300px;height: 300px" hidden>
                                        <canvas style="border:1px solid grey;width: 300px;height: 300px" id="mycanvas"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save">Save changes</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>




    {{--End Modal--}}
    <h1 id="h1">Demo</h1>
    <script src="{{asset('js/Category/pagination.Module.js')}}"></script>
    <script src="{{asset('js/Category/category.Module.js')}}"></script>
    <script src="{{asset('js/Common/server.Module.js')}}"></script>
    <script>
        $(document).ready(function () {


        });
        var droppedFiles;
        var isAdvancedUpload = true;

        (function (document, window, index,$) {
            // auto upload image on file upload
            // feature detection for drag&drop upload
            isAdvancedUpload = function () {
                var div = document.createElement('div');
                return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
            }();
            if (isAdvancedUpload)
            {
                var form = document.getElementById("drag_files");
                var input = form.querySelector('input[type="file"]');

                // needed for ajax upload
                // var ajaxFlag = document.createElement('input');
                // ajaxFlag.setAttribute('type', 'hidden');
                // ajaxFlag.setAttribute('name', 'ajax');
                // ajaxFlag.setAttribute('value', 1);
                // form.appendChild(ajaxFlag);

                ['drag', 'dragstart', 'dragend', 'dragover', 'dragenter', 'dragleave', 'drop'].forEach(function (event) {
                    form.addEventListener(event, function (e) {
                        //alert('2');
                        // preventing the unwanted behaviours
                        e.preventDefault();
                        e.stopPropagation();
                    });
                });

                ['dragover', 'dragenter'].forEach(function (event) {
                    form.addEventListener(event, function () {
                        form.classList.add('dragover');
                    });
                });

                ['dragleave', 'dragend', 'drop'].forEach(function (event) {
                    form.addEventListener(event, function () {
                        form.classList.remove('dragover');
                    });
                });

                form.addEventListener('drop', function (e) {
                    droppedFiles = e.dataTransfer.files; // the files that were dropped
                    if (droppedFiles.length > 0)
                    {
                        form.querySelector(".drag-files-label").innerHTML = droppedFiles[0].name;
                        console.log(droppedFiles[0]);
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            //$('#imgReview').attr('src', e.target.result).removeAttr('hidden');
                            var image = new Image();
                            image.src = e.target.result;
                            image.onload = function(ev) {
                                var canvas = document.getElementById('mycanvas');
                                canvas.width = image.width;
                                canvas.height = image.height;
                                var ctx = canvas.getContext('2d');
                                ctx.drawImage(image,0,0);
                            }
                        };
                        reader.readAsDataURL(droppedFiles[0]);

                        //var event = document.createEvent('HTMLEvents');
                        //event.initEvent('submit', true, false);
                        //form.dispatchEvent(event);
                    }
                });
                let frmUpload = document.getElementById("frmUpload");
                frmUpload.addEventListener('submit', function (e) {

                    if (form.classList.contains('uploading'))
                        return false;

                    form.classList.add('uploading');
                    //form.classList.remove('is-error');

                    if (isAdvancedUpload) // ajax file upload for modern browsers
                    {
                        e.preventDefault();
                        var ajaxData = new FormData(frmUpload);
                        if (droppedFiles) {
                            ajaxData.append('file', droppedFiles[0]);
                            console.log(ajaxData.get('file'));
                        }

                        objSendToServer = {
                            method    : 'POST',
                            url       : '/uploadImage',
                            body      : ajaxData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType  : '',
                        };
                        $result = serverModule.callServiceByAjax2(objSendToServer);
                        // ajax request
                        // var ajax = new XMLHttpRequest();
                        // ajax.open(form.getAttribute('method'), form.getAttribute('action'), true);
                        //
                        // ajax.onload = function () {
                        //     console.log('ajax onload');
                        //     form.classList.remove('uploading');
                        //     if (ajax.status >= 200 && ajax.status < 400) {
                        //         console.log('win');
                        //     }
                        //     else {
                        //         console.log('whoops');
                        //         alert('Error. Please, contact the webmaster!');
                        //     }
                        // };
                        //
                        // ajax.send(ajaxData);
                    }
                });
            }
        }(document, window, 0,$));


        function retrieveImageFromClipboardAsBlob(pasteEvent, callback){
            if(pasteEvent.clipboardData == false){
                if(typeof(callback) == "function"){
                    callback(undefined);
                }
            };

            var items = pasteEvent.clipboardData.items;

            if(items == undefined){
                if(typeof(callback) == "function"){
                    callback(undefined);
                }
            };

            for (var i = 0; i < items.length; i++) {
                // Skip content if not image
                if (items[i].type.indexOf("image") == -1) continue;
                // Retrieve image on clipboard as blob
                var blob = items[i].getAsFile();
                droppedFiles = blob;
                if(typeof(callback) == "function"){
                    callback(blob);
                }
            }
        }

        window.addEventListener("paste", function(e){

            // Handle the event
            retrieveImageFromClipboardAsBlob(e, function(imageBlob){
                // If there's an image, display it in the canvas
                if(imageBlob){
                    var canvas = document.getElementById("mycanvas");
                    var ctx = canvas.getContext('2d');

                    // Create an image to render the blob on the canvas
                    var img = new Image();

                    // Once the image loads, render the img on the canvas
                    img.onload = function(){
                        // Update dimensions of the canvas with the dimensions of the image
                        canvas.width = this.width;
                        canvas.height = this.height;

                        // Draw the image
                        ctx.drawImage(img, 0, 0);
                    };

                    // Crossbrowser support for URL
                    var URLObj = window.URL || window.webkitURL;

                    // Creates a DOMString containing a URL representing the object given in the parameter
                    // namely the original Blob
                    img.src = URLObj.createObjectURL(imageBlob);
                }
            });
        }, false);

        $('#test').on('click',function () {
            var canvas = document.getElementById("mycanvas");
            console.log(canvas.toDataURL());
        });


        window.addEventListener('load', function() {
            document.querySelector('input[type="file"]').addEventListener('change', function() {
                console.log(this.files);
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        //$('#imgReview').attr('src', e.target.result).removeAttr('hidden');
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function(ev) {
                            var canvas = document.getElementById('mycanvas');
                            canvas.width = image.width;
                            canvas.height = image.height;
                            var ctx = canvas.getContext('2d');
                            ctx.drawImage(image,0,0);
                        }
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });

    </script>
@endsection




