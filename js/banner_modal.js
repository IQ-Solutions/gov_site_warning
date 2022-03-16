(function ($, Drupal, settings, cookies) {
  "use strict";
  var bannerCookie = cookies.get('gov_warning_banner');

  if (bannerCookie === undefined) {
    var $myDialog = $('<div></div>').appendTo('body');
    Drupal.dialog($myDialog, {
      dialogClass: "warning-banner",
      width: '90%',
      maxWidth: 600,
      open: function () {
        $(this).html(settings.ninds_module.message);
      },
      buttons: [{
        text: 'Accept',
        click: function() {
          cookies.set('gov_warning_banner', $.now(), {
            path: '/',
            sameSite: 'Strict',
            secure: true
          });
          $(this).dialog('close');
        }
      }]
    }).showModal();
  }

})(jQuery, Drupal, drupalSettings, window.Cookies);
