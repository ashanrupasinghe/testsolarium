<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview-2">
                        {% if ((file.name).split('.').pop()=='pdf') { %}
                    <i class="fa fa-file-pdf fa-2x"></i>
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['docx','doc','dot','wbk','docm','dotx','dotm','docb'] )!=-1){ %}
                    <i class="fa fa-file-word fa-2x"></i>
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['xlsx','xlsm','xltx','xltm','xls','xlt','xlm'] )!=-1){ %}
                    <i class="fa fa fa-file-excel fa-2x"></i>                
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['gpg','png','gif'] )!=-1){ %}
                    <i class="fa fa-image fa-2x"></i>
                {% }else { %}
                    <i class="fa fa-file fa-2x"></i>
                {% } %}
                    </span>
        </td>
        <td>
            {% if (window.innerWidth > 480 || !o.options.loadImageFileTypes.test(file.type)) { %}
                <p class="name">{%=file.name%}</p>
            {% } %}
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload angular-btn"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle angular-btn"></i>                    
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview-2">
               {% if ((file.name).split('.').pop()=='pdf') { %}
                    <i class="fa fa-file-pdf fa-2x"></i>
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['docx','doc','dot','wbk','docm','dotx','dotm','docb'] )!=-1){ %}
                    <i class="fa fa-file-word fa-2x"></i>
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['xlsx','xlsm','xltx','xltm','xls','xlt','xlm','csv'] )!=-1){ %}
                    <i class="fa fa fa-file-excel fa-2x"></i>                
                {% }else if(jQuery.inArray( (file.name).split('.').pop(), ['gpg','png','gif'] )!=-1){ %}
                    <i class="fa fa-image fa-2x"></i>
                {% }else { %}
                    <i class="fa fa-file fa-2x"></i>
                {% } %} 
            </span>
        </td>
        <td>
            {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%= (file.name).split(/-(.+)/)[1] %}</a>                        
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
				<input type="hidden" name="file_list[]" value="{%=file.name%}">
            {% } %}
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
			
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <a class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash angular-btn"></i>                    
                </button>                
            {% } else { %}
                <a class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle angular-btn"></i>                    
                </a>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{ URL::asset('/plugins/uploader/js/vendor/jquery.ui.widget.js') }}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>

<!-- Not needed, if images will be rejected -->
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.iframe-transport.js') }}"></script>
<!-- The basic File Upload plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload.js') }}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-process.js') }}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-image.js') }}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-audio.js') }}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-video.js') }}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-validate.js') }}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{ URL::asset('/plugins/uploader/js/jquery.fileupload-ui.js') }}"></script>
<!-- The main application script -->
<script>
/* global $, window */

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        
		url: '/libraries/uploader/server/php/?booking_id=111',
        limitMultiFileUploads: 10, //This option is ignored, if singleFileUploads is set to true or limitMultiFileUploadSize is set and the browser reports file sizes.
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(docx|pdf|gif|jpe?g|png|csv|doc|dot|wbk|docm|dotx|dotm|docb|xlsx|xlsm|xltx|xltm|xls|xlt|xlm)$/i,
        //acceptFileTypes: /(\.|\/)(avi|webm|flv|mkv|vob|ogv|ogg|drc|gifv|mng|mov|qt|wmv|yuv|rm|rmvb|asf|amv|mp4|m4p|m4v|mpg|mp2|mpeg|mpe|mpv|m2v|svi|3gp|3g2|mxf|roq|nsv|flv|f4v|f4p|f4a|f4b)$/i,
        maxFileSize: 5000000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                    /\/[^\/]*$/,
                    '/cors/result.html?%s'
                    )
            );

    // Load existing files:
    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done')
                .call(this, $.Event('done'), {
                    result: result
        });
        
        if(typeof ($('#approval_attached_visble_box')) != 'undefined'){//// has check box "Select only if Approval is attached" disable if no files
                    var num_of_files = $('#fileupload').fileupload('option').getNumberOfFiles();
                    if(num_of_files>0){
                        $("#approval_attached_visble_box").removeAttr("disabled");
                    }
        }
        
        
    });

    $('#fileupload')
            .bind('fileuploadsubmit', function (e, data) {
                data.context.find('.preview').addClass('load_image');
            })
            .bind('fileuploaddone', function (e, data) {
                data.context.find('.preview').toggleClass('load_image');  
                if(typeof ($('#approval_attached_visble_box')) != 'undefined'){// has check box "Select only if Approval is attached" and has files-> enable
                    $("#approval_attached_visble_box").removeAttr("disabled");
                }
            })            
            .bind('fileuploaddestroyed', function (e, data) {                
                if(typeof ($('#approval_attached_visble_box')) != 'undefined'){//// has check box "Select only if Approval is attached" disable if no files
                    var num_of_files = $('#fileupload').fileupload('option').getNumberOfFiles();
                    if(num_of_files==0){
                        $("#approval_attached_visble_box").attr("disabled","disabled");
                    }
                }
                
                
        
            });
});

</script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="/assets/plugins/uploader/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->