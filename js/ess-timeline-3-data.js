/*-----------------------------------------------------------------------

Script name: Timeline data
Sends data to the active timeline.

------------------------------------------------------------------------*/

// Timeline data
var src = ess_timeline.src;
var jsonsrc = jQuery.parseJSON(src);

// Detects navigator language if no language informed
var language = window.navigator.userLanguage || window.navigator.language;
var langcode = language.toLowerCase();
var timelang = ess_timeline.lang;

if (timelang === '') {
  timelang = langcode;
}

var options = [{
  width:              ess_timeline.twidth,
  height:             ess_timeline.theight,
  timenav_position:   "bottom",
  language:           timelang,
  map_type:           ess_timeline.maptype,
  // relative_date:      true,
  use_bc:             true,
  // dragging:           true,
  trackResize:        true,
  map_type:           "stamen:toner-lite",
  slide_padding_lr:   100,
  slide_default_fade: "0%"
}];

var timeline = new TL.Timeline(ess_timeline.id, jsonsrc, options);

// Timeline configuration
var timeline_config = {
  width:          ess_timeline.twidth,
  height:         ess_timeline.theight,
  source:         jsonsrc,
  hash_bookmark:  ess_timeline.hash,
  start_at_end:   ess_timeline.reverse,
  embed_id:       ess_timeline.id,
  lang:           timelang,
  maptype:        ess_timeline.maptype,
  css:            ess_timeline.css,
  js:             ess_timeline.js,
};
