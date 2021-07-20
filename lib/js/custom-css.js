(function (global, $) {
  var editor
  var syncCSS = function () {
    $('#custom_css_textarea').val(editor.getSession().getValue())
  }
  var loadAce = function () {
    editor = ace.edit('custom_css')
    global.safecss_editor = editor
    editor.getSession().setUseWrapMode(true)
    editor.setShowPrintMargin(false)
    editor.getSession().setValue($('#custom_css_textarea').val())
    editor.getSession().setMode('ace/mode/css')
    jQuery.fn.spin && $('#custom_css_container').spin(false)
    $('#custom_css_form').submit(syncCSS)
  }
  $.browser = {};
  (function () {
    $.browser.msie = false
    $.browser.version = 0
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
      $.browser.msie = true
      $.browser.version = RegExp.$1
    }
  })()
  if ($.browser.msie && parseInt($.browser.version, 10) <= 7) {
    $('#custom_css_container').hide()
    $('#custom_css_textarea').show()
    return false
  } else {
    $(global).load(loadAce)
  }
  global.aceSyncCSS = syncCSS
})(this, jQuery)
