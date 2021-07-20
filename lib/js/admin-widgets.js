jQuery(function () {
  var select = jQuery('select.featured-carousel-post-type')
  createSelect2Input()
  // The type of 'posts to display' only refreshes on save, so we should get a include
  // text to inform the user.
  jQuery(select).change(function () {
    jQuery('.warning-refresh').show()
  })
})

jQuery(document).on('widget-updated widget-added', function () {
  createSelect2Input()
  jQuery('.warning-refresh').hide()
})

// Wordpress keeps a hidden widget in the DOM that is copied when made active. We need to create
// the select2 input for all widgets of a class EXCEPT the base copy otherwise multiple instances
// of the select2 input are created.
function createSelect2Input () {
  var baseCopyId = 'widget-equity-page-carousel-__i__-page_id'
  jQuery('select.featured-carousel-posts').filter(function () {
    return jQuery(this).attr('id') !== baseCopyId
  }).select2({
    allowClear: true
  })
}
