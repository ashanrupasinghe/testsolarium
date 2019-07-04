@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Search result {{'NumFound: ' . $resultset->getNumFound()}}</div>
				<!--display the total number of documents found by solr-->
				
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					@if($resultset->getNumFound()>0)
						<div class="row">
					@endif
						@foreach ($resultset as $document)
							<div class="col-md-3 col-ms-3">
							{{$document->id}}: <a href="{{implode(', ', $document->attr_file_path)}}" target="_blank">{{implode(', ', $document->attr_file_path)}}</a>
							</div>
						@endforeach
					@if($resultset->getNumFound()>0)
						</div>
					@endif			                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


