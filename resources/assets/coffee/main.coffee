
window.slugify = (text) ->
  text.replace(/[^-a-zA-Z0-9]+/g, '_').toLowerCase()

window.ajaxGet = (url) ->
  $.ajax({type: "GET", url: url, dataType: "script"})

window.split = (val) ->
  return val.split( /,\s*/ )

window.extractLast = (term) ->
  return split( term ).pop()

window.rstrip = (val) ->
  return if val then val.replace(/\s+$/, '') else val

# Disable button if text field is empty
window.disableButtonIfEmptyField = (field_selector, button_selector) ->
  field = $(field_selector)
  closest_submit = field.closest('form').find(button_selector)

  closest_submit.disable() if rstrip(field.val()) is ""

  field.on 'input', ->
    if rstrip($(@).val()) is ""
      closest_submit.disable()
    else
      closest_submit.enable()

# Disable button if any input field with given selector is empty
window.disableButtonIfAnyEmptyField = (form, form_selector, button_selector) ->
  closest_submit = form.find(button_selector)
  updateButtons = ->
    filled = true
    form.find('input').filter(form_selector).each ->
      filled = rstrip($(this).val()) != "" || !$(this).attr('required')

    if filled
      closest_submit.enable()
    else
      closest_submit.disable()

  updateButtons()
  form.keyup(updateButtons)

window.sanitize = (str) ->
  return str.replace(/<(?:.|\n)*?>/gm, '')

# $(document).pjax "a:not(a[target=\"_blank\"])", "body"

# $(document).on "pjax:start", ->
#  NProgress.start()

# $(document).on "pjax:end", ->
#  NProgress.done()

# $(document).on "pjax:complete", ->
#  NProgress.done()

window.goToStep = (current, next) ->
  
  # validation was ok. We can go on next step.
  $(".block-" + current).removeClass("show").addClass "hidden"
  $(".block-" + next).removeClass("hidden").addClass "show"
  $(".steps .step").removeClass("active").filter(":lt(" + (next) + ")").addClass "active"

$ ->
  # Click a .js-select-on-focus field, select the contents
  $(".js-select-on-focus").on "focusin", ->
    # Prevent a mouseup event from deselecting the input
    $(this).select().one 'mouseup', (e) ->
      e.preventDefault()

  $('.remove-row').bind 'ajax:success', ->
    $(this).closest('li').fadeOut()

  $('.js-remove-tr').bind 'ajax:before', ->
    $(this).hide()

  $('.js-remove-tr').bind 'ajax:success', ->
    $(this).closest('tr').fadeOut()

  # Initialize select2 selects
  $('select.select2').select2(width: 'resolve', dropdownAutoWidth: true)

  # Close select2 on escape
  $('.js-select2').bind 'select2-close', ->
    setTimeout ( ->
      $('.select2-container-active').removeClass('select2-container-active')
      $(':focus').blur()
    ), 1

  # Initalize dropzone
  $(".dropzone").dropzone
    url: "/dashboard/api/upload/avatar"
    addRemoveLinks: true
    #dictRemoveLinks: "x",
    #dictCancelUpload: "x",
    maxFiles: 1
    maxFilesize: 5
    acceptedFiles: "image/*"
    init: ->
      @on "success", (file) ->
        console.log "File " + file.name + "uploaded"

      @on "removedfile", (file) ->
        console.log "File " + file.name + "removed"

  # Initialize tooltips
  $('body').tooltip({
    selector: '.has_tooltip, [data-toggle="tooltip"], .page-sidebar-collapsed .nav-sidebar a'
    placement: (_, el) ->
      $el = $(el)
      if $el.attr('id') == 'js-shortcuts-home'
        # Place the logo tooltip on the right when collapsed, bottom when expanded
        $el.parents('header').hasClass('header-collapsed') and 'right' or 'bottom'
      else
        # Otherwise use the data-placement attribute, or 'bottom' if undefined
        $el.data('placement') or 'bottom'
  })

  # Form submitter
  $('.trigger-submit').on 'change', ->
    $(@).parents('form').submit()

  $('abbr.timeago, .js-timeago').timeago()

  # Flash
  if (flash = $(".flash-container")).length > 0
    flash.click -> $(@).fadeOut()
    flash.show()

  # Disable form buttons while a form is submitting
  $('body').on 'ajax:complete, ajax:beforeSend, submit', 'form', (e) ->
    buttons = $('[type="submit"]', @)

    switch e.type
      when 'ajax:beforeSend', 'submit'
        buttons.disable()
      else
        buttons.enable()

  # Install wizard
  $(".wizard-next").on "click", ->
    $form = $("#setup-form")
    $btn = $(this)
    current = $btn.data("currentBlock")
    next = $btn.data("nextBlock")
    $btn.button "loading"
    
    # Only validate going forward. If current group is invalid, do not go further
    if next > current
      url = "/install/step" + current
      $.post(url, $form.serializeObject()).done((response) ->
        goToStep current, next
      ).fail((response) ->
        errors = _.toArray(response.responseJSON.errors)
        _.each errors, (error) ->
          (new Cachet.Notifier()).notify error

      ).always ->
        $btn.button "reset"

      false
    else
      goToStep current, next
      $btn.button "reset"

  # Show/Hide the profile menu when hovering the account box
  $('.account-box').hover -> $(@).toggleClass('hover')

  # Commit show suppressed diff
  $(document).on 'click', '.diff-content .js-show-suppressed-diff', ->
    $container = $(@).parent()
    $container.next('table').show()
    $container.remove()

  $('.navbar-toggle').on 'click', ->
    $('.header-content .title').toggle()
    $('.header-content .navbar-collapse').toggle()
    $('.navbar-toggle').toggleClass('active')

  # Show/hide comments on diff
  $("body").on "click", ".js-toggle-diff-comments", (e) ->
    $(@).toggleClass('active')
    $(@).closest(".diff-file").find(".notes_holder").toggle()
    e.preventDefault()

  $(document).off "click", '.js-confirm-danger'
  $(document).on "click", '.js-confirm-danger', (e) ->
    e.preventDefault()
    btn = $(e.target)
    text = btn.data("confirm-danger-message")
    form = btn.closest("form")
    new ConfirmDangerModal(form, text)

  new Aside()
  paginate()
