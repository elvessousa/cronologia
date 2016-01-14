(function () {
  'use strict';
  var timeMeta;
  timeMeta = angular.module('ess-timeline-metabox', []);

  timeMeta.controller('TimelineCtrl', function ($scope) {
    $scope.timeline = {};

    // Open media dialog to change image
    $scope.getIMG = function (index) {
      var element, captionel, image, button, uploader;
      element   = angular.element('#timeline-media');
      captionel = angular.element('#timeline-caption');
      uploader  = wp.media({
        title: ess_timeline.imgDiagTitle,
        button: {
          text: ess_timeline.imgDiagBtn
        },
        multiple: false
      })
      .on('select', function() {
        var attachment = uploader.state().get('selection').first().toJSON();
        element.val(attachment.url);
        captionel.val(attachment.caption);
        element.trigger('change');
        captionel.trigger('change');
      })
      .open();
    };
  });
  timeMeta.directive('timelineMetabox', function(){
    return {
      restrict:'E',
      replace: true,
      templateUrl: ess_timeline.plugin_url + '/inc/partials/metabox.html'
    };
  })

})();
