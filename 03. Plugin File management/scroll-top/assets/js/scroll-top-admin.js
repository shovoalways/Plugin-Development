jQuery(document).ready(function ($) {
  // Initialize color picker.
  $(".color-scroll").wpColorPicker();

  // Show/hide text field
  var $td = $(".scroll-top-settings .form-table tr:nth-child(5)");
  $(".scroll-top-type").on("click", function () {
    if ($(this).attr("value") === "text") {
      $td.show("medium");
    } else {
      $td.hide("medium");
    }
  });
});
