paginate = ->
  $pager = $(".pager")
  $pager.find(".next a").one "click", (e) ->
    e.preventDefault()
    $.get @href, (html) ->
      $pager.after html
      $pager.remove()
      paginate()


  $pager.find(".previous").remove()