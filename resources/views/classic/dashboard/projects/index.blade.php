@extends('layout.project')

@section('content')
    @include('dashboard.partials.breadcrumb')
<div class="row">
     <div class="col-xs-12 col-sm-9 main">
     @include('dashboard.partials.errors')
     222
     </div>

     <div class="col-xs-6 col-sm-3 sidebar-offcanvas">
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