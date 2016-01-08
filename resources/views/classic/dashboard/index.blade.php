@extends('layout.dashboard')

@section('body')
@include('dashboard.partials.navigation')
<div class="container">
    <div class="row">
         <div class="col-xs-12 col-sm-9 moments">
         @include('dashboard.partials.errors')
            @foreach($moments as $moment)
            @include('moments.partials.' . $moment->template)
            @endforeach
         </div>

         <div class="col-xs-6 col-sm-3 sidebar">
             <div class="list-group">
                <div class="list-group-item active">Your Projects</div>
                @foreach($projects as $project)
                <a href="{{ $project->url }}" class="list-group-item"><i class="octicon octicon-repo"></i> {{ $project->name }}</a>
                @endforeach
              </div>
              <div class="list-group">
                <div class="list-group-item active">Starred Projects</div>
                @foreach($projects as $project)
                <a href="{{ $project->url }}" class="list-group-item"><i class="octicon octicon-repo"></i> {{ $project->name }}</a>
                @endforeach
              </div>
         </div>
    </div>
</div>
@endsection