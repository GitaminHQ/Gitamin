@extends('layout.master')

@section('content')
<div class="col-xs-6 col-sm-3 sidebar">
<img src="{{ $user->avatar }}" style="width:230px; height: 230px;">
<h1>{{ $user->username }}</h1>
</div>
<div class="col-xs-12 col-sm-9 main">
<div class="header row">
    <div class="col-sm-12">
      <h4>Profile</h4>
    </div>
  </div>
</div>
@endsection