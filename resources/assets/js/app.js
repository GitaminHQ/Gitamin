$(function() {
    // Ajax Setup
    $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
        var token;
        if (! options.crossDomain) {
            token = $('meta[name="token"]').attr('content');
            if (token) {
                jqXHR.setRequestHeader('X-CSRF-Token', token);
            }
        }

        return jqXHR;
    });

    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Accept', 'application/json');
            // xhr.setRequestHeader('Content-Type', 'application/json; charset=utf-8');
        },
        statusCode: {
            401: function () {
                window.location.href = '/';
            },
            403: function () {
                window.location.href = '/';
            }
        }
    });

    // Prevent double form submission
    $('form').submit(function() {
        var $form = $(this);
        $form.find(':submit').prop('disabled', true);
    });

    // Autosizing of textareas.
    autosize($('textarea.autosize'));

    // Select2
    $(".select2").select2();

    // Mock the DELETE form requests.
    $('[data-method]').not(".disabled").append(function() {
        var methodForm = "\n";
        methodForm    += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n";
        methodForm    += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n";
        if ($(this).attr('data-token')) {
            methodForm += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n";
        }
        methodForm += "</form>\n";
        return methodForm;
    })
        .removeAttr('href')
        .on('click', function() {
            var button = $(this);

            if (button.hasClass('confirm-action')) {
                askConfirmation(function() {
                    button.find("form").submit();
                });
            } else {
                button.find("form").submit();
            }
        });

    // Messenger config
    Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top',
        theme: 'air'
    };

    // App setup
    window.Gitamin = {};

    moment.locale(Global.locale);

    $('abbr.timeago').each(function () {
        var $el = $(this);
        $el
            .livestamp($el.data('timeago'))
            .tooltip();
    });

    window.Gitamin.Notifier = function () {
        this.notify = function (message, type, options) {
            type = (typeof type === 'undefined' || type === 'error') ? 'error' : type;

            var defaultOptions = {
                message: message,
                type: type,
                showCloseButton: true
            };

            options = _.extend(defaultOptions, options);

            Messenger().post(options);
        };
    };

    $(".sidebar-toggler").click(function(e) {
        e.preventDefault();
        $(".wrapper").toggleClass("toggled");
    });

    $('.color-code').minicolors({
        control: 'hue',
        defaultValue: $(this).val() || '',
        inline: false,
        letterCase: 'lowercase',
        opacity: false,
        position: 'bottom left',
        theme: 'bootstrap'
    });

    $('[data-toggle="tooltip"]').tooltip();

    $('button.close').on('click', function() {
        $(this).parents('div.alert').addClass('hide');
    });

    // Date picker.
    $('input[rel=datepicker]').datetimepicker({
        format: "DD/MM/YYYY HH:mm",
        minDate: new Date(), // Don't allow dates before today.
        sideBySide: true,
        icons: {
            time: 'ion-clock',
            date: 'ion-android-calendar',
            up: 'ion-ios-arrow-up',
            down: 'ion-ios-arrow-down',
            previous: 'ion-ios-arrow-left',
            next: 'ion-ios-arrow-right',
            today: 'ion-android-home',
            clear: 'ion-trash-a',
        }
    });

    $('input[rel=datepicker-any]').datetimepicker({
        format: "DD/MM/YYYY HH:mm",
        sideBySide: true,
        icons: {
            time: 'ion-clock',
            date: 'ion-android-calendar',
            up: 'ion-ios-arrow-up',
            down: 'ion-ios-arrow-down',
            previous: 'ion-ios-arrow-left',
            next: 'ion-ios-arrow-right',
            today: 'ion-android-home',
            clear: 'ion-trash-a',
        }
    });

    // Sortable projects.
    var projectList = document.getElementById("project-list");
    if (projectList) {
        new Sortable(projectList, {
            group: "omega",
            handle: ".drag-handle",
            onUpdate: function() {
                var orderedProjectIds = $.map($('#project-list .striped-list-item'), function(elem) {
                    return $(elem).data('project-id');
                });

                $.ajax({
                    async: true,
                    url: '/dashboard/api/projects/order',
                    type: 'POST',
                    data: {
                        ids: orderedProjectIds
                    },
                    success: function() {
                        (new Gitamin.Notifier()).notify('Project orders updated!', 'success');
                    },
                    error: function() {
                        (new Gitamin.Notifier()).notify('Project orders not updated!', 'error');
                    }
                });
            }
        });
    }

    // Toggle inline project statuses.
    $('form.project-inline').on('click', 'input[type=radio]', function() {
        var $form = $(this).parents('form');
        var formData = $form.serializeObject();

        $.ajax({
            async: true,
            url: '/dashboard/api/projects/' + formData.project_id,
            type: 'POST',
            data: formData,
            success: function(project) {
                (new Gitamin.Notifier()).notify($form.data('messenger'), 'success');
            },
            error: function(a, b, c) {
                (new Gitamin.Notifier()).notify('Something went wrong updating the project.');
            }
        });
    });

    //Upload avatar
    $(".dropzone").dropzone({
        url: "/dashboard/api/upload/avatar",
        addRemoveLinks: true,
        //dictRemoveLinks: "x",
        //dictCancelUpload: "x",
        maxFiles: 1,
        maxFilesize: 5,
        acceptedFiles: "image/*",
        init: function() {
            this.on("success", function(file) {
                console.log("File " + file.name + "uploaded");
            });
            this.on("removedfile", function(file) {
                console.log("File " + file.name + "removed");
            });
        }
    });
    // Banner removal JS
    $('#remove-banner').click(function(){
        $('#banner-view').remove();
        $('input[name=remove_banner]').val('1');
    });

    $('.group-name').on('click', function () {
        var $this = $(this);

        $this.find('.group-toggle').toggleClass('fa fa-minus-square-o').toggleClass('fa fa-plus-square-o');

        $this.next('.group-items').toggleClass('hide');
    });

    // Install wizard
    $('.wizard-next').on('click', function () {
        var $form   = $('#install-form'),
            $btn    = $(this),
            current = $btn.data('currentBlock'),
            next    = $btn.data('nextBlock');

        $btn.button('loading');

        // Only validate going forward. If current group is invalid, do not go further
        if (next > current) {
            var url = '/install/step' + current;
            $.post(url, $form.serializeObject())
                .done(function(response) {
                    goToStep(current, next);
                })
                .fail(function(response) {
                    var errors = _.toArray(response.responseJSON.errors);
                    _.each(errors, function(error) {
                        (new Gitamin.Notifier()).notify(error);
                    });
                })
                .always(function() {
                    $btn.button('reset');
                });

            return false;
        } else {
            goToStep(current, next);
            $btn.button('reset');
        }
    });

    // Sparkline
    if ($.fn.sparkline) {
        var sparkLine = function () {
            $('.sparkline').each(function () {
                var data = $(this).data();
                data.valueSpots = {
                    '0:': data.spotColor
                };

                $(this).sparkline(data.data, data);
                var composite = data.compositedata;

                if (composite) {
                    var stlColor = $(this).attr("data-stack-line-color"),
                        stfColor = $(this).attr("data-stack-fill-color"),
                        sptColor = $(this).attr("data-stack-spot-color"),
                        sptRadius = $(this).attr("data-stack-spot-radius");

                    $(this).sparkline(composite, {
                        composite: true,
                        lineColor: stlColor,
                        fillColor: stfColor,
                        spotColor: sptColor,
                        highlightSpotColor: sptColor,
                        spotRadius: sptRadius,
                        valueSpots: {
                            '0:': sptColor
                        }
                    });
                };
            });
        };

        sparkLine(false);
    }

    function goToStep(current, next) {
        // validation was ok. We can go on next step.
        $('.block-' + current)
          .removeClass('show')
          .addClass('hidden');

        $('.block-' + next)
          .removeClass('hidden')
          .addClass('show');

        $('.steps .step')
            .removeClass("active")
            .filter(":lt(" + (next) + ")")
            .addClass("active");
    }

});

function askConfirmation(callback) {
    swal({
        type: "warning",
        title: "Confirm your action",
        text: "Are you sure you want to do this?",
        confirmButtonText: "Yes",
        confirmButtonColor: "#FF6F6F",
        showCancelButton: true
    }, function() {
        callback();
    });
}
