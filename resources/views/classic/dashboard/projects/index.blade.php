@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
<div class="row">
     <div class="col-xs-12 col-sm-9 main">
     @include('dashboard.partials.errors')
         @foreach($projects as $project)
        <div class="repository">
            <div class="repository-header">
                <span class="fa fa-folder-open"></span>  <a href="{{ $project->url }}">{{ $project->name }}</a>
                <a href=""><span class="fa fa-rss rss-icon pull-right"></span></a>
            </div>
            <div class="repository-body">
                @if($project->description)
                <p>{{ $project->description }}</p>
                @else
                <p>There is no repository description file. Please, create one to remove this message.</p>
                @endif
            </div>
        </div>
        @endforeach
     </div>

     <div class="col-xs-6 col-sm-3 sidebar">
         <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
     </div>
</div>
@endsection