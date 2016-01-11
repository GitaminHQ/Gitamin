@extends('layout.profile')

@section('content')

<div class="row">
    <div class="col-xs-6 col-sm-3 sidebar">
        <div class="list-group">
            <div class="list-group-item active">Profile Settings</div>
            <a href="#" class="list-group-item">Account</a>
            <a href="#" class="list-group-item">Applications</a>
            <a href="#" class="list-group-item">Emails</a>
            <a href="#" class="list-group-item">Password</a>
            <a href="#" class="list-group-item">Notifcations</a>
            <a href="#" class="list-group-item">SSH Keys</a>
            <a href="#" class="list-group-item">Preferences</a>
        </div>
    </div>
    <div class="col-xs-12 col-sm-9 main">
    @include('dashboard.partials.errors')
        <div class="panel panel-default">
        <div class="panel-heading">{{ trans('gitamin.profiles.profiles') }}</div>
        <div class="panel-body">
            <form class="edit_user form-horizontal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user_name">Name</label>
                            <div class="col-sm-6">
                                <input class="form-control" id="user_name" name="user[name]" required="required" type="text" value="{{ Input::old('user.name', $current_user->name) }}">
                                <span class="help-block">Enter your name, so people you know can recognize you.</span>
                            </div>
                        </div>
                        <div class='form-group'>
                        <label class="col-md-4 control-label" for="user_public_email">Public email</label>
                        <div class='col-sm-6'>
                        <select class="form-control" id="user_public_email" name="user[public_email]"><option value="">Do not show in profile</option>
                        <option value="admin@example.com">admin@example.com</option></select>
                        <span class='help-block'>This email will be displayed on your public profile.</span>
                        </div>
                        </div>
                        <div class='form-group'>
                        <label class="col-md-4 control-label" for="user_website_url">Website</label>
                        <div class='col-sm-6'><input class="form-control" id="user_website_url" name="user[website_url]" type="text" value="{{ Input::old('user.website_url', $current_user->website_url) }}" /></div>
                        </div>
                        <div class='form-group'>
                        <label class="col-md-4 control-label" for="user_location">Location</label>
                        <div class='col-sm-6'><input class="form-control" id="user_location" name="user[location]" type="text" value="{{ Input::old('user.location', $current_user->location) }}" /></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div id="dropzone" class="dropzone">
                            <div class="well well-drop-zone">Drag and drop files to upload.</div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-actions text-center">
                            <input class="btn btn-success" name="commit" type="submit" value="Save changes">
                            <a class="btn btn-cancel" href="{{ back_url('owners.owner_show', ['owner' => $current_user->username]) }}">{{ trans('forms.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection