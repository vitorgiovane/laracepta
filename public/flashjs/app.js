;(function(window, document, $, undefined) {
  "use strict"

  // With vanilla JavaScript
  document.addEventListener(
    "DOMContentLoaded",
    function() {
      // Add flash behavior on existing DOM element
      Flash.create(".js-msg")
    },
    false
  )
})(window, document, jQuery)
