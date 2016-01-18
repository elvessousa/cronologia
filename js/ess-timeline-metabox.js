/*-----------------------------------------------------------------------
*
*  Script name: Timeline metabox
*  This script takes care of the data input in the backend for each slide.
*
------------------------------------------------------------------------*/
(function () {
  'use strict';
  var timeMeta;
  timeMeta = angular.module('ess-timeline-metabox', []);

  // ----------------------------------------------------
  // Timeline metabox controller
  // ----------------------------------------------------
  timeMeta.controller('TimelineCtrl', function ($scope, $window, $sce) {
    $scope.timelinecontent = $window.timelinecontent;
    $scope.timeline = {};

    // Watch for postlist
    $scope.$watch('timelinecontent', function () {
      try {
        $scope.timeline = JSON.parse($scope.timelinecontent);
      } catch (exp) {
        console.log('Posts: ' + $scope.timelinecontent.length + ' items.');
      }
    });

    // Watch for posts
    $scope.$watch('timeline', function () {
      try {
        $scope.timelinecontent = JSON.parse($scope.timeline);
      } catch (exp) {
        console.log('Posts: ' + $scope.timeline.length + ' items.');
      }
    });

    // Open media dialog to change image
    $scope.getMedia = function (index) {
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

    // Open media dialog to change image
    $scope.getImage = function (index) {
      var element, image, button, uploader;
      element   = angular.element(index);
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
        element.trigger('change');
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
  });
})();
