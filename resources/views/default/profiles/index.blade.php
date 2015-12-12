@extends('layout.dashboard')

@section('content')
    <div class="content-panel">
        @if(isset($sub_menu))
        @include('dashboard.partials.sub-sidebar')
        @endif
        <div class="content-wrapper">
            <div class="header sub-header">
                <span class="uppercase">
                    <i class="fa fa-user"></i> {{ trans('gitamin.profiles.profiles') }}
                </span>
                <div class="clearfix"></div>
            </div>
            @include('dashboard.partials.errors')
            <div class="container-fluid container-limited">
               <div class="content">
                    <div class="clearfix">
                        <div class="gray-content-block top-block">
                        This information will appear on your profile.
                        </div>
                        <div class="prepend-top-default"></div>
                        <form class="edit_user form-horizontal" method="POST">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="control-label" for="user_name">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" id="user_name" name="user[name]" required="required" type="text" value="{{ Input::old('user.name', $current_user->username) }}">
                                            <span class="help-block">Enter your name, so people you know can recognize you.</span>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                    <label class="control-label" for="user_public_email">Public email</label>
                                    <div class='col-sm-10'>
                                    <select class="form-control" id="user_public_email" name="user[public_email]"><option value="">Do not show in profile</option>
                                    <option value="admin@example.com">admin@example.com</option></select>
                                    <span class='help-block'>This email will be displayed on your public profile.</span>
                                    </div>
                                    </div>
                                    <div class='form-group'>
                                    <label class="control-label" for="user_website_url">Website</label>
                                    <div class='col-sm-10'><input class="form-control" id="user_website_url" name="user[website_url]" type="text" value="" /></div>
                                    </div>
                                    <div class='form-group'>
                                    <label class="control-label" for="user_location">Location</label>
                                    <div class='col-sm-10'><input class="form-control" id="user_location" name="user[location]" type="text" /></div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="light-well">
                                        <img alt="" class="avatar s160" src="http://www.gravatar.com/avatar/e64c7d89f26bd1972efa854d13d7dd61?s=160&amp;d=identicon">
                                        <div class="clearfix">
                                            <div class="profile-avatar-form-option">
                                            <p class="light">
                                            You can upload an avatar here
                                            <br>
                                            or change it at <a href="http://gravatar.com">gravatar.com</a>
                                            </p>
                                            <hr>
                                            <a class="choose-btn btn btn-sm js-choose-user-avatar-button">
                                            <i class="fa fa-paperclip"></i>
                                            <span>Choose File ...</span>
                                            </a>
                                            &nbsp;
                                            <span class="file_name js-avatar-filename">File name...</span>
                                            <input class="js-user-avatar-input hidden" id="user_avatar" name="user[avatar]" type="file">
                                            <div class="light">The maximum file size allowed is 200KB.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-actions">
                                        <input class="btn btn-success" name="commit" type="submit" value="Save changes">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
               </div>
            </div>
        </div>
    </div>
@stop
