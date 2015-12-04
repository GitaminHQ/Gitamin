<!-- First time welcome Modal -->
<div class="modal fade" id="welcome-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <header>
                    {{ trans('dashboard.welcome.welcome') }}
                </header>

                <p>
                    {{ trans('dashboard.welcome.message') }}
                </p>

                <div class="get-started">
                    <div class="row">
                        <div class="col-md-4 animated fadeInDown">
                            <a href="{{ route('dashboard.projects.add') }}">
                                <i class="fa fa-browsers"></i>
                                {{ trans('dashboard.welcome.steps.project') }}
                            </a>
                        </div>
                        <div class="col-md-4 animated fadeInDown two">
                            <a href="{{ route('dashboard.issues.add') }}">
                                <i class="fa fa-exclamation-circle"></i>
                                {{ trans('dashboard.welcome.steps.issue') }}
                            </a>
                        </div>
                        <div class="col-md-4 animated fadeInDown three">
                            <a href="{{ route('dashboard.settings.theme') }}">
                                <i class="fa fa-paper-outline"></i>
                                {{ trans('dashboard.welcome.steps.customize') }}
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 animated fadeInDown">
                            <a href="{{ route('dashboard.group.add') }}">
                                <i class="fa fa-people"></i>
                                {{ trans('dashboard.welcome.steps.team') }}
                            </a>
                        </div>
                        <div class="col-md-4 animated fadeInDown two">
                            <a href="{{ route('dashboard.user') }}">
                                <i class="fa fa-code"></i>
                                {{ trans('dashboard.welcome.steps.api') }}
                            </a>
                        </div>
                        <div class="col-md-4 animated fadeInDown three">
                            <a href="{{ route('dashboard.user') }}">
                                <i class="fa fa-unlock"></i>
                                {{ trans('dashboard.welcome.steps.two-factor') }}
                            </a>
                        </div>
                    </div>
                </div>

                <a href="#" data-dismiss="modal" class="btn btn-success go-dashboard">
                    {{ trans('dashboard.welcome.close') }}
                    <i class="fa fa-angle-double-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
