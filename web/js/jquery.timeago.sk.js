(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery'], factory);
  } else if (typeof module === 'object' && typeof module.exports === 'object') {
    factory(require('jquery'));
  } else {
    factory(jQuery);
  }
}(function (jQuery) {
  // Slovak
  (function() {
  
  	jQuery.timeago.settings.strings = {
  		prefixAgo:     null,
  		prefixFromNow: null,
  		suffixAgo:     null,
  		suffixFromNow: null,
  		seconds: 'teraz',
  		minute:  'pred minútou',
  		minutes: 'pred %d minútami',
  		hour:    'pred hodinou',
  		hours:   'pred %d hodinami',
  		day:     'včera',
  		days:    'pred %d dňami',
  		month:   'pred mesiacom',
  		months:  'pred %d mesiacmi',
  		year:    'pred rokom',
  		years:   'pred %d rokmi'
  	};
  })();
}));
