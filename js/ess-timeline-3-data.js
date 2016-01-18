/*-----------------------------------------------------------------------
*
*  Script name: Timeline data
*  Sends data to the active timeline.
*
------------------------------------------------------------------------*/
var src, jsonsrc, language, langcode, timelang, options, timeline;

// Timeline data
src      = ess_timeline.src;
jsonsrc  = JSON.parse(src);

// Detects navigator language if no language informed
language = window.navigator.userLanguage || window.navigator.language;
langcode = language.toLowerCase();
timelang = ess_timeline.lang;

if (timelang === '') { timelang = langcode; }

options = [{
  width:              ess_timeline.twidth,
  height:             ess_timeline.theight,
  timenav_position:   "bottom",
  language:           timelang,
  map_type:           ess_timeline.maptype,
  relative_date:      true,
  use_bc:             true,
  dragging:           true,
  start_at_end:       ess_timeline.reverse,
  map_type:           "stamen:toner-lite",
}];

timeline = new TL.Timeline(ess_timeline.id, jsonsrc, options);
