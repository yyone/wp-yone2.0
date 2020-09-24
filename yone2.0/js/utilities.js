// JavaScript Utilities
var U = {
  // Document Element取得用
  $: function(id) {
  	'use strict';
  	if(typeof id == 'string') {
  	   return document.getElementById(id);
    }
  },
  // 汎用Eventハンドラー
  addEvent: function(obj, type, fn) {
  	'use strict';
    if(obj && obj.addEventListener) { // W3C標準
      obj.addEventListener(type, fn, false);
    } else if(obj && obj.attachEvent) { // 古いIE用（IE8以前）
      obj.attachEvent('on' + type, fn);
    }
  },
  removeEvent: function(obj, type, fn) {
  	'use strict';
  	if(obj && obj.removeEventListener) { // W3C標準
  	  obj.removeEventListener(type, fn, false);
  	} else if(obj && obj.detachEvent) { // 古いIE用（IE8以前）
  	  obj.detachEvent('on' + type, fn);
  	}
  }
};
