@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Upload</div>
				<!--display the total number of documents found by solr-->
				
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif	
<div class="panel panel-default vehicle_more_info_additional_info">                                
                                <div class="" in role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <span class="file-select-lable">Please attach any supporting documentation if available (i.e. Approval forms, confirmations…)</span>
                                        <!--<input type="file" name="file[]" id="file-1" class="inputfile inputfile-1 hide" data-multiple-caption="{count} files selected" multiple accept=".pdf,.doc,.docx,image/*,.xls,.xlsx,.txt" />
                                        <label for="file-1"><i class="fas fa-download"></i> <span>Choose a file</span></label>
                                        <div class="clearfix">&nbsp;</div>-->
                                        <div id="fileupload" class="add-booking-file-upload">
                                            <!-- Redirect browsers with JavaScript disabled to the origin page -->

                                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-7">
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn btn-success fileinput-button">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                        <span>Add files...</span>
                                                        <input type="file" name="files[]" data-url="/upload" multiple>
                                                    </span>                                                    
                                                    <!-- The global file processing state -->
                                                    <span class="fileupload-process"></span>
                                                </div>
                                                <!-- The global progress state -->
                                                <div class="col-lg-5 fileupload-progress fade">
                                                    <!-- The global progress bar -->
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                    </div>
                                                    <!-- The extended global progress state -->
                                                    <div class="progress-extended">&nbsp;</div>
                                                </div>
                                            </div>
                                            <!-- The table listing the files available for upload/download -->
                                            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>


                                        </div>
                                    </div>
                                </div>
                            </div>
                                    </div>					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


