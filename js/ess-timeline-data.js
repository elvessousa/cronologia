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
