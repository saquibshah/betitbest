
// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
  log.history = log.history || [];   // store logs to an array for reference
  log.history.push(arguments);
  if(this.console) {
    arguments.callee = arguments.callee.caller;
    var newarr = [].slice.call(arguments);
    (typeof console.log === 'object' ? log.apply.call(console.log, console, newarr) : console.log.apply(console, newarr));
  }
};

// make it safe to use console.log always
(function(b){function c(){}for(var d="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,timeStamp,profile,profileEnd,time,timeEnd,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})((function(){try
{console.log();return window.console;}catch(err){return window.console={};}})());


// place any jQuery/helper plugins in here, instead of separate, slower script files.

$.fn.isOnScreen = function(){
    var viewport = {};
    viewport.top = $(window).scrollTop();
    viewport.bottom = viewport.top + $(window).height();
    var bounds = {};
    bounds.top = this.offset().top;
    bounds.bottom = bounds.top + this.outerHeight();
    return ((bounds.top <= viewport.bottom) && (bounds.bottom >= viewport.top));
};

Array.prototype.remove = function(from, to) {
  var rest = this.slice((to || from) + 1 || this.length);
  this.length = from < 0 ? this.length + from : from;
  return this.push.apply(this, rest);
};


/*! perfect-scrollbar - v0.5.2
* http://noraesae.github.com/perfect-scrollbar/
* Copyright (c) 2014 Hyunje Alex Jun; Licensed MIT */
/* perfect-scrollbar v0.6.5 */
!function t(e,n,r){function o(l,s){if(!n[l]){if(!e[l]){var a="function"==typeof require&&require;if(!s&&a)return a(l,!0);if(i)return i(l,!0);var c=new Error("Cannot find module '"+l+"'");throw c.code="MODULE_NOT_FOUND",c}var u=n[l]={exports:{}};e[l][0].call(u.exports,function(t){var n=e[l][1][t];return o(n?n:t)},u,u.exports,t,e,n,r)}return n[l].exports}for(var i="function"==typeof require&&require,l=0;l<r.length;l++)o(r[l]);return o}({1:[function(t,e,n){"use strict";function r(t){t.fn.perfectScrollbar=function(e){return this.each(function(){if("object"==typeof e||"undefined"==typeof e){var n=e;i.get(this)||o.initialize(this,n)}else{var r=e;"update"===r?o.update(this):"destroy"===r&&o.destroy(this)}return t(this)})}}var o=t("../main"),i=t("../plugin/instances");if("function"==typeof define&&define.amd)define(["jquery"],r);else{var l=window.jQuery?window.jQuery:window.$;"undefined"!=typeof l&&r(l)}e.exports=r},{"../main":7,"../plugin/instances":18}],2:[function(t,e,n){"use strict";function r(t,e){var n=t.className.split(" ");n.indexOf(e)<0&&n.push(e),t.className=n.join(" ")}function o(t,e){var n=t.className.split(" "),r=n.indexOf(e);r>=0&&n.splice(r,1),t.className=n.join(" ")}n.add=function(t,e){t.classList?t.classList.add(e):r(t,e)},n.remove=function(t,e){t.classList?t.classList.remove(e):o(t,e)},n.list=function(t){return t.classList?t.classList:t.className.split(" ")}},{}],3:[function(t,e,n){"use strict";function r(t,e){return window.getComputedStyle(t)[e]}function o(t,e,n){return"number"==typeof n&&(n=n.toString()+"px"),t.style[e]=n,t}function i(t,e){for(var n in e){var r=e[n];"number"==typeof r&&(r=r.toString()+"px"),t.style[n]=r}return t}var l={};l.e=function(t,e){var n=document.createElement(t);return n.className=e,n},l.appendTo=function(t,e){return e.appendChild(t),t},l.css=function(t,e,n){return"object"==typeof e?i(t,e):"undefined"==typeof n?r(t,e):o(t,e,n)},l.matches=function(t,e){return"undefined"!=typeof t.matches?t.matches(e):"undefined"!=typeof t.matchesSelector?t.matchesSelector(e):"undefined"!=typeof t.webkitMatchesSelector?t.webkitMatchesSelector(e):"undefined"!=typeof t.mozMatchesSelector?t.mozMatchesSelector(e):"undefined"!=typeof t.msMatchesSelector?t.msMatchesSelector(e):void 0},l.remove=function(t){"undefined"!=typeof t.remove?t.remove():t.parentNode&&t.parentNode.removeChild(t)},l.queryChildren=function(t,e){return Array.prototype.filter.call(t.childNodes,function(t){return l.matches(t,e)})},e.exports=l},{}],4:[function(t,e,n){"use strict";var r=function(t){this.element=t,this.events={}};r.prototype.bind=function(t,e){"undefined"==typeof this.events[t]&&(this.events[t]=[]),this.events[t].push(e),this.element.addEventListener(t,e,!1)},r.prototype.unbind=function(t,e){var n="undefined"!=typeof e;this.events[t]=this.events[t].filter(function(r){return n&&r!==e?!0:(this.element.removeEventListener(t,r,!1),!1)},this)},r.prototype.unbindAll=function(){for(var t in this.events)this.unbind(t)};var o=function(){this.eventElements=[]};o.prototype.eventElement=function(t){var e=this.eventElements.filter(function(e){return e.element===t})[0];return"undefined"==typeof e&&(e=new r(t),this.eventElements.push(e)),e},o.prototype.bind=function(t,e,n){this.eventElement(t).bind(e,n)},o.prototype.unbind=function(t,e,n){this.eventElement(t).unbind(e,n)},o.prototype.unbindAll=function(){for(var t=0;t<this.eventElements.length;t++)this.eventElements[t].unbindAll()},o.prototype.once=function(t,e,n){var r=this.eventElement(t),o=function(t){r.unbind(e,o),n(t)};r.bind(e,o)},e.exports=o},{}],5:[function(t,e,n){"use strict";e.exports=function(){function t(){return Math.floor(65536*(1+Math.random())).toString(16).substring(1)}return function(){return t()+t()+"-"+t()+"-"+t()+"-"+t()+"-"+t()+t()+t()}}()},{}],6:[function(t,e,n){"use strict";var r=t("./class"),o=t("./dom");n.toInt=function(t){return parseInt(t,10)||0},n.clone=function(t){if(null===t)return null;if("object"==typeof t){var e={};for(var n in t)e[n]=this.clone(t[n]);return e}return t},n.extend=function(t,e){var n=this.clone(t);for(var r in e)n[r]=this.clone(e[r]);return n},n.isEditable=function(t){return o.matches(t,"input,[contenteditable]")||o.matches(t,"select,[contenteditable]")||o.matches(t,"textarea,[contenteditable]")||o.matches(t,"button,[contenteditable]")},n.removePsClasses=function(t){for(var e=r.list(t),n=0;n<e.length;n++){var o=e[n];0===o.indexOf("ps-")&&r.remove(t,o)}},n.outerWidth=function(t){return this.toInt(o.css(t,"width"))+this.toInt(o.css(t,"paddingLeft"))+this.toInt(o.css(t,"paddingRight"))+this.toInt(o.css(t,"borderLeftWidth"))+this.toInt(o.css(t,"borderRightWidth"))},n.startScrolling=function(t,e){r.add(t,"ps-in-scrolling"),"undefined"!=typeof e?r.add(t,"ps-"+e):(r.add(t,"ps-x"),r.add(t,"ps-y"))},n.stopScrolling=function(t,e){r.remove(t,"ps-in-scrolling"),"undefined"!=typeof e?r.remove(t,"ps-"+e):(r.remove(t,"ps-x"),r.remove(t,"ps-y"))},n.env={isWebKit:"WebkitAppearance"in document.documentElement.style,supportsTouch:"ontouchstart"in window||window.DocumentTouch&&document instanceof window.DocumentTouch,supportsIePointer:null!==window.navigator.msMaxTouchPoints}},{"./class":2,"./dom":3}],7:[function(t,e,n){"use strict";var r=t("./plugin/destroy"),o=t("./plugin/initialize"),i=t("./plugin/update");e.exports={initialize:o,update:i,destroy:r}},{"./plugin/destroy":9,"./plugin/initialize":17,"./plugin/update":20}],8:[function(t,e,n){"use strict";e.exports={wheelSpeed:1,wheelPropagation:!1,swipePropagation:!0,minScrollbarLength:null,maxScrollbarLength:null,useBothWheelAxes:!1,useKeyboard:!0,suppressScrollX:!1,suppressScrollY:!1,scrollXMarginOffset:0,scrollYMarginOffset:0,stopPropagationOnClick:!0}},{}],9:[function(t,e,n){"use strict";var r=t("../lib/dom"),o=t("../lib/helper"),i=t("./instances");e.exports=function(t){var e=i.get(t);e&&(e.event.unbindAll(),r.remove(e.scrollbarX),r.remove(e.scrollbarY),r.remove(e.scrollbarXRail),r.remove(e.scrollbarYRail),o.removePsClasses(t),i.remove(t))}},{"../lib/dom":3,"../lib/helper":6,"./instances":18}],10:[function(t,e,n){"use strict";function r(t,e){function n(t){return t.getBoundingClientRect()}var r=window.Event.prototype.stopPropagation.bind;e.settings.stopPropagationOnClick&&e.event.bind(e.scrollbarY,"click",r),e.event.bind(e.scrollbarYRail,"click",function(r){var i=o.toInt(e.scrollbarYHeight/2),s=e.railYRatio*(r.pageY-window.scrollY-n(e.scrollbarYRail).top-i),a=e.railYRatio*(e.railYHeight-e.scrollbarYHeight),c=s/a;0>c?c=0:c>1&&(c=1),t.scrollTop=(e.contentHeight-e.containerHeight)*c,l(t),r.stopPropagation()}),e.settings.stopPropagationOnClick&&e.event.bind(e.scrollbarX,"click",r),e.event.bind(e.scrollbarXRail,"click",function(r){var i=o.toInt(e.scrollbarXWidth/2),s=e.railXRatio*(r.pageX-window.scrollX-n(e.scrollbarXRail).left-i),a=e.railXRatio*(e.railXWidth-e.scrollbarXWidth),c=s/a;0>c?c=0:c>1&&(c=1),t.scrollLeft=(e.contentWidth-e.containerWidth)*c-e.negativeScrollAdjustment,l(t),r.stopPropagation()})}var o=t("../../lib/helper"),i=t("../instances"),l=t("../update-geometry");e.exports=function(t){var e=i.get(t);r(t,e)}},{"../../lib/helper":6,"../instances":18,"../update-geometry":19}],11:[function(t,e,n){"use strict";function r(t,e){function n(n){var o=r+n*e.railXRatio,i=e.scrollbarXRail.getBoundingClientRect().left+e.railXRatio*(e.railXWidth-e.scrollbarXWidth);e.scrollbarXLeft=0>o?0:o>i?i:o;var s=l.toInt(e.scrollbarXLeft*(e.contentWidth-e.containerWidth)/(e.containerWidth-e.railXRatio*e.scrollbarXWidth))-e.negativeScrollAdjustment;t.scrollLeft=s}var r=null,o=null,s=function(e){n(e.pageX-o),a(t),e.stopPropagation(),e.preventDefault()},c=function(){l.stopScrolling(t,"x"),e.event.unbind(e.ownerDocument,"mousemove",s)};e.event.bind(e.scrollbarX,"mousedown",function(n){o=n.pageX,r=l.toInt(i.css(e.scrollbarX,"left"))*e.railXRatio,l.startScrolling(t,"x"),e.event.bind(e.ownerDocument,"mousemove",s),e.event.once(e.ownerDocument,"mouseup",c),n.stopPropagation(),n.preventDefault()})}function o(t,e){function n(n){var o=r+n*e.railYRatio,i=e.scrollbarYRail.getBoundingClientRect().top+e.railYRatio*(e.railYHeight-e.scrollbarYHeight);e.scrollbarYTop=0>o?0:o>i?i:o;var s=l.toInt(e.scrollbarYTop*(e.contentHeight-e.containerHeight)/(e.containerHeight-e.railYRatio*e.scrollbarYHeight));t.scrollTop=s}var r=null,o=null,s=function(e){n(e.pageY-o),a(t),e.stopPropagation(),e.preventDefault()},c=function(){l.stopScrolling(t,"y"),e.event.unbind(e.ownerDocument,"mousemove",s)};e.event.bind(e.scrollbarY,"mousedown",function(n){o=n.pageY,r=l.toInt(i.css(e.scrollbarY,"top"))*e.railYRatio,l.startScrolling(t,"y"),e.event.bind(e.ownerDocument,"mousemove",s),e.event.once(e.ownerDocument,"mouseup",c),n.stopPropagation(),n.preventDefault()})}var i=t("../../lib/dom"),l=t("../../lib/helper"),s=t("../instances"),a=t("../update-geometry");e.exports=function(t){var e=s.get(t);r(t,e),o(t,e)}},{"../../lib/dom":3,"../../lib/helper":6,"../instances":18,"../update-geometry":19}],12:[function(t,e,n){"use strict";function r(t,e){function n(n,r){var o=t.scrollTop;if(0===n){if(!e.scrollbarYActive)return!1;if(0===o&&r>0||o>=e.contentHeight-e.containerHeight&&0>r)return!e.settings.wheelPropagation}var i=t.scrollLeft;if(0===r){if(!e.scrollbarXActive)return!1;if(0===i&&0>n||i>=e.contentWidth-e.containerWidth&&n>0)return!e.settings.wheelPropagation}return!0}var r=!1;e.event.bind(t,"mouseenter",function(){r=!0}),e.event.bind(t,"mouseleave",function(){r=!1});var i=!1;e.event.bind(e.ownerDocument,"keydown",function(s){if((!s.isDefaultPrevented||!s.isDefaultPrevented())&&r){var a=document.activeElement?document.activeElement:e.ownerDocument.activeElement;if(a){for(;a.shadowRoot;)a=a.shadowRoot.activeElement;if(o.isEditable(a))return}var c=0,u=0;switch(s.which){case 37:c=-30;break;case 38:u=30;break;case 39:c=30;break;case 40:u=-30;break;case 33:u=90;break;case 32:u=s.shiftKey?90:-90;break;case 34:u=-90;break;case 35:u=s.ctrlKey?-e.contentHeight:-e.containerHeight;break;case 36:u=s.ctrlKey?t.scrollTop:e.containerHeight;break;default:return}t.scrollTop=t.scrollTop-u,t.scrollLeft=t.scrollLeft+c,l(t),i=n(c,u),i&&s.preventDefault()}})}var o=t("../../lib/helper"),i=t("../instances"),l=t("../update-geometry");e.exports=function(t){var e=i.get(t);r(t,e)}},{"../../lib/helper":6,"../instances":18,"../update-geometry":19}],13:[function(t,e,n){"use strict";function r(t,e){function n(n,r){var o=t.scrollTop;if(0===n){if(!e.scrollbarYActive)return!1;if(0===o&&r>0||o>=e.contentHeight-e.containerHeight&&0>r)return!e.settings.wheelPropagation}var i=t.scrollLeft;if(0===r){if(!e.scrollbarXActive)return!1;if(0===i&&0>n||i>=e.contentWidth-e.containerWidth&&n>0)return!e.settings.wheelPropagation}return!0}function r(t){var e=t.deltaX,n=-1*t.deltaY;return("undefined"==typeof e||"undefined"==typeof n)&&(e=-1*t.wheelDeltaX/6,n=t.wheelDeltaY/6),t.deltaMode&&1===t.deltaMode&&(e*=10,n*=10),e!==e&&n!==n&&(e=0,n=t.wheelDelta),[e,n]}function i(e,n){var r=t.querySelector("textarea:hover");if(r){var o=r.scrollHeight-r.clientHeight;if(o>0&&!(0===r.scrollTop&&n>0||r.scrollTop===o&&0>n))return!0;var i=r.scrollLeft-r.clientWidth;if(i>0&&!(0===r.scrollLeft&&0>e||r.scrollLeft===i&&e>0))return!0}return!1}function s(s){if(o.env.isWebKit||!t.querySelector("select:focus")){var c=r(s),u=c[0],d=c[1];i(u,d)||(a=!1,e.settings.useBothWheelAxes?e.scrollbarYActive&&!e.scrollbarXActive?(t.scrollTop=d?t.scrollTop-d*e.settings.wheelSpeed:t.scrollTop+u*e.settings.wheelSpeed,a=!0):e.scrollbarXActive&&!e.scrollbarYActive&&(t.scrollLeft=u?t.scrollLeft+u*e.settings.wheelSpeed:t.scrollLeft-d*e.settings.wheelSpeed,a=!0):(t.scrollTop=t.scrollTop-d*e.settings.wheelSpeed,t.scrollLeft=t.scrollLeft+u*e.settings.wheelSpeed),l(t),a=a||n(u,d),a&&(s.stopPropagation(),s.preventDefault()))}}var a=!1;"undefined"!=typeof window.onwheel?e.event.bind(t,"wheel",s):"undefined"!=typeof window.onmousewheel&&e.event.bind(t,"mousewheel",s)}var o=t("../../lib/helper"),i=t("../instances"),l=t("../update-geometry");e.exports=function(t){var e=i.get(t);r(t,e)}},{"../../lib/helper":6,"../instances":18,"../update-geometry":19}],14:[function(t,e,n){"use strict";function r(t,e){e.event.bind(t,"scroll",function(){i(t)})}var o=t("../instances"),i=t("../update-geometry");e.exports=function(t){var e=o.get(t);r(t,e)}},{"../instances":18,"../update-geometry":19}],15:[function(t,e,n){"use strict";function r(t,e){function n(){var t=window.getSelection?window.getSelection():document.getSelection?document.getSelection():"";return 0===t.toString().length?null:t.getRangeAt(0).commonAncestorContainer}function r(){a||(a=setInterval(function(){return i.get(t)?(t.scrollTop=t.scrollTop+c.top,t.scrollLeft=t.scrollLeft+c.left,void l(t)):void clearInterval(a)},50))}function s(){a&&(clearInterval(a),a=null),o.stopScrolling(t)}var a=null,c={top:0,left:0},u=!1;e.event.bind(e.ownerDocument,"selectionchange",function(){t.contains(n())?u=!0:(u=!1,s())}),e.event.bind(window,"mouseup",function(){u&&(u=!1,s())}),e.event.bind(window,"mousemove",function(e){if(u){var n={x:e.pageX,y:e.pageY},i={left:t.offsetLeft,right:t.offsetLeft+t.offsetWidth,top:t.offsetTop,bottom:t.offsetTop+t.offsetHeight};n.x<i.left+3?(c.left=-5,o.startScrolling(t,"x")):n.x>i.right-3?(c.left=5,o.startScrolling(t,"x")):c.left=0,n.y<i.top+3?(c.top=i.top+3-n.y<5?-5:-20,o.startScrolling(t,"y")):n.y>i.bottom-3?(c.top=n.y-i.bottom+3<5?5:20,o.startScrolling(t,"y")):c.top=0,0===c.top&&0===c.left?s():r()}})}var o=t("../../lib/helper"),i=t("../instances"),l=t("../update-geometry");e.exports=function(t){var e=i.get(t);r(t,e)}},{"../../lib/helper":6,"../instances":18,"../update-geometry":19}],16:[function(t,e,n){"use strict";function r(t,e,n,r){function l(n,r){var o=t.scrollTop,i=t.scrollLeft,l=Math.abs(n),s=Math.abs(r);if(s>l){if(0>r&&o===e.contentHeight-e.containerHeight||r>0&&0===o)return!e.settings.swipePropagation}else if(l>s&&(0>n&&i===e.contentWidth-e.containerWidth||n>0&&0===i))return!e.settings.swipePropagation;return!0}function s(e,n){t.scrollTop=t.scrollTop-n,t.scrollLeft=t.scrollLeft-e,i(t)}function a(){y=!0}function c(){y=!1}function u(t){return t.targetTouches?t.targetTouches[0]:t}function d(t){return t.targetTouches&&1===t.targetTouches.length?!0:t.pointerType&&"mouse"!==t.pointerType&&t.pointerType!==t.MSPOINTER_TYPE_MOUSE?!0:!1}function p(t){if(d(t)){Y=!0;var e=u(t);b.pageX=e.pageX,b.pageY=e.pageY,g=(new Date).getTime(),null!==m&&clearInterval(m),t.stopPropagation()}}function f(t){if(!y&&Y&&d(t)){var e=u(t),n={pageX:e.pageX,pageY:e.pageY},r=n.pageX-b.pageX,o=n.pageY-b.pageY;s(r,o),b=n;var i=(new Date).getTime(),a=i-g;a>0&&(v.x=r/a,v.y=o/a,g=i),l(r,o)&&(t.stopPropagation(),t.preventDefault())}}function h(){!y&&Y&&(Y=!1,clearInterval(m),m=setInterval(function(){return o.get(t)?Math.abs(v.x)<.01&&Math.abs(v.y)<.01?void clearInterval(m):(s(30*v.x,30*v.y),v.x*=.8,void(v.y*=.8)):void clearInterval(m)},10))}var b={},g=0,v={},m=null,y=!1,Y=!1;n&&(e.event.bind(window,"touchstart",a),e.event.bind(window,"touchend",c),e.event.bind(t,"touchstart",p),e.event.bind(t,"touchmove",f),e.event.bind(t,"touchend",h)),r&&(window.PointerEvent?(e.event.bind(window,"pointerdown",a),e.event.bind(window,"pointerup",c),e.event.bind(t,"pointerdown",p),e.event.bind(t,"pointermove",f),e.event.bind(t,"pointerup",h)):window.MSPointerEvent&&(e.event.bind(window,"MSPointerDown",a),e.event.bind(window,"MSPointerUp",c),e.event.bind(t,"MSPointerDown",p),e.event.bind(t,"MSPointerMove",f),e.event.bind(t,"MSPointerUp",h)))}var o=t("../instances"),i=t("../update-geometry");e.exports=function(t,e,n){var i=o.get(t);r(t,i,e,n)}},{"../instances":18,"../update-geometry":19}],17:[function(t,e,n){"use strict";var r=t("../lib/class"),o=t("../lib/helper"),i=t("./instances"),l=t("./update-geometry"),s=t("./handler/click-rail"),a=t("./handler/drag-scrollbar"),c=t("./handler/keyboard"),u=t("./handler/mouse-wheel"),d=t("./handler/native-scroll"),p=t("./handler/selection"),f=t("./handler/touch");e.exports=function(t,e){e="object"==typeof e?e:{},r.add(t,"ps-container");var n=i.add(t);n.settings=o.extend(n.settings,e),s(t),a(t),u(t),d(t),p(t),(o.env.supportsTouch||o.env.supportsIePointer)&&f(t,o.env.supportsTouch,o.env.supportsIePointer),n.settings.useKeyboard&&c(t),l(t)}},{"../lib/class":2,"../lib/helper":6,"./handler/click-rail":10,"./handler/drag-scrollbar":11,"./handler/keyboard":12,"./handler/mouse-wheel":13,"./handler/native-scroll":14,"./handler/selection":15,"./handler/touch":16,"./instances":18,"./update-geometry":19}],18:[function(t,e,n){"use strict";function r(t){var e=this;e.settings=d.clone(a),e.containerWidth=null,e.containerHeight=null,e.contentWidth=null,e.contentHeight=null,e.isRtl="rtl"===s.css(t,"direction"),e.isNegativeScroll=function(){var e=t.scrollLeft,n=null;return t.scrollLeft=-1,n=t.scrollLeft<0,t.scrollLeft=e,n}(),e.negativeScrollAdjustment=e.isNegativeScroll?t.scrollWidth-t.clientWidth:0,e.event=new c,e.ownerDocument=t.ownerDocument||document,e.scrollbarXRail=s.appendTo(s.e("div","ps-scrollbar-x-rail"),t),e.scrollbarX=s.appendTo(s.e("div","ps-scrollbar-x"),e.scrollbarXRail),e.scrollbarXActive=null,e.scrollbarXWidth=null,e.scrollbarXLeft=null,e.scrollbarXBottom=d.toInt(s.css(e.scrollbarXRail,"bottom")),e.isScrollbarXUsingBottom=e.scrollbarXBottom===e.scrollbarXBottom,e.scrollbarXTop=e.isScrollbarXUsingBottom?null:d.toInt(s.css(e.scrollbarXRail,"top")),e.railBorderXWidth=d.toInt(s.css(e.scrollbarXRail,"borderLeftWidth"))+d.toInt(s.css(e.scrollbarXRail,"borderRightWidth")),s.css(e.scrollbarXRail,"display","block"),e.railXMarginWidth=d.toInt(s.css(e.scrollbarXRail,"marginLeft"))+d.toInt(s.css(e.scrollbarXRail,"marginRight")),s.css(e.scrollbarXRail,"display",""),e.railXWidth=null,e.railXRatio=null,e.scrollbarYRail=s.appendTo(s.e("div","ps-scrollbar-y-rail"),t),e.scrollbarY=s.appendTo(s.e("div","ps-scrollbar-y"),e.scrollbarYRail),e.scrollbarYActive=null,e.scrollbarYHeight=null,e.scrollbarYTop=null,e.scrollbarYRight=d.toInt(s.css(e.scrollbarYRail,"right")),e.isScrollbarYUsingRight=e.scrollbarYRight===e.scrollbarYRight,e.scrollbarYLeft=e.isScrollbarYUsingRight?null:d.toInt(s.css(e.scrollbarYRail,"left")),e.scrollbarYOuterWidth=e.isRtl?d.outerWidth(e.scrollbarY):null,e.railBorderYWidth=d.toInt(s.css(e.scrollbarYRail,"borderTopWidth"))+d.toInt(s.css(e.scrollbarYRail,"borderBottomWidth")),s.css(e.scrollbarYRail,"display","block"),e.railYMarginHeight=d.toInt(s.css(e.scrollbarYRail,"marginTop"))+d.toInt(s.css(e.scrollbarYRail,"marginBottom")),s.css(e.scrollbarYRail,"display",""),e.railYHeight=null,e.railYRatio=null}function o(t){return"undefined"==typeof t.dataset?t.getAttribute("data-ps-id"):t.dataset.psId}function i(t,e){"undefined"==typeof t.dataset?t.setAttribute("data-ps-id",e):t.dataset.psId=e}function l(t){"undefined"==typeof t.dataset?t.removeAttribute("data-ps-id"):delete t.dataset.psId}var s=t("../lib/dom"),a=t("./default-setting"),c=t("../lib/event-manager"),u=t("../lib/guid"),d=t("../lib/helper"),p={};n.add=function(t){var e=u();return i(t,e),p[e]=new r(t),p[e]},n.remove=function(t){delete p[o(t)],l(t)},n.get=function(t){return p[o(t)]}},{"../lib/dom":3,"../lib/event-manager":4,"../lib/guid":5,"../lib/helper":6,"./default-setting":8}],19:[function(t,e,n){"use strict";function r(t,e){return t.settings.minScrollbarLength&&(e=Math.max(e,t.settings.minScrollbarLength)),t.settings.maxScrollbarLength&&(e=Math.min(e,t.settings.maxScrollbarLength)),e}function o(t,e){var n={width:e.railXWidth};n.left=e.isRtl?e.negativeScrollAdjustment+t.scrollLeft+e.containerWidth-e.contentWidth:t.scrollLeft,e.isScrollbarXUsingBottom?n.bottom=e.scrollbarXBottom-t.scrollTop:n.top=e.scrollbarXTop+t.scrollTop,l.css(e.scrollbarXRail,n);var r={top:t.scrollTop,height:e.railYHeight};e.isScrollbarYUsingRight?r.right=e.isRtl?e.contentWidth-(e.negativeScrollAdjustment+t.scrollLeft)-e.scrollbarYRight-e.scrollbarYOuterWidth:e.scrollbarYRight-t.scrollLeft:r.left=e.isRtl?e.negativeScrollAdjustment+t.scrollLeft+2*e.containerWidth-e.contentWidth-e.scrollbarYLeft-e.scrollbarYOuterWidth:e.scrollbarYLeft+t.scrollLeft,l.css(e.scrollbarYRail,r),l.css(e.scrollbarX,{left:e.scrollbarXLeft,width:e.scrollbarXWidth-e.railBorderXWidth}),l.css(e.scrollbarY,{top:e.scrollbarYTop,height:e.scrollbarYHeight-e.railBorderYWidth})}var i=t("../lib/class"),l=t("../lib/dom"),s=t("../lib/helper"),a=t("./instances");e.exports=function(t){var e=a.get(t);e.containerWidth=t.clientWidth,e.containerHeight=t.clientHeight,e.contentWidth=t.scrollWidth,e.contentHeight=t.scrollHeight;var n;t.contains(e.scrollbarXRail)||(n=l.queryChildren(t,".ps-scrollbar-x-rail"),n.length>0&&n.forEach(function(t){l.remove(t)}),l.appendTo(e.scrollbarXRail,t)),t.contains(e.scrollbarYRail)||(n=l.queryChildren(t,".ps-scrollbar-y-rail"),n.length>0&&n.forEach(function(t){l.remove(t)}),l.appendTo(e.scrollbarYRail,t)),!e.settings.suppressScrollX&&e.containerWidth+e.settings.scrollXMarginOffset<e.contentWidth?(e.scrollbarXActive=!0,e.railXWidth=e.containerWidth-e.railXMarginWidth,e.railXRatio=e.containerWidth/e.railXWidth,e.scrollbarXWidth=r(e,s.toInt(e.railXWidth*e.containerWidth/e.contentWidth)),e.scrollbarXLeft=s.toInt((e.negativeScrollAdjustment+t.scrollLeft)*(e.railXWidth-e.scrollbarXWidth)/(e.contentWidth-e.containerWidth))):(e.scrollbarXActive=!1,e.scrollbarXWidth=0,e.scrollbarXLeft=0,t.scrollLeft=0),!e.settings.suppressScrollY&&e.containerHeight+e.settings.scrollYMarginOffset<e.contentHeight?(e.scrollbarYActive=!0,e.railYHeight=e.containerHeight-e.railYMarginHeight,e.railYRatio=e.containerHeight/e.railYHeight,e.scrollbarYHeight=r(e,s.toInt(e.railYHeight*e.containerHeight/e.contentHeight)),e.scrollbarYTop=s.toInt(t.scrollTop*(e.railYHeight-e.scrollbarYHeight)/(e.contentHeight-e.containerHeight))):(e.scrollbarYActive=!1,e.scrollbarYHeight=0,e.scrollbarYTop=0,t.scrollTop=0),e.scrollbarXLeft>=e.railXWidth-e.scrollbarXWidth&&(e.scrollbarXLeft=e.railXWidth-e.scrollbarXWidth),e.scrollbarYTop>=e.railYHeight-e.scrollbarYHeight&&(e.scrollbarYTop=e.railYHeight-e.scrollbarYHeight),o(t,e),i[e.scrollbarXActive?"add":"remove"](t,"ps-active-x"),i[e.scrollbarYActive?"add":"remove"](t,"ps-active-y")}},{"../lib/class":2,"../lib/dom":3,"../lib/helper":6,"./instances":18}],20:[function(t,e,n){"use strict";var r=t("../lib/dom"),o=t("../lib/helper"),i=t("./instances"),l=t("./update-geometry");e.exports=function(t){var e=i.get(t);e&&(e.negativeScrollAdjustment=e.isNegativeScroll?t.scrollWidth-t.clientWidth:0,r.css(e.scrollbarXRail,"display","block"),r.css(e.scrollbarYRail,"display","block"),e.railXMarginWidth=o.toInt(r.css(e.scrollbarXRail,"marginLeft"))+o.toInt(r.css(e.scrollbarXRail,"marginRight")),e.railYMarginHeight=o.toInt(r.css(e.scrollbarYRail,"marginTop"))+o.toInt(r.css(e.scrollbarYRail,"marginBottom")),r.css(e.scrollbarXRail,"display","none"),r.css(e.scrollbarYRail,"display","none"),l(t),r.css(e.scrollbarXRail,"display",""),r.css(e.scrollbarYRail,"display",""))}},{"../lib/dom":3,"../lib/helper":6,"./instances":18,"./update-geometry":19}]},{},[1]);


/*! Magnific Popup - v0.9.9 - 2014-09-06
* http://dimsemenov.com/plugins/magnific-popup/
* Copyright (c) 2014 Dmitry Semenov; */
(function(e){var t,n,i,o,r,a,s,l="Close",c="BeforeClose",d="AfterClose",u="BeforeAppend",p="MarkupParse",f="Open",m="Change",g="mfp",h="."+g,v="mfp-ready",C="mfp-removing",y="mfp-prevent-close",w=function(){},b=!!window.jQuery,I=e(window),x=function(e,n){t.ev.on(g+e+h,n)},k=function(t,n,i,o){var r=document.createElement("div");return r.className="mfp-"+t,i&&(r.innerHTML=i),o?n&&n.appendChild(r):(r=e(r),n&&r.appendTo(n)),r},T=function(n,i){t.ev.triggerHandler(g+n,i),t.st.callbacks&&(n=n.charAt(0).toLowerCase()+n.slice(1),t.st.callbacks[n]&&t.st.callbacks[n].apply(t,e.isArray(i)?i:[i]))},E=function(n){return n===s&&t.currTemplate.closeBtn||(t.currTemplate.closeBtn=e(t.st.closeMarkup.replace("%title%",t.st.tClose)),s=n),t.currTemplate.closeBtn},_=function(){e.magnificPopup.instance||(t=new w,t.init(),e.magnificPopup.instance=t)},S=function(){var e=document.createElement("p").style,t=["ms","O","Moz","Webkit"];if(void 0!==e.transition)return!0;for(;t.length;)if(t.pop()+"Transition"in e)return!0;return!1};w.prototype={constructor:w,init:function(){var n=navigator.appVersion;t.isIE7=-1!==n.indexOf("MSIE 7."),t.isIE8=-1!==n.indexOf("MSIE 8."),t.isLowIE=t.isIE7||t.isIE8,t.isAndroid=/android/gi.test(n),t.isIOS=/iphone|ipad|ipod/gi.test(n),t.supportsTransition=S(),t.probablyMobile=t.isAndroid||t.isIOS||/(Opera Mini)|Kindle|webOS|BlackBerry|(Opera Mobi)|(Windows Phone)|IEMobile/i.test(navigator.userAgent),o=e(document),t.popupsCache={}},open:function(n){i||(i=e(document.body));var r;if(n.isObj===!1){t.items=n.items.toArray(),t.index=0;var s,l=n.items;for(r=0;l.length>r;r++)if(s=l[r],s.parsed&&(s=s.el[0]),s===n.el[0]){t.index=r;break}}else t.items=e.isArray(n.items)?n.items:[n.items],t.index=n.index||0;if(t.isOpen)return t.updateItemHTML(),void 0;t.types=[],a="",t.ev=n.mainEl&&n.mainEl.length?n.mainEl.eq(0):o,n.key?(t.popupsCache[n.key]||(t.popupsCache[n.key]={}),t.currTemplate=t.popupsCache[n.key]):t.currTemplate={},t.st=e.extend(!0,{},e.magnificPopup.defaults,n),t.fixedContentPos="auto"===t.st.fixedContentPos?!t.probablyMobile:t.st.fixedContentPos,t.st.modal&&(t.st.closeOnContentClick=!1,t.st.closeOnBgClick=!1,t.st.showCloseBtn=!1,t.st.enableEscapeKey=!1),t.bgOverlay||(t.bgOverlay=k("bg").on("click"+h,function(){t.close()}),t.wrap=k("wrap").attr("tabindex",-1).on("click"+h,function(e){t._checkIfClose(e.target)&&t.close()}),t.container=k("container",t.wrap)),t.contentContainer=k("content"),t.st.preloader&&(t.preloader=k("preloader",t.container,t.st.tLoading));var c=e.magnificPopup.modules;for(r=0;c.length>r;r++){var d=c[r];d=d.charAt(0).toUpperCase()+d.slice(1),t["init"+d].call(t)}T("BeforeOpen"),t.st.showCloseBtn&&(t.st.closeBtnInside?(x(p,function(e,t,n,i){n.close_replaceWith=E(i.type)}),a+=" mfp-close-btn-in"):t.wrap.append(E())),t.st.alignTop&&(a+=" mfp-align-top"),t.fixedContentPos?t.wrap.css({overflow:t.st.overflowY,overflowX:"hidden",overflowY:t.st.overflowY}):t.wrap.css({top:I.scrollTop(),position:"absolute"}),(t.st.fixedBgPos===!1||"auto"===t.st.fixedBgPos&&!t.fixedContentPos)&&t.bgOverlay.css({height:o.height(),position:"absolute"}),t.st.enableEscapeKey&&o.on("keyup"+h,function(e){27===e.keyCode&&t.close()}),I.on("resize"+h,function(){t.updateSize()}),t.st.closeOnContentClick||(a+=" mfp-auto-cursor"),a&&t.wrap.addClass(a);var u=t.wH=I.height(),m={};if(t.fixedContentPos&&t._hasScrollBar(u)){var g=t._getScrollbarSize();g&&(m.marginRight=g)}t.fixedContentPos&&(t.isIE7?e("body, html").css("overflow","hidden"):m.overflow="hidden");var C=t.st.mainClass;return t.isIE7&&(C+=" mfp-ie7"),C&&t._addClassToMFP(C),t.updateItemHTML(),T("BuildControls"),e("html").css(m),t.bgOverlay.add(t.wrap).prependTo(t.st.prependTo||i),t._lastFocusedEl=document.activeElement,setTimeout(function(){t.content?(t._addClassToMFP(v),t._setFocus()):t.bgOverlay.addClass(v),o.on("focusin"+h,t._onFocusIn)},16),t.isOpen=!0,t.updateSize(u),T(f),n},close:function(){t.isOpen&&(T(c),t.isOpen=!1,t.st.removalDelay&&!t.isLowIE&&t.supportsTransition?(t._addClassToMFP(C),setTimeout(function(){t._close()},t.st.removalDelay)):t._close())},_close:function(){T(l);var n=C+" "+v+" ";if(t.bgOverlay.detach(),t.wrap.detach(),t.container.empty(),t.st.mainClass&&(n+=t.st.mainClass+" "),t._removeClassFromMFP(n),t.fixedContentPos){var i={marginRight:""};t.isIE7?e("body, html").css("overflow",""):i.overflow="",e("html").css(i)}o.off("keyup"+h+" focusin"+h),t.ev.off(h),t.wrap.attr("class","mfp-wrap").removeAttr("style"),t.bgOverlay.attr("class","mfp-bg"),t.container.attr("class","mfp-container"),!t.st.showCloseBtn||t.st.closeBtnInside&&t.currTemplate[t.currItem.type]!==!0||t.currTemplate.closeBtn&&t.currTemplate.closeBtn.detach(),t._lastFocusedEl&&e(t._lastFocusedEl).focus(),t.currItem=null,t.content=null,t.currTemplate=null,t.prevHeight=0,T(d)},updateSize:function(e){if(t.isIOS){var n=document.documentElement.clientWidth/window.innerWidth,i=window.innerHeight*n;t.wrap.css("height",i),t.wH=i}else t.wH=e||I.height();t.fixedContentPos||t.wrap.css("height",t.wH),T("Resize")},updateItemHTML:function(){var n=t.items[t.index];t.contentContainer.detach(),t.content&&t.content.detach(),n.parsed||(n=t.parseEl(t.index));var i=n.type;if(T("BeforeChange",[t.currItem?t.currItem.type:"",i]),t.currItem=n,!t.currTemplate[i]){var o=t.st[i]?t.st[i].markup:!1;T("FirstMarkupParse",o),t.currTemplate[i]=o?e(o):!0}r&&r!==n.type&&t.container.removeClass("mfp-"+r+"-holder");var a=t["get"+i.charAt(0).toUpperCase()+i.slice(1)](n,t.currTemplate[i]);t.appendContent(a,i),n.preloaded=!0,T(m,n),r=n.type,t.container.prepend(t.contentContainer),T("AfterChange")},appendContent:function(e,n){t.content=e,e?t.st.showCloseBtn&&t.st.closeBtnInside&&t.currTemplate[n]===!0?t.content.find(".mfp-close").length||t.content.append(E()):t.content=e:t.content="",T(u),t.container.addClass("mfp-"+n+"-holder"),t.contentContainer.append(t.content)},parseEl:function(n){var i,o=t.items[n];if(o.tagName?o={el:e(o)}:(i=o.type,o={data:o,src:o.src}),o.el){for(var r=t.types,a=0;r.length>a;a++)if(o.el.hasClass("mfp-"+r[a])){i=r[a];break}o.src=o.el.attr("data-mfp-src"),o.src||(o.src=o.el.attr("href"))}return o.type=i||t.st.type||"inline",o.index=n,o.parsed=!0,t.items[n]=o,T("ElementParse",o),t.items[n]},addGroup:function(e,n){var i=function(i){i.mfpEl=this,t._openClick(i,e,n)};n||(n={});var o="click.magnificPopup";n.mainEl=e,n.items?(n.isObj=!0,e.off(o).on(o,i)):(n.isObj=!1,n.delegate?e.off(o).on(o,n.delegate,i):(n.items=e,e.off(o).on(o,i)))},_openClick:function(n,i,o){var r=void 0!==o.midClick?o.midClick:e.magnificPopup.defaults.midClick;if(r||2!==n.which&&!n.ctrlKey&&!n.metaKey){var a=void 0!==o.disableOn?o.disableOn:e.magnificPopup.defaults.disableOn;if(a)if(e.isFunction(a)){if(!a.call(t))return!0}else if(a>I.width())return!0;n.type&&(n.preventDefault(),t.isOpen&&n.stopPropagation()),o.el=e(n.mfpEl),o.delegate&&(o.items=i.find(o.delegate)),t.open(o)}},updateStatus:function(e,i){if(t.preloader){n!==e&&t.container.removeClass("mfp-s-"+n),i||"loading"!==e||(i=t.st.tLoading);var o={status:e,text:i};T("UpdateStatus",o),e=o.status,i=o.text,t.preloader.html(i),t.preloader.find("a").on("click",function(e){e.stopImmediatePropagation()}),t.container.addClass("mfp-s-"+e),n=e}},_checkIfClose:function(n){if(!e(n).hasClass(y)){var i=t.st.closeOnContentClick,o=t.st.closeOnBgClick;if(i&&o)return!0;if(!t.content||e(n).hasClass("mfp-close")||t.preloader&&n===t.preloader[0])return!0;if(n===t.content[0]||e.contains(t.content[0],n)){if(i)return!0}else if(o&&e.contains(document,n))return!0;return!1}},_addClassToMFP:function(e){t.bgOverlay.addClass(e),t.wrap.addClass(e)},_removeClassFromMFP:function(e){this.bgOverlay.removeClass(e),t.wrap.removeClass(e)},_hasScrollBar:function(e){return(t.isIE7?o.height():document.body.scrollHeight)>(e||I.height())},_setFocus:function(){(t.st.focus?t.content.find(t.st.focus).eq(0):t.wrap).focus()},_onFocusIn:function(n){return n.target===t.wrap[0]||e.contains(t.wrap[0],n.target)?void 0:(t._setFocus(),!1)},_parseMarkup:function(t,n,i){var o;i.data&&(n=e.extend(i.data,n)),T(p,[t,n,i]),e.each(n,function(e,n){if(void 0===n||n===!1)return!0;if(o=e.split("_"),o.length>1){var i=t.find(h+"-"+o[0]);if(i.length>0){var r=o[1];"replaceWith"===r?i[0]!==n[0]&&i.replaceWith(n):"img"===r?i.is("img")?i.attr("src",n):i.replaceWith('<img src="'+n+'" class="'+i.attr("class")+'" />'):i.attr(o[1],n)}}else t.find(h+"-"+e).html(n)})},_getScrollbarSize:function(){if(void 0===t.scrollbarSize){var e=document.createElement("div");e.style.cssText="width: 99px; height: 99px; overflow: scroll; position: absolute; top: -9999px;",document.body.appendChild(e),t.scrollbarSize=e.offsetWidth-e.clientWidth,document.body.removeChild(e)}return t.scrollbarSize}},e.magnificPopup={instance:null,proto:w.prototype,modules:[],open:function(t,n){return _(),t=t?e.extend(!0,{},t):{},t.isObj=!0,t.index=n||0,this.instance.open(t)},close:function(){return e.magnificPopup.instance&&e.magnificPopup.instance.close()},registerModule:function(t,n){n.options&&(e.magnificPopup.defaults[t]=n.options),e.extend(this.proto,n.proto),this.modules.push(t)},defaults:{disableOn:0,key:null,midClick:!1,mainClass:"",preloader:!0,focus:"",closeOnContentClick:!1,closeOnBgClick:!0,closeBtnInside:!0,showCloseBtn:!0,enableEscapeKey:!0,modal:!1,alignTop:!1,removalDelay:0,prependTo:null,fixedContentPos:"auto",fixedBgPos:"auto",overflowY:"auto",closeMarkup:'<button title="%title%" type="button" class="mfp-close">&times;</button>',tClose:"Close (Esc)",tLoading:"Loading..."}},e.fn.magnificPopup=function(n){_();var i=e(this);if("string"==typeof n)if("open"===n){var o,r=b?i.data("magnificPopup"):i[0].magnificPopup,a=parseInt(arguments[1],10)||0;r.items?o=r.items[a]:(o=i,r.delegate&&(o=o.find(r.delegate)),o=o.eq(a)),t._openClick({mfpEl:o},i,r)}else t.isOpen&&t[n].apply(t,Array.prototype.slice.call(arguments,1));else n=e.extend(!0,{},n),b?i.data("magnificPopup",n):i[0].magnificPopup=n,t.addGroup(i,n);return i};var P,O,z,M="inline",B=function(){z&&(O.after(z.addClass(P)).detach(),z=null)};e.magnificPopup.registerModule(M,{options:{hiddenClass:"hide",markup:"",tNotFound:"Content not found"},proto:{initInline:function(){t.types.push(M),x(l+"."+M,function(){B()})},getInline:function(n,i){if(B(),n.src){var o=t.st.inline,r=e(n.src);if(r.length){var a=r[0].parentNode;a&&a.tagName&&(O||(P=o.hiddenClass,O=k(P),P="mfp-"+P),z=r.after(O).detach().removeClass(P)),t.updateStatus("ready")}else t.updateStatus("error",o.tNotFound),r=e("<div>");return n.inlineElement=r,r}return t.updateStatus("ready"),t._parseMarkup(i,{},n),i}}});var F,H="ajax",L=function(){F&&i.removeClass(F)},A=function(){L(),t.req&&t.req.abort()};e.magnificPopup.registerModule(H,{options:{settings:null,cursor:"mfp-ajax-cur",tError:'<a href="%url%">The content</a> could not be loaded.'},proto:{initAjax:function(){t.types.push(H),F=t.st.ajax.cursor,x(l+"."+H,A),x("BeforeChange."+H,A)},getAjax:function(n){F&&i.addClass(F),t.updateStatus("loading");var o=e.extend({url:n.src,success:function(i,o,r){var a={data:i,xhr:r};T("ParseAjax",a),t.appendContent(e(a.data),H),n.finished=!0,L(),t._setFocus(),setTimeout(function(){t.wrap.addClass(v)},16),t.updateStatus("ready"),T("AjaxContentAdded")},error:function(){L(),n.finished=n.loadError=!0,t.updateStatus("error",t.st.ajax.tError.replace("%url%",n.src))}},t.st.ajax.settings);return t.req=e.ajax(o),""}}});var j,N=function(n){if(n.data&&void 0!==n.data.title)return n.data.title;var i=t.st.image.titleSrc;if(i){if(e.isFunction(i))return i.call(t,n);if(n.el)return n.el.attr(i)||""}return""};e.magnificPopup.registerModule("image",{options:{markup:'<div class="mfp-figure"><div class="mfp-close"></div><figure><div class="mfp-img"></div><figcaption><div class="mfp-bottom-bar"><div class="mfp-title"></div><div class="mfp-counter"></div></div></figcaption></figure></div>',cursor:"mfp-zoom-out-cur",titleSrc:"title",verticalFit:!0,tError:'<a href="%url%">The image</a> could not be loaded.'},proto:{initImage:function(){var e=t.st.image,n=".image";t.types.push("image"),x(f+n,function(){"image"===t.currItem.type&&e.cursor&&i.addClass(e.cursor)}),x(l+n,function(){e.cursor&&i.removeClass(e.cursor),I.off("resize"+h)}),x("Resize"+n,t.resizeImage),t.isLowIE&&x("AfterChange",t.resizeImage)},resizeImage:function(){var e=t.currItem;if(e&&e.img&&t.st.image.verticalFit){var n=0;t.isLowIE&&(n=parseInt(e.img.css("padding-top"),10)+parseInt(e.img.css("padding-bottom"),10)),e.img.css("max-height",t.wH-n)}},_onImageHasSize:function(e){e.img&&(e.hasSize=!0,j&&clearInterval(j),e.isCheckingImgSize=!1,T("ImageHasSize",e),e.imgHidden&&(t.content&&t.content.removeClass("mfp-loading"),e.imgHidden=!1))},findImageSize:function(e){var n=0,i=e.img[0],o=function(r){j&&clearInterval(j),j=setInterval(function(){return i.naturalWidth>0?(t._onImageHasSize(e),void 0):(n>200&&clearInterval(j),n++,3===n?o(10):40===n?o(50):100===n&&o(500),void 0)},r)};o(1)},getImage:function(n,i){var o=0,r=function(){n&&(n.img[0].complete?(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("ready")),n.hasSize=!0,n.loaded=!0,T("ImageLoadComplete")):(o++,200>o?setTimeout(r,100):a()))},a=function(){n&&(n.img.off(".mfploader"),n===t.currItem&&(t._onImageHasSize(n),t.updateStatus("error",s.tError.replace("%url%",n.src))),n.hasSize=!0,n.loaded=!0,n.loadError=!0)},s=t.st.image,l=i.find(".mfp-img");if(l.length){var c=document.createElement("img");c.className="mfp-img",n.img=e(c).on("load.mfploader",r).on("error.mfploader",a),c.src=n.src,l.is("img")&&(n.img=n.img.clone()),c=n.img[0],c.naturalWidth>0?n.hasSize=!0:c.width||(n.hasSize=!1)}return t._parseMarkup(i,{title:N(n),img_replaceWith:n.img},n),t.resizeImage(),n.hasSize?(j&&clearInterval(j),n.loadError?(i.addClass("mfp-loading"),t.updateStatus("error",s.tError.replace("%url%",n.src))):(i.removeClass("mfp-loading"),t.updateStatus("ready")),i):(t.updateStatus("loading"),n.loading=!0,n.hasSize||(n.imgHidden=!0,i.addClass("mfp-loading"),t.findImageSize(n)),i)}}});var W,R=function(){return void 0===W&&(W=void 0!==document.createElement("p").style.MozTransform),W};e.magnificPopup.registerModule("zoom",{options:{enabled:!1,easing:"ease-in-out",duration:300,opener:function(e){return e.is("img")?e:e.find("img")}},proto:{initZoom:function(){var e,n=t.st.zoom,i=".zoom";if(n.enabled&&t.supportsTransition){var o,r,a=n.duration,s=function(e){var t=e.clone().removeAttr("style").removeAttr("class").addClass("mfp-animated-image"),i="all "+n.duration/1e3+"s "+n.easing,o={position:"fixed",zIndex:9999,left:0,top:0,"-webkit-backface-visibility":"hidden"},r="transition";return o["-webkit-"+r]=o["-moz-"+r]=o["-o-"+r]=o[r]=i,t.css(o),t},d=function(){t.content.css("visibility","visible")};x("BuildControls"+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.content.css("visibility","hidden"),e=t._getItemToZoom(),!e)return d(),void 0;r=s(e),r.css(t._getOffset()),t.wrap.append(r),o=setTimeout(function(){r.css(t._getOffset(!0)),o=setTimeout(function(){d(),setTimeout(function(){r.remove(),e=r=null,T("ZoomAnimationEnded")},16)},a)},16)}}),x(c+i,function(){if(t._allowZoom()){if(clearTimeout(o),t.st.removalDelay=a,!e){if(e=t._getItemToZoom(),!e)return;r=s(e)}r.css(t._getOffset(!0)),t.wrap.append(r),t.content.css("visibility","hidden"),setTimeout(function(){r.css(t._getOffset())},16)}}),x(l+i,function(){t._allowZoom()&&(d(),r&&r.remove(),e=null)})}},_allowZoom:function(){return"image"===t.currItem.type},_getItemToZoom:function(){return t.currItem.hasSize?t.currItem.img:!1},_getOffset:function(n){var i;i=n?t.currItem.img:t.st.zoom.opener(t.currItem.el||t.currItem);var o=i.offset(),r=parseInt(i.css("padding-top"),10),a=parseInt(i.css("padding-bottom"),10);o.top-=e(window).scrollTop()-r;var s={width:i.width(),height:(b?i.innerHeight():i[0].offsetHeight)-a-r};return R()?s["-moz-transform"]=s.transform="translate("+o.left+"px,"+o.top+"px)":(s.left=o.left,s.top=o.top),s}}});var Z="iframe",q="//about:blank",D=function(e){if(t.currTemplate[Z]){var n=t.currTemplate[Z].find("iframe");n.length&&(e||(n[0].src=q),t.isIE8&&n.css("display",e?"block":"none"))}};e.magnificPopup.registerModule(Z,{options:{markup:'<div class="mfp-iframe-scaler"><div class="mfp-close"></div><iframe class="mfp-iframe" src="//about:blank" frameborder="0" allowfullscreen></iframe></div>',srcAction:"iframe_src",patterns:{youtube:{index:"youtube.com",id:"v=",src:"//www.youtube.com/embed/%id%?autoplay=1"},vimeo:{index:"vimeo.com/",id:"/",src:"//player.vimeo.com/video/%id%?autoplay=1"},gmaps:{index:"//maps.google.",src:"%id%&output=embed"}}},proto:{initIframe:function(){t.types.push(Z),x("BeforeChange",function(e,t,n){t!==n&&(t===Z?D():n===Z&&D(!0))}),x(l+"."+Z,function(){D()})},getIframe:function(n,i){var o=n.src,r=t.st.iframe;e.each(r.patterns,function(){return o.indexOf(this.index)>-1?(this.id&&(o="string"==typeof this.id?o.substr(o.lastIndexOf(this.id)+this.id.length,o.length):this.id.call(this,o)),o=this.src.replace("%id%",o),!1):void 0});var a={};return r.srcAction&&(a[r.srcAction]=o),t._parseMarkup(i,a,n),t.updateStatus("ready"),i}}});var K=function(e){var n=t.items.length;return e>n-1?e-n:0>e?n+e:e},Y=function(e,t,n){return e.replace(/%curr%/gi,t+1).replace(/%total%/gi,n)};e.magnificPopup.registerModule("gallery",{options:{enabled:!1,arrowMarkup:'<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>',preload:[0,2],navigateByImgClick:!0,arrows:!0,tPrev:"Previous (Left arrow key)",tNext:"Next (Right arrow key)",tCounter:"%curr% of %total%"},proto:{initGallery:function(){var n=t.st.gallery,i=".mfp-gallery",r=Boolean(e.fn.mfpFastClick);return t.direction=!0,n&&n.enabled?(a+=" mfp-gallery",x(f+i,function(){n.navigateByImgClick&&t.wrap.on("click"+i,".mfp-img",function(){return t.items.length>1?(t.next(),!1):void 0}),o.on("keydown"+i,function(e){37===e.keyCode?t.prev():39===e.keyCode&&t.next()})}),x("UpdateStatus"+i,function(e,n){n.text&&(n.text=Y(n.text,t.currItem.index,t.items.length))}),x(p+i,function(e,i,o,r){var a=t.items.length;o.counter=a>1?Y(n.tCounter,r.index,a):""}),x("BuildControls"+i,function(){if(t.items.length>1&&n.arrows&&!t.arrowLeft){var i=n.arrowMarkup,o=t.arrowLeft=e(i.replace(/%title%/gi,n.tPrev).replace(/%dir%/gi,"left")).addClass(y),a=t.arrowRight=e(i.replace(/%title%/gi,n.tNext).replace(/%dir%/gi,"right")).addClass(y),s=r?"mfpFastClick":"click";o[s](function(){t.prev()}),a[s](function(){t.next()}),t.isIE7&&(k("b",o[0],!1,!0),k("a",o[0],!1,!0),k("b",a[0],!1,!0),k("a",a[0],!1,!0)),t.container.append(o.add(a))}}),x(m+i,function(){t._preloadTimeout&&clearTimeout(t._preloadTimeout),t._preloadTimeout=setTimeout(function(){t.preloadNearbyImages(),t._preloadTimeout=null},16)}),x(l+i,function(){o.off(i),t.wrap.off("click"+i),t.arrowLeft&&r&&t.arrowLeft.add(t.arrowRight).destroyMfpFastClick(),t.arrowRight=t.arrowLeft=null}),void 0):!1},next:function(){t.direction=!0,t.index=K(t.index+1),t.updateItemHTML()},prev:function(){t.direction=!1,t.index=K(t.index-1),t.updateItemHTML()},goTo:function(e){t.direction=e>=t.index,t.index=e,t.updateItemHTML()},preloadNearbyImages:function(){var e,n=t.st.gallery.preload,i=Math.min(n[0],t.items.length),o=Math.min(n[1],t.items.length);for(e=1;(t.direction?o:i)>=e;e++)t._preloadItem(t.index+e);for(e=1;(t.direction?i:o)>=e;e++)t._preloadItem(t.index-e)},_preloadItem:function(n){if(n=K(n),!t.items[n].preloaded){var i=t.items[n];i.parsed||(i=t.parseEl(n)),T("LazyLoad",i),"image"===i.type&&(i.img=e('<img class="mfp-img" />').on("load.mfploader",function(){i.hasSize=!0}).on("error.mfploader",function(){i.hasSize=!0,i.loadError=!0,T("LazyLoadError",i)}).attr("src",i.src)),i.preloaded=!0}}}});var U="retina";e.magnificPopup.registerModule(U,{options:{replaceSrc:function(e){return e.src.replace(/\.\w+$/,function(e){return"@2x"+e})},ratio:1},proto:{initRetina:function(){if(window.devicePixelRatio>1){var e=t.st.retina,n=e.ratio;n=isNaN(n)?n():n,n>1&&(x("ImageHasSize."+U,function(e,t){t.img.css({"max-width":t.img[0].naturalWidth/n,width:"100%"})}),x("ElementParse."+U,function(t,i){i.src=e.replaceSrc(i,n)}))}}}}),function(){var t=1e3,n="ontouchstart"in window,i=function(){I.off("touchmove"+r+" touchend"+r)},o="mfpFastClick",r="."+o;e.fn.mfpFastClick=function(o){return e(this).each(function(){var a,s=e(this);if(n){var l,c,d,u,p,f;s.on("touchstart"+r,function(e){u=!1,f=1,p=e.originalEvent?e.originalEvent.touches[0]:e.touches[0],c=p.clientX,d=p.clientY,I.on("touchmove"+r,function(e){p=e.originalEvent?e.originalEvent.touches:e.touches,f=p.length,p=p[0],(Math.abs(p.clientX-c)>10||Math.abs(p.clientY-d)>10)&&(u=!0,i())}).on("touchend"+r,function(e){i(),u||f>1||(a=!0,e.preventDefault(),clearTimeout(l),l=setTimeout(function(){a=!1},t),o())})})}s.on("click"+r,function(){a||o()})})},e.fn.destroyMfpFastClick=function(){e(this).off("touchstart"+r+" click"+r),n&&I.off("touchmove"+r+" touchend"+r)}}(),_()})(window.jQuery||window.Zepto);

/*! Switchery */
(function(){function require(name){var module=require.modules[name];if(!module)throw new Error('failed to require "'+name+'"');if(!("exports"in module)&&typeof module.definition==="function"){module.client=module.component=true;module.definition.call(this,module.exports={},module);delete module.definition}return module.exports}require.loader="component";require.helper={};require.helper.semVerSort=function(a,b){var aArray=a.version.split(".");var bArray=b.version.split(".");for(var i=0;i<aArray.length;++i){var aInt=parseInt(aArray[i],10);var bInt=parseInt(bArray[i],10);if(aInt===bInt){var aLex=aArray[i].substr((""+aInt).length);var bLex=bArray[i].substr((""+bInt).length);if(aLex===""&&bLex!=="")return 1;if(aLex!==""&&bLex==="")return-1;if(aLex!==""&&bLex!=="")return aLex>bLex?1:-1;continue}else if(aInt>bInt){return 1}else{return-1}}return 0};require.latest=function(name,returnPath){function showError(name){throw new Error('failed to find latest module of "'+name+'"')}var versionRegexp=/(.*)~(.*)@v?(\d+\.\d+\.\d+[^\/]*)$/;var remoteRegexp=/(.*)~(.*)/;if(!remoteRegexp.test(name))showError(name);var moduleNames=Object.keys(require.modules);var semVerCandidates=[];var otherCandidates=[];for(var i=0;i<moduleNames.length;i++){var moduleName=moduleNames[i];if(new RegExp(name+"@").test(moduleName)){var version=moduleName.substr(name.length+1);var semVerMatch=versionRegexp.exec(moduleName);if(semVerMatch!=null){semVerCandidates.push({version:version,name:moduleName})}else{otherCandidates.push({version:version,name:moduleName})}}}if(semVerCandidates.concat(otherCandidates).length===0){showError(name)}if(semVerCandidates.length>0){var module=semVerCandidates.sort(require.helper.semVerSort).pop().name;if(returnPath===true){return module}return require(module)}var module=otherCandidates.pop().name;if(returnPath===true){return module}return require(module)};require.modules={};require.register=function(name,definition){require.modules[name]={definition:definition}};require.define=function(name,exports){require.modules[name]={exports:exports}};require.register("abpetkov~transitionize@0.0.3",function(exports,module){module.exports=Transitionize;function Transitionize(element,props){if(!(this instanceof Transitionize))return new Transitionize(element,props);this.element=element;this.props=props||{};this.init()}Transitionize.prototype.isSafari=function(){return/Safari/.test(navigator.userAgent)&&/Apple Computer/.test(navigator.vendor)};Transitionize.prototype.init=function(){var transitions=[];for(var key in this.props){transitions.push(key+" "+this.props[key])}this.element.style.transition=transitions.join(", ");if(this.isSafari())this.element.style.webkitTransition=transitions.join(", ")}});require.register("ftlabs~fastclick@v0.6.11",function(exports,module){function FastClick(layer){"use strict";var oldOnClick,self=this;this.trackingClick=false;this.trackingClickStart=0;this.targetElement=null;this.touchStartX=0;this.touchStartY=0;this.lastTouchIdentifier=0;this.touchBoundary=10;this.layer=layer;if(!layer||!layer.nodeType){throw new TypeError("Layer must be a document node")}this.onClick=function(){return FastClick.prototype.onClick.apply(self,arguments)};this.onMouse=function(){return FastClick.prototype.onMouse.apply(self,arguments)};this.onTouchStart=function(){return FastClick.prototype.onTouchStart.apply(self,arguments)};this.onTouchMove=function(){return FastClick.prototype.onTouchMove.apply(self,arguments)};this.onTouchEnd=function(){return FastClick.prototype.onTouchEnd.apply(self,arguments)};this.onTouchCancel=function(){return FastClick.prototype.onTouchCancel.apply(self,arguments)};if(FastClick.notNeeded(layer)){return}if(this.deviceIsAndroid){layer.addEventListener("mouseover",this.onMouse,true);layer.addEventListener("mousedown",this.onMouse,true);layer.addEventListener("mouseup",this.onMouse,true)}layer.addEventListener("click",this.onClick,true);layer.addEventListener("touchstart",this.onTouchStart,false);layer.addEventListener("touchmove",this.onTouchMove,false);layer.addEventListener("touchend",this.onTouchEnd,false);layer.addEventListener("touchcancel",this.onTouchCancel,false);if(!Event.prototype.stopImmediatePropagation){layer.removeEventListener=function(type,callback,capture){var rmv=Node.prototype.removeEventListener;if(type==="click"){rmv.call(layer,type,callback.hijacked||callback,capture)}else{rmv.call(layer,type,callback,capture)}};layer.addEventListener=function(type,callback,capture){var adv=Node.prototype.addEventListener;if(type==="click"){adv.call(layer,type,callback.hijacked||(callback.hijacked=function(event){if(!event.propagationStopped){callback(event)}}),capture)}else{adv.call(layer,type,callback,capture)}}}if(typeof layer.onclick==="function"){oldOnClick=layer.onclick;layer.addEventListener("click",function(event){oldOnClick(event)},false);layer.onclick=null}}FastClick.prototype.deviceIsAndroid=navigator.userAgent.indexOf("Android")>0;FastClick.prototype.deviceIsIOS=/iP(ad|hone|od)/.test(navigator.userAgent);FastClick.prototype.deviceIsIOS4=FastClick.prototype.deviceIsIOS&&/OS 4_\d(_\d)?/.test(navigator.userAgent);FastClick.prototype.deviceIsIOSWithBadTarget=FastClick.prototype.deviceIsIOS&&/OS ([6-9]|\d{2})_\d/.test(navigator.userAgent);FastClick.prototype.needsClick=function(target){"use strict";switch(target.nodeName.toLowerCase()){case"button":case"select":case"textarea":if(target.disabled){return true}break;case"input":if(this.deviceIsIOS&&target.type==="file"||target.disabled){return true}break;case"label":case"video":return true}return/\bneedsclick\b/.test(target.className)};FastClick.prototype.needsFocus=function(target){"use strict";switch(target.nodeName.toLowerCase()){case"textarea":return true;case"select":return!this.deviceIsAndroid;case"input":switch(target.type){case"button":case"checkbox":case"file":case"image":case"radio":case"submit":return false}return!target.disabled&&!target.readOnly;default:return/\bneedsfocus\b/.test(target.className)}};FastClick.prototype.sendClick=function(targetElement,event){"use strict";var clickEvent,touch;if(document.activeElement&&document.activeElement!==targetElement){document.activeElement.blur()}touch=event.changedTouches[0];clickEvent=document.createEvent("MouseEvents");clickEvent.initMouseEvent(this.determineEventType(targetElement),true,true,window,1,touch.screenX,touch.screenY,touch.clientX,touch.clientY,false,false,false,false,0,null);clickEvent.forwardedTouchEvent=true;targetElement.dispatchEvent(clickEvent)};FastClick.prototype.determineEventType=function(targetElement){"use strict";if(this.deviceIsAndroid&&targetElement.tagName.toLowerCase()==="select"){return"mousedown"}return"click"};FastClick.prototype.focus=function(targetElement){"use strict";var length;if(this.deviceIsIOS&&targetElement.setSelectionRange&&targetElement.type.indexOf("date")!==0&&targetElement.type!=="time"){length=targetElement.value.length;targetElement.setSelectionRange(length,length)}else{targetElement.focus()}};FastClick.prototype.updateScrollParent=function(targetElement){"use strict";var scrollParent,parentElement;scrollParent=targetElement.fastClickScrollParent;if(!scrollParent||!scrollParent.contains(targetElement)){parentElement=targetElement;do{if(parentElement.scrollHeight>parentElement.offsetHeight){scrollParent=parentElement;targetElement.fastClickScrollParent=parentElement;break}parentElement=parentElement.parentElement}while(parentElement)}if(scrollParent){scrollParent.fastClickLastScrollTop=scrollParent.scrollTop}};FastClick.prototype.getTargetElementFromEventTarget=function(eventTarget){"use strict";if(eventTarget.nodeType===Node.TEXT_NODE){return eventTarget.parentNode}return eventTarget};FastClick.prototype.onTouchStart=function(event){"use strict";var targetElement,touch,selection;if(event.targetTouches.length>1){return true}targetElement=this.getTargetElementFromEventTarget(event.target);touch=event.targetTouches[0];if(this.deviceIsIOS){selection=window.getSelection();if(selection.rangeCount&&!selection.isCollapsed){return true}if(!this.deviceIsIOS4){if(touch.identifier===this.lastTouchIdentifier){event.preventDefault();return false}this.lastTouchIdentifier=touch.identifier;this.updateScrollParent(targetElement)}}this.trackingClick=true;this.trackingClickStart=event.timeStamp;this.targetElement=targetElement;this.touchStartX=touch.pageX;this.touchStartY=touch.pageY;if(event.timeStamp-this.lastClickTime<200){event.preventDefault()}return true};FastClick.prototype.touchHasMoved=function(event){"use strict";var touch=event.changedTouches[0],boundary=this.touchBoundary;if(Math.abs(touch.pageX-this.touchStartX)>boundary||Math.abs(touch.pageY-this.touchStartY)>boundary){return true}return false};FastClick.prototype.onTouchMove=function(event){"use strict";if(!this.trackingClick){return true}if(this.targetElement!==this.getTargetElementFromEventTarget(event.target)||this.touchHasMoved(event)){this.trackingClick=false;this.targetElement=null}return true};FastClick.prototype.findControl=function(labelElement){"use strict";if(labelElement.control!==undefined){return labelElement.control}if(labelElement.htmlFor){return document.getElementById(labelElement.htmlFor)}return labelElement.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")};FastClick.prototype.onTouchEnd=function(event){"use strict";var forElement,trackingClickStart,targetTagName,scrollParent,touch,targetElement=this.targetElement;if(!this.trackingClick){return true}if(event.timeStamp-this.lastClickTime<200){this.cancelNextClick=true;return true}this.cancelNextClick=false;this.lastClickTime=event.timeStamp;trackingClickStart=this.trackingClickStart;this.trackingClick=false;this.trackingClickStart=0;if(this.deviceIsIOSWithBadTarget){touch=event.changedTouches[0];targetElement=document.elementFromPoint(touch.pageX-window.pageXOffset,touch.pageY-window.pageYOffset)||targetElement;targetElement.fastClickScrollParent=this.targetElement.fastClickScrollParent}targetTagName=targetElement.tagName.toLowerCase();if(targetTagName==="label"){forElement=this.findControl(targetElement);if(forElement){this.focus(targetElement);if(this.deviceIsAndroid){return false}targetElement=forElement}}else if(this.needsFocus(targetElement)){if(event.timeStamp-trackingClickStart>100||this.deviceIsIOS&&window.top!==window&&targetTagName==="input"){this.targetElement=null;return false}this.focus(targetElement);if(!this.deviceIsIOS4||targetTagName!=="select"){this.targetElement=null;event.preventDefault()}return false}if(this.deviceIsIOS&&!this.deviceIsIOS4){scrollParent=targetElement.fastClickScrollParent;if(scrollParent&&scrollParent.fastClickLastScrollTop!==scrollParent.scrollTop){return true}}if(!this.needsClick(targetElement)){event.preventDefault();this.sendClick(targetElement,event)}return false};FastClick.prototype.onTouchCancel=function(){"use strict";this.trackingClick=false;this.targetElement=null};FastClick.prototype.onMouse=function(event){"use strict";if(!this.targetElement){return true}if(event.forwardedTouchEvent){return true}if(!event.cancelable){return true}if(!this.needsClick(this.targetElement)||this.cancelNextClick){if(event.stopImmediatePropagation){event.stopImmediatePropagation()}else{event.propagationStopped=true}event.stopPropagation();event.preventDefault();return false}return true};FastClick.prototype.onClick=function(event){"use strict";var permitted;if(this.trackingClick){this.targetElement=null;this.trackingClick=false;return true}if(event.target.type==="submit"&&event.detail===0){return true}permitted=this.onMouse(event);if(!permitted){this.targetElement=null}return permitted};FastClick.prototype.destroy=function(){"use strict";var layer=this.layer;if(this.deviceIsAndroid){layer.removeEventListener("mouseover",this.onMouse,true);layer.removeEventListener("mousedown",this.onMouse,true);layer.removeEventListener("mouseup",this.onMouse,true)}layer.removeEventListener("click",this.onClick,true);layer.removeEventListener("touchstart",this.onTouchStart,false);layer.removeEventListener("touchmove",this.onTouchMove,false);layer.removeEventListener("touchend",this.onTouchEnd,false);layer.removeEventListener("touchcancel",this.onTouchCancel,false)};FastClick.notNeeded=function(layer){"use strict";var metaViewport;var chromeVersion;if(typeof window.ontouchstart==="undefined"){return true}chromeVersion=+(/Chrome\/([0-9]+)/.exec(navigator.userAgent)||[,0])[1];if(chromeVersion){if(FastClick.prototype.deviceIsAndroid){metaViewport=document.querySelector("meta[name=viewport]");if(metaViewport){if(metaViewport.content.indexOf("user-scalable=no")!==-1){return true}if(chromeVersion>31&&window.innerWidth<=window.screen.width){return true}}}else{return true}}if(layer.style.msTouchAction==="none"){return true}return false};FastClick.attach=function(layer){"use strict";return new FastClick(layer)};if(typeof define!=="undefined"&&define.amd){define(function(){"use strict";return FastClick})}else if(typeof module!=="undefined"&&module.exports){module.exports=FastClick.attach;module.exports.FastClick=FastClick}else{window.FastClick=FastClick}});require.register("component~indexof@0.0.3",function(exports,module){module.exports=function(arr,obj){if(arr.indexOf)return arr.indexOf(obj);for(var i=0;i<arr.length;++i){if(arr[i]===obj)return i}return-1}});require.register("component~classes@1.2.1",function(exports,module){var index=require("component~indexof@0.0.3");var re=/\s+/;var toString=Object.prototype.toString;module.exports=function(el){return new ClassList(el)};function ClassList(el){if(!el)throw new Error("A DOM element reference is required");this.el=el;this.list=el.classList}ClassList.prototype.add=function(name){if(this.list){this.list.add(name);return this}var arr=this.array();var i=index(arr,name);if(!~i)arr.push(name);this.el.className=arr.join(" ");return this};ClassList.prototype.remove=function(name){if("[object RegExp]"==toString.call(name)){return this.removeMatching(name)}if(this.list){this.list.remove(name);return this}var arr=this.array();var i=index(arr,name);if(~i)arr.splice(i,1);this.el.className=arr.join(" ");return this};ClassList.prototype.removeMatching=function(re){var arr=this.array();for(var i=0;i<arr.length;i++){if(re.test(arr[i])){this.remove(arr[i])}}return this};ClassList.prototype.toggle=function(name,force){if(this.list){if("undefined"!==typeof force){if(force!==this.list.toggle(name,force)){this.list.toggle(name)}}else{this.list.toggle(name)}return this}if("undefined"!==typeof force){if(!force){this.remove(name)}else{this.add(name)}}else{if(this.has(name)){this.remove(name)}else{this.add(name)}}return this};ClassList.prototype.array=function(){var str=this.el.className.replace(/^\s+|\s+$/g,"");var arr=str.split(re);if(""===arr[0])arr.shift();return arr};ClassList.prototype.has=ClassList.prototype.contains=function(name){return this.list?this.list.contains(name):!!~index(this.array(),name)}});require.register("switchery",function(exports,module){var transitionize=require("abpetkov~transitionize@0.0.3"),fastclick=require("ftlabs~fastclick@v0.6.11"),classes=require("component~classes@1.2.1");module.exports=Switchery;var defaults={color:"#64bd63",secondaryColor:"#dfdfdf",jackColor:"#fff",className:"switchery",disabled:false,disabledOpacity:.5,speed:"0.4s",size:"default"};function Switchery(element,options){if(!(this instanceof Switchery))return new Switchery(element,options);this.element=element;this.options=options||{};for(var i in defaults){if(this.options[i]==null){this.options[i]=defaults[i]}}if(this.element!=null&&this.element.type=="checkbox")this.init()}Switchery.prototype.hide=function(){this.element.style.display="none"};Switchery.prototype.show=function(){var switcher=this.create();this.insertAfter(this.element,switcher)};Switchery.prototype.create=function(){this.switcher=document.createElement("span");this.jack=document.createElement("small");this.switcher.appendChild(this.jack);this.switcher.className=this.options.className;return this.switcher};Switchery.prototype.insertAfter=function(reference,target){reference.parentNode.insertBefore(target,reference.nextSibling)};Switchery.prototype.isChecked=function(){return this.element.checked};Switchery.prototype.isDisabled=function(){return this.options.disabled||this.element.disabled||this.element.readOnly};Switchery.prototype.setPosition=function(clicked){var checked=this.isChecked(),switcher=this.switcher,jack=this.jack;if(clicked&&checked)checked=false;else if(clicked&&!checked)checked=true;if(checked===true){this.element.checked=true;if(window.getComputedStyle)jack.style.left=parseInt(window.getComputedStyle(switcher).width)-parseInt(window.getComputedStyle(jack).width)+"px";else jack.style.left=parseInt(switcher.currentStyle["width"])-parseInt(jack.currentStyle["width"])+"px";if(this.options.color)this.colorize();this.setSpeed()}else{jack.style.left=0;this.element.checked=false;this.switcher.style.boxShadow="inset 0 0 0 0 "+this.options.secondaryColor;this.switcher.style.borderColor=this.options.secondaryColor;this.switcher.style.backgroundColor=this.options.secondaryColor!==defaults.secondaryColor?this.options.secondaryColor:"#fff";this.jack.style.backgroundColor=this.options.jackColor;this.setSpeed()}};Switchery.prototype.setSpeed=function(){var switcherProp={},jackProp={left:this.options.speed.replace(/[a-z]/,"")/2+"s"};if(this.isChecked()){switcherProp={border:this.options.speed,"box-shadow":this.options.speed,"background-color":this.options.speed.replace(/[a-z]/,"")*3+"s"}}else{switcherProp={border:this.options.speed,"box-shadow":this.options.speed}}transitionize(this.switcher,switcherProp);transitionize(this.jack,jackProp)};Switchery.prototype.setSize=function(){var small="switchery-small",normal="switchery-default",large="switchery-large";switch(this.options.size){case"small":classes(this.switcher).add(small);break;case"large":classes(this.switcher).add(large);break;default:classes(this.switcher).add(normal);break}};Switchery.prototype.colorize=function(){var switcherHeight=this.switcher.offsetHeight/2;this.switcher.style.backgroundColor=this.options.color;this.switcher.style.borderColor=this.options.color;this.switcher.style.boxShadow="inset 0 0 0 "+switcherHeight+"px "+this.options.color;this.jack.style.backgroundColor=this.options.jackColor};Switchery.prototype.handleOnchange=function(state){if(document.dispatchEvent){var event=document.createEvent("HTMLEvents");event.initEvent("change",true,true);this.element.dispatchEvent(event)}else{this.element.fireEvent("onchange")}};Switchery.prototype.handleChange=function(){var self=this,el=this.element;if(el.addEventListener){el.addEventListener("change",function(){self.setPosition()})}else{el.attachEvent("onchange",function(){self.setPosition()})}};Switchery.prototype.handleClick=function(){var self=this,switcher=this.switcher,parent=self.element.parentNode.tagName.toLowerCase(),labelParent=parent==="label"?false:true;if(this.isDisabled()===false){fastclick(switcher);if(switcher.addEventListener){switcher.addEventListener("click",function(e){self.setPosition(labelParent);self.handleOnchange(self.element.checked)})}else{switcher.attachEvent("onclick",function(){self.setPosition(labelParent);self.handleOnchange(self.element.checked)})}}else{this.element.disabled=true;this.switcher.style.opacity=this.options.disabledOpacity}};Switchery.prototype.markAsSwitched=function(){this.element.setAttribute("data-switchery",true)};Switchery.prototype.markedAsSwitched=function(){return this.element.getAttribute("data-switchery")};Switchery.prototype.init=function(){this.hide();this.show();this.setSize();this.setPosition();this.markAsSwitched();this.handleChange();this.handleClick()}});if(typeof exports=="object"){module.exports=require("switchery")}else if(typeof define=="function"&&define.amd){define("Switchery",[],function(){return require("switchery")})}else{(this||window)["Switchery"]=require("switchery")}})();

/*!
 * FitText.js 1.2
 *
 * Copyright 2011, Dave Rupert http://daverupert.com
 * Released under the WTFPL license
 * http://sam.zoy.org/wtfpl/
 *
 * Date: Thu May 05 14:23:00 2011 -0600
 */
!function (t) {
    t.fn.fitText = function (o, e) {
        var i = o || 1, n = t.extend({minFontSize: Number.NEGATIVE_INFINITY, maxFontSize: Number.POSITIVE_INFINITY}, e);
        return this.each(function () {
            var o = t(this), e = function () {
                o.css("font-size",
                    Math.max(Math.min(o.width() / (10 * i), parseFloat(n.maxFontSize)), parseFloat(n.minFontSize)))
            };
            e(), t(window).on("resize.fittext orientationchange.fittext", e)
        })
    }
}(jQuery);
var isMobile = {
    Android: function () {
        return /Android/i.test(navigator.userAgent)
    }, iOS: function () {
        return /iPhone|iPad|iPod/i.test(navigator.userAgent)
    }
};
$(document).ready(function () {
    isMobile.Android() && $(".lnk-android").removeClass("hidden"), isMobile.iOS() && $(".lnk-ios").removeClass("hidden")
}), function (t) {
    "function" == typeof define && define.amd ? define(["jquery"], t) : t("object" == typeof exports ? require("jquery")
        : jQuery)
}(function (t) {
    function o(t) {
        return a.raw ? t : encodeURIComponent(t)
    }

    function e(t) {
        return a.raw ? t : decodeURIComponent(t)
    }

    function i(t) {
        return o(a.json ? JSON.stringify(t) : String(t))
    }

    function n(t) {
        0 === t.indexOf('"') && (t = t.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, "\\"));
        try {
            return t = decodeURIComponent(t.replace(r, " ")), a.json ? JSON.parse(t) : t
        } catch (o) {
        }
    }

    function s(o, e) {
        var i = a.raw ? o : n(o);
        return t.isFunction(e) ? e(i) : i
    }

    var r = /\+/g, a = t.cookie = function (n, r, l) {
        if (arguments.length > 1 && !t.isFunction(r)) {
            if (l = t.extend({}, a.defaults, l), "number" == typeof l.expires) {
                var p = l.expires, f = l.expires = new Date;
                f.setTime(+f + 864e5 * p)
            }
            return document.cookie = [o(n), "=", i(r), l.expires ? "; expires=" + l.expires.toUTCString() : "",
                l.path ? "; path=" + l.path : "", l.domain ? "; domain=" + l.domain : "",
                l.secure ? "; secure" : ""].join("")
        }
        for (var d = n ? void 0 : {}, c = document.cookie ? document.cookie.split("; ") : [], u = 0, h = c.length;
            h > u; u++) {
            var m = c[u].split("="), v = e(m.shift()), g = m.join("=");
            if (n && n === v) {
                d = s(g, r);
                break
            }
            n || void 0 === (g = s(g)) || (d[v] = g)
        }
        return d
    };
    a.defaults = {}, t.removeCookie = function (o, e) {
        return void 0 === t.cookie(o) ? !1 : (t.cookie(o, "", t.extend({}, e, {expires: -1})), !t.cookie(o))
    }
}), function (t, o, e) {
    function i(o, e) {
        this.bodyOverflowX, this.callbacks = {hide: [], show: []}, this.checkInterval = null, this.Content, this.$el
            = t(o), this.$elProxy, this.elProxyPosition, this.enabled = !0, this.options = t.extend({}, l,
            e), this.mouseIsOverProxy = !1, this.namespace = "tooltipster-" + Math.round(1e5
        * Math.random()), this.Status = "hidden", this.timerHide = null, this.timerShow
            = null, this.$tooltip, this.options.iconTheme = this.options.iconTheme.replace(".", ""), this.options.theme
            = this.options.theme.replace(".", ""), this._init()
    }

    function n(o, e) {
        var i = !0;
        return t.each(o, function (t) {
            return "undefined" == typeof e[t] || o[t] !== e[t] ? (i = !1, !1) : void 0
        }), i
    }

    function s() {
        return !f && p
    }

    function r() {
        var t = e.body || e.documentElement, o = t.style, i = "transition";
        if ("string" == typeof o[i]) {
            return !0;
        }
        v = ["Moz", "Webkit", "Khtml", "O", "ms"], i = i.charAt(0).toUpperCase() + i.substr(1);
        for (var n = 0; n < v.length; n++) {
            if ("string" == typeof o[v[n] + i]) {
                return !0;
            }
        }
        return !1
    }

    var a = "tooltipster", l = {
        animation: "fade",
        arrow: !0,
        arrowColor: "",
        autoClose: !0,
        content: null,
        contentAsHTML: !1,
        contentCloning: !0,
        debug: !0,
        delay: 200,
        minWidth: 0,
        maxWidth: null,
        functionInit: function () {
        },
        functionBefore: function (t, o) {
            o()
        },
        functionReady: function () {
        },
        functionAfter: function () {
        },
        hideOnClick: !1,
        icon: "(?)",
        iconCloning: !0,
        iconDesktop: !1,
        iconTouch: !1,
        iconTheme: "tooltipster-icon",
        interactive: !1,
        interactiveTolerance: 350,
        multiple: !1,
        offsetX: 0,
        offsetY: 0,
        onlyOne: !1,
        position: "top",
        positionTracker: !1,
        positionTrackerCallback: function () {
            "hover" == this.option("trigger") && this.option("autoClose") && this.hide()
        },
        restoration: "current",
        speed: 350,
        timer: 0,
        theme: "tooltipster-default",
        touchDevices: !0,
        trigger: "hover",
        updateAnimation: !0
    };
    i.prototype = {
        _init: function () {
            var o = this;
            if (e.querySelector) {
                var i = null;
                void 0 === o.$el.data("tooltipster-initialTitle") && (i = o.$el.attr("title"), void 0 === i && (i
                    = null), o.$el.data("tooltipster-initialTitle", i)), o._content_set(null !== o.options.content
                    ? o.options.content : i);
                var n = o.options.functionInit.call(o.$el, o.$el, o.Content);
                "undefined" != typeof n && o._content_set(n), o.$el.removeAttr("title").addClass("tooltipstered"), !p
                && o.options.iconDesktop || p && o.options.iconTouch ? ("string" == typeof o.options.icon ? (o.$elProxy
                    = t('<span class="' + o.options.iconTheme + '"></span>'), o.$elProxy.text(o.options.icon))
                    : o.$elProxy = o.options.iconCloning ? o.options.icon.clone(!0)
                    : o.options.icon, o.$elProxy.insertAfter(o.$el)) : o.$elProxy = o.$el, "hover" == o.options.trigger
                    ? (o.$elProxy.on("mouseenter." + o.namespace, function () {
                    (!s() || o.options.touchDevices) && (o.mouseIsOverProxy = !0, o._show())
                }).on("mouseleave." + o.namespace, function () {
                    (!s() || o.options.touchDevices) && (o.mouseIsOverProxy = !1)
                }), p && o.options.touchDevices && o.$elProxy.on("touchstart." + o.namespace, function () {
                    o._showNow()
                })) : "click" == o.options.trigger && o.$elProxy.on("click." + o.namespace, function () {
                    (!s() || o.options.touchDevices) && o._show()
                })
            }
        }, _show: function () {
            var t = this;
            "shown" != t.Status && "appearing" != t.Status && (t.options.delay ? t.timerShow = setTimeout(function () {
                ("click" == t.options.trigger || "hover" == t.options.trigger && t.mouseIsOverProxy) && t._showNow()
            }, t.options.delay) : t._showNow())
        }, _showNow: function (e) {
            var i = this;
            i.options.functionBefore.call(i.$el, i.$el, function () {
                if (i.enabled && null !== i.Content) {
                    e && i.callbacks.show.push(e), i.callbacks.hide = [], clearTimeout(i.timerShow), i.timerShow
                        = null, clearTimeout(i.timerHide), i.timerHide = null, i.options.onlyOne
                    && t(".tooltipstered").not(i.$el).each(function (o, e) {
                        var i = t(e), n = i.data("tooltipster-ns");
                        t.each(n, function (t, o) {
                            var e = i.data(o), n = e.status(), s = e.option("autoClose");
                            "hidden" !== n && "disappearing" !== n && s && e.hide()
                        })
                    });
                    var n = function () {
                        i.Status = "shown", t.each(i.callbacks.show, function (t, o) {
                            o.call(i.$el)
                        }), i.callbacks.show = []
                    };
                    if ("hidden" !== i.Status) {
                        var s = 0;
                        "disappearing" === i.Status ? (i.Status = "appearing", r()
                            ? (i.$tooltip.clearQueue().removeClass("tooltipster-dying").addClass("tooltipster-"
                        + i.options.animation + "-show"), i.options.speed > 0
                        && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(n)) : i.$tooltip.stop().fadeIn(n))
                            : "shown" === i.Status && n()
                    } else {
                        i.Status = "appearing";
                        var s = i.options.speed;
                        i.bodyOverflowX = t("body").css("overflow-x"), t("body").css("overflow-x", "hidden");
                        var a = "tooltipster-" + i.options.animation, l = "-webkit-transition-duration: "
                            + i.options.speed + "ms; -webkit-animation-duration: " + i.options.speed
                            + "ms; -moz-transition-duration: " + i.options.speed + "ms; -moz-animation-duration: "
                            + i.options.speed + "ms; -o-transition-duration: " + i.options.speed
                            + "ms; -o-animation-duration: " + i.options.speed + "ms; -ms-transition-duration: "
                            + i.options.speed + "ms; -ms-animation-duration: " + i.options.speed
                            + "ms; transition-duration: " + i.options.speed + "ms; animation-duration: "
                            + i.options.speed + "ms;", f = i.options.minWidth ? "min-width:"
                        + Math.round(i.options.minWidth) + "px;" : "", d = i.options.maxWidth ? "max-width:"
                        + Math.round(i.options.maxWidth) + "px;" : "", c = i.options.interactive
                            ? "pointer-events: auto;" : "";
                        if (i.$tooltip = t('<div class="tooltipster-base ' + i.options.theme + '" style="' + f + " " + d
                            + " " + c + " " + l + '"><div class="tooltipster-content"></div></div>'), r()
                            && i.$tooltip.addClass(a), i._content_insert(), i.$tooltip.appendTo("body"), i.reposition(), i.options.functionReady.call(i.$el,
                                i.$el, i.$tooltip), r() ? (i.$tooltip.addClass(a + "-show"), i.options.speed > 0
                            && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(n)) : i.$tooltip.css("display",
                                "none").fadeIn(i.options.speed, n), i._interval_set(), t(o).on("scroll." + i.namespace
                            + " resize." + i.namespace, function () {
                                i.reposition()
                            }), i.options.autoClose) {
                            if (t("body").off("." + i.namespace), "hover" == i.options.trigger) {
                                if (p && setTimeout(function () {
                                        t("body").on("touchstart." + i.namespace, function () {
                                            i.hide()
                                        })
                                    }, 0), i.options.interactive) {
                                    p && i.$tooltip.on("touchstart." + i.namespace, function (t) {
                                        t.stopPropagation()
                                    });
                                    var u = null;
                                    i.$elProxy.add(i.$tooltip).on("mouseleave." + i.namespace + "-autoClose",
                                        function () {
                                            clearTimeout(u), u = setTimeout(function () {
                                                i.hide()
                                            }, i.options.interactiveTolerance)
                                        }).on("mouseenter." + i.namespace + "-autoClose", function () {
                                            clearTimeout(u)
                                        })
                                } else {
                                    i.$elProxy.on("mouseleave." + i.namespace + "-autoClose", function () {
                                        i.hide()
                                    });
                                }
                                i.options.hideOnClick && i.$elProxy.on("click." + i.namespace + "-autoClose",
                                    function () {
                                        i.hide()
                                    })
                            } else {
                                "click" == i.options.trigger && (setTimeout(function () {
                                    t("body").on("click." + i.namespace + " touchstart." + i.namespace, function () {
                                        i.hide()
                                    })
                                }, 0), i.options.interactive && i.$tooltip.on("click." + i.namespace + " touchstart."
                                + i.namespace, function (t) {
                                    t.stopPropagation()
                                }))
                            }
                        }
                    }
                    i.options.timer > 0 && (i.timerHide = setTimeout(function () {
                        i.timerHide = null, i.hide()
                    }, i.options.timer + s))
                }
            })
        }, _interval_set: function () {
            var o = this;
            o.checkInterval = setInterval(function () {
                if (0 === t("body").find(o.$el).length || 0 === t("body").find(o.$elProxy).length || "hidden"
                    == o.Status || 0 === t("body").find(o.$tooltip).length) {
                    ("shown" == o.Status || "appearing" == o.Status) && o.hide(), o._interval_cancel();
                } else if (o.options.positionTracker) {
                    var e = o._repositionInfo(o.$elProxy), i = !1;
                    n(e.dimension, o.elProxyPosition.dimension) && ("fixed" === o.$elProxy.css("position")
                        ? n(e.position, o.elProxyPosition.position) && (i = !0) : n(e.offset, o.elProxyPosition.offset)
                    && (i = !0)), i || (o.reposition(), o.options.positionTrackerCallback.call(o, o.$el))
                }
            }, 200)
        }, _interval_cancel: function () {
            clearInterval(this.checkInterval), this.checkInterval = null
        }, _content_set: function (t) {
            "object" == typeof t && null !== t && this.options.contentCloning && (t = t.clone(!0)), this.Content = t
        }, _content_insert: function () {
            var t = this, o = this.$tooltip.find(".tooltipster-content");
            "string" != typeof t.Content || t.options.contentAsHTML ? o.empty().append(t.Content) : o.text(t.Content)
        }, _update: function (t) {
            var o = this;
            o._content_set(t), null !== o.Content ? "hidden" !== o.Status
            && (o._content_insert(), o.reposition(), o.options.updateAnimation && (r() ? (o.$tooltip.css({
                width: "",
                "-webkit-transition": "all " + o.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                "-moz-transition": "all " + o.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                "-o-transition": "all " + o.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                "-ms-transition": "all " + o.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms",
                transition: "all " + o.options.speed + "ms, width 0ms, height 0ms, left 0ms, top 0ms"
            }).addClass("tooltipster-content-changing"), setTimeout(function () {
                "hidden" != o.Status
                && (o.$tooltip.removeClass("tooltipster-content-changing"), setTimeout(function () {
                    "hidden" !== o.Status && o.$tooltip.css({
                        "-webkit-transition": o.options.speed + "ms",
                        "-moz-transition": o.options.speed + "ms",
                        "-o-transition": o.options.speed + "ms",
                        "-ms-transition": o.options.speed + "ms",
                        transition: o.options.speed + "ms"
                    })
                }, o.options.speed))
            }, o.options.speed)) : o.$tooltip.fadeTo(o.options.speed, .5, function () {
                "hidden" != o.Status && o.$tooltip.fadeTo(o.options.speed, 1)
            }))) : o.hide()
        }, _repositionInfo: function (t) {
            return {
                dimension: {height: t.outerHeight(!1), width: t.outerWidth(!1)},
                offset: t.offset(),
                position: {left: parseInt(t.css("left")), top: parseInt(t.css("top"))}
            }
        }, hide: function (e) {
            var i = this;
            e && i.callbacks.hide.push(e), i.callbacks.show = [], clearTimeout(i.timerShow), i.timerShow
                = null, clearTimeout(i.timerHide), i.timerHide = null;
            var n = function () {
                t.each(i.callbacks.hide, function (t, o) {
                    o.call(i.$el)
                }), i.callbacks.hide = []
            };
            if ("shown" == i.Status || "appearing" == i.Status) {
                i.Status = "disappearing";
                var s = function () {
                    i.Status = "hidden", "object" == typeof i.Content && null !== i.Content
                    && i.Content.detach(), i.$tooltip.remove(), i.$tooltip = null, t(o).off("."
                    + i.namespace), t("body").off("." + i.namespace).css("overflow-x",
                        i.bodyOverflowX), t("body").off("." + i.namespace), i.$elProxy.off("." + i.namespace
                    + "-autoClose"), i.options.functionAfter.call(i.$el, i.$el), n()
                };
                r() ? (i.$tooltip.clearQueue().removeClass("tooltipster-" + i.options.animation
                + "-show").addClass("tooltipster-dying"), i.options.speed > 0
                && i.$tooltip.delay(i.options.speed), i.$tooltip.queue(s)) : i.$tooltip.stop().fadeOut(i.options.speed,
                    s)
            } else {
                "hidden" == i.Status && n();
            }
            return i
        }, show: function (t) {
            return this._showNow(t), this
        }, update: function (t) {
            return this.content(t)
        }, content: function (t) {
            return "undefined" == typeof t ? this.Content : (this._update(t), this)
        }, reposition: function () {
            function e() {
                var e = t(o).scrollLeft();
                0 > S - e && (s = S - e, S = e), S + l - e > r && (s = S - (r + e - l), S = r + e - l)
            }

            function i(e, i) {
                a.offset.top - t(o).scrollTop() - p - M - 12 < 0 && i.indexOf("top") > -1 && (A = e), a.offset.top
                + a.dimension.height + p + 12 + M > t(o).scrollTop() + t(o).height() && i.indexOf("bottom") > -1 && (A
                    = e, O = a.offset.top - p - M - 12)
            }

            var n = this;
            if (0 !== t("body").find(n.$tooltip).length) {
                n.$tooltip.css("width", ""), n.elProxyPosition = n._repositionInfo(n.$elProxy);
                var s = null, r = t(o).width(), a = n.elProxyPosition, l = n.$tooltip.outerWidth(!1), p = (n.$tooltip.innerWidth()
                + 1, n.$tooltip.outerHeight(!1));
                if (n.$elProxy.is("area")) {
                    var f = n.$elProxy.attr("shape"), d = n.$elProxy.parent().attr("name"), c = t('img[usemap="#' + d
                    + '"]'), u = c.offset().left, h = c.offset().top, m = void 0 !== n.$elProxy.attr("coords")
                        ? n.$elProxy.attr("coords").split(",") : void 0;
                    if ("circle" == f) {
                        var v = parseInt(m[0]), g = parseInt(m[1]), $ = parseInt(m[2]);
                        a.dimension.height = 2 * $, a.dimension.width = 2 * $, a.offset.top = h + g - $, a.offset.left
                            = u + v - $
                    } else if ("rect" == f) {
                        var v = parseInt(m[0]), g = parseInt(m[1]), y = parseInt(m[2]), w = parseInt(m[3]);
                        a.dimension.height = w - g, a.dimension.width = y - v, a.offset.top = h + g, a.offset.left = u
                        + v
                    } else if ("poly" == f) {
                        for (var b = 0, x = 0, C = 0, k = 0, P = "even", T = 0; T < m.length; T++) {
                            var I = parseInt(m[T]);
                            "even" == P ? (I > C && (C = I, 0 === T && (b = C)), b > I && (b = I), P = "odd") : (I > k
                            && (k = I, 1 == T && (x = k)), x > I && (x = I), P = "even")
                        }
                        a.dimension.height = k - x, a.dimension.width = C - b, a.offset.top = h + x, a.offset.left = u
                        + b
                    } else {
                        a.dimension.height = c.outerHeight(!1), a.dimension.width = c.outerWidth(!1), a.offset.top
                            = h, a.offset.left = u
                    }
                }
                var S = 0, _ = 0, O = 0, M = parseInt(n.options.offsetY), F = parseInt(n.options.offsetX), A = n.options.position;
                if ("top" == A) {
                    var H = a.offset.left + l - (a.offset.left + a.dimension.width);
                    S = a.offset.left + F - H / 2, O = a.offset.top - p - M - 12, e(), i("bottom", "top")
                }
                if ("top-left" == A && (S = a.offset.left + F, O = a.offset.top - p - M - 12, e(), i("bottom-left",
                        "top-left")), "top-right" == A && (S = a.offset.left + a.dimension.width + F - l, O
                        = a.offset.top - p - M - 12, e(), i("bottom-right", "top-right")), "bottom" == A) {
                    var H = a.offset.left + l - (a.offset.left + a.dimension.width);
                    S = a.offset.left - H / 2 + F, O = a.offset.top + a.dimension.height + M + 12, e(), i("top",
                        "bottom")
                }
                if ("bottom-left" == A && (S = a.offset.left + F, O = a.offset.top + a.dimension.height + M
                    + 12, e(), i("top-left", "bottom-left")), "bottom-right" == A && (S = a.offset.left
                    + a.dimension.width + F - l, O = a.offset.top + a.dimension.height + M + 12, e(), i("top-right",
                        "bottom-right")), "left" == A) {
                    S = a.offset.left - F - l - 12, _ = a.offset.left + F + a.dimension.width + 12;
                    var N = a.offset.top + p - (a.offset.top + a.dimension.height);
                    if (O = a.offset.top - N / 2 - M, 0 > S && _ + l > r) {
                        var z = 2 * parseFloat(n.$tooltip.css("border-width")), j = l + S - z;
                        n.$tooltip.css("width", j + "px"), p = n.$tooltip.outerHeight(!1), S = a.offset.left - F - j
                        - 12 - z, N = a.offset.top + p - (a.offset.top + a.dimension.height), O = a.offset.top - N / 2
                        - M
                    } else {
                        0 > S && (S = a.offset.left + F + a.dimension.width + 12, s = "left")
                    }
                }
                if ("right" == A) {
                    S = a.offset.left + F + a.dimension.width + 12, _ = a.offset.left - F - l - 12;
                    var N = a.offset.top + p - (a.offset.top + a.dimension.height);
                    if (O = a.offset.top - N / 2 - M, S + l > r && 0 > _) {
                        var z = 2 * parseFloat(n.$tooltip.css("border-width")), j = r - S - z;
                        n.$tooltip.css("width", j + "px"), p = n.$tooltip.outerHeight(!1), N = a.offset.top + p
                        - (a.offset.top + a.dimension.height), O = a.offset.top - N / 2 - M
                    } else {
                        S + l > r && (S = a.offset.left - F - l - 12, s = "right")
                    }
                }
                if (n.options.arrow) {
                    var D = "tooltipster-arrow-" + A;
                    if (n.options.arrowColor.length < 1) {
                        var W = n.$tooltip.css("background-color");
                    } else {
                        var W = n.options.arrowColor;
                    }
                    if (s ? "left" == s ? (D = "tooltipster-arrow-right", s = "") : "right" == s ? (D
                            = "tooltipster-arrow-left", s = "") : s = "left:" + Math.round(s) + "px;" : s = "", "top"
                        == A || "top-left" == A || "top-right" == A) {
                        var q = parseFloat(n.$tooltip.css("border-bottom-width")), U = n.$tooltip.css("border-bottom-color");
                    } else if ("bottom" == A || "bottom-left" == A || "bottom-right" == A) {
                        var q = parseFloat(n.$tooltip.css("border-top-width")), U = n.$tooltip.css("border-top-color");
                    } else if ("left" == A) {
                        var q = parseFloat(n.$tooltip.css("border-right-width")), U = n.$tooltip.css("border-right-color");
                    } else if ("right" == A) {
                        var q = parseFloat(n.$tooltip.css("border-left-width")), U = n.$tooltip.css("border-left-color");
                    } else {
                        var q = parseFloat(n.$tooltip.css("border-bottom-width")), U = n.$tooltip.css("border-bottom-color");
                    }
                    q > 1 && q++;
                    var E = "";
                    if (0 !== q) {
                        var Q = "", R = "border-color: " + U + ";";
                        -1 !== D.indexOf("bottom") ? Q = "margin-top: -" + Math.round(q) + "px;" : -1
                        !== D.indexOf("top") ? Q = "margin-bottom: -" + Math.round(q) + "px;" : -1 !== D.indexOf("left")
                            ? Q = "margin-right: -" + Math.round(q) + "px;" : -1 !== D.indexOf("right") && (Q
                            = "margin-left: -" + Math.round(q) + "px;"), E
                            = '<span class="tooltipster-arrow-border" style="' + Q + " " + R + ';"></span>'
                    }
                    n.$tooltip.find(".tooltipster-arrow").remove();
                    var X = '<div class="' + D + ' tooltipster-arrow" style="' + s + '">' + E
                        + '<span style="border-color:' + W + ';"></span></div>';
                    n.$tooltip.append(X)
                }
                n.$tooltip.css({top: Math.round(O) + "px", left: Math.round(S) + "px"})
            }
            return n
        }, enable: function () {
            return this.enabled = !0, this
        }, disable: function () {
            return this.hide(), this.enabled = !1, this
        }, destroy: function () {
            var o = this;
            o.hide(), o.$el[0] !== o.$elProxy[0] && o.$elProxy.remove(), o.$el.removeData(o.namespace).off("."
            + o.namespace);
            var e = o.$el.data("tooltipster-ns");
            if (1 === e.length) {
                var i = null;
                "previous" === o.options.restoration ? i = o.$el.data("tooltipster-initialTitle") : "current"
                === o.options.restoration && (i = "string" == typeof o.Content ? o.Content
                    : t("<div></div>").append(o.Content).html()), i && o.$el.attr("title",
                    i), o.$el.removeClass("tooltipstered").removeData("tooltipster-ns").removeData("tooltipster-initialTitle")
            } else {
                e = t.grep(e, function (t) {
                    return t !== o.namespace
                }), o.$el.data("tooltipster-ns", e);
            }
            return o
        }, elementIcon: function () {
            return this.$el[0] !== this.$elProxy[0] ? this.$elProxy[0] : void 0
        }, elementTooltip: function () {
            return this.$tooltip ? this.$tooltip[0] : void 0
        }, option: function (t, o) {
            return "undefined" == typeof o ? this.options[t] : (this.options[t] = o, this)
        }, status: function () {
            return this.Status
        }
    }, t.fn[a] = function () {
        var o = arguments;
        if (0 === this.length) {
            if ("string" == typeof o[0]) {
                var e = !0;
                switch (o[0]) {
                    case"setDefaults":
                        t.extend(l, o[1]);
                        break;
                    default:
                        e = !1
                }
                return e ? !0 : this
            }
            return this
        }
        if ("string" == typeof o[0]) {
            var n = "#*$~&";
            return this.each(function () {
                var e = t(this).data("tooltipster-ns"), i = e ? t(this).data(e[0]) : null;
                if (!i) {
                    throw new Error("You called Tooltipster's \"" + o[0] + '" method on an uninitialized element');
                }
                if ("function" != typeof i[o[0]]) {
                    throw new Error('Unknown method .tooltipster("' + o[0] + '")');
                }
                var s = i[o[0]](o[1], o[2]);
                return s !== i ? (n = s, !1) : void 0
            }), "#*$~&" !== n ? n : this
        }
        var s = [], r = o[0] && "undefined" != typeof o[0].multiple, a = r && o[0].multiple || !r
            && l.multiple, p = o[0] && "undefined" != typeof o[0].debug, f = p && o[0].debug || !p && l.debug;
        return this.each(function () {
            var e = !1, n = t(this).data("tooltipster-ns"), r = null;
            n ? a ? e = !0 : f
            && console.log('Tooltipster: one or more tooltips are already attached to this element: ignoring. Use the "multiple" option to attach more tooltips.')
                : e = !0, e && (r = new i(this, o[0]), n || (n
                = []), n.push(r.namespace), t(this).data("tooltipster-ns", n), t(this).data(r.namespace, r)), s.push(r)
        }), a ? s : this
    };
    var p = !!("ontouchstart"in o), f = !1;
    t("body").one("mousemove", function () {
        f = !0
    })
}(jQuery, window, document);

/*!
 * jQuery Smart Banner
 * Copyright (c) 2012 Arnold Daniels <arnold@jasny.net>
 * Based on 'jQuery Smart Web App Banner' by Kurt Zenisek @ kzeni.com
 */
!function ($) {
    var SmartBanner = function (options) {
        this.origHtmlMargin = parseFloat($('html').css('margin-top')) // Get the original margin-top of the HTML element so we can take that into account
        this.options = $.extend({}, $.smartbanner.defaults, options)

        var standalone = navigator.standalone // Check if it's already a standalone web app or running within a webui view of an app (not mobile safari)
            , UA = navigator.userAgent

        // Detect banner type (iOS or Android)
        if (this.options.force) {
            this.type = this.options.force
        } else if (UA.match(/Windows Phone 8/i) != null && UA.match(/Touch/i) !== null) {
            this.type = 'windows'
        } else if (UA.match(/iPhone|iPod/i) != null || (UA.match(/iPad/) && this.options.iOSUniversalApp)) {
            if (UA.match(/Safari/i) != null &&
                (UA.match(/CriOS/i) != null ||
                window.Number(UA.substr(UA.indexOf('OS ') + 3, 3).replace('_', '.')) < 6)) this.type = 'ios' // Check webview and native smart banner support (iOS 6+)
        } else if (UA.match(/\bSilk\/(.*\bMobile Safari\b)?/) || UA.match(/\bKF\w/) || UA.match('Kindle Fire')) {
            this.type = 'kindle'
        } else if (UA.match(/Android/i) != null) {
            this.type = 'android'
        }

        // Don't show banner if device isn't iOS or Android, website is loaded in app or user dismissed banner
        if (!this.type || standalone || this.getCookie('sb-closed') || this.getCookie('sb-installed')) {
            return
        }

        // Calculate scale
        this.scale = this.options.scale == 'auto' ? $(window).width() / window.screen.width : this.options.scale
        if (this.scale < 1) this.scale = 1

        // Get info from meta data
        var meta = $(this.type == 'android' ? 'meta[name="google-play-app"]' :
            this.type == 'ios' ? 'meta[name="apple-itunes-app"]' :
                this.type == 'kindle' ? 'meta[name="kindle-fire-app"]' : 'meta[name="msApplication-ID"]');
        if (meta.length == 0) return

        // For Windows Store apps, get the PackageFamilyName for protocol launch
        if (this.type == 'windows') {
            this.appId = $('meta[name="msApplication-PackageFamilyName"]').attr('content');
        } else {
            // Try to pull the appId out of the meta tag and store the result
            var parsedMetaContent = /app-id=([^\s,]+)/.exec(meta.attr('content'));

            if(parsedMetaContent) {
                this.appId = parsedMetaContent[1];
            } else {
                return;
            }
        }

        this.title = this.options.title ? this.options.title : meta.data('title') || $('title').text().replace(/\s*[|\-·].*$/, '')
        this.author = this.options.author ? this.options.author : meta.data('author') || ($('meta[name="author"]').length ? $('meta[name="author"]').attr('content') : window.location.hostname)
        this.iconUrl = meta.data('icon-url');
        this.price = meta.data('price');

        // Set default onInstall callback if not set in options
        if (typeof this.options.onInstall === 'function') {
            this.options.onInstall = this.options.onInstall;
        } else {
            this.options.onInstall = function() {};
        }

        // Set default onClose callback if not set in options
        if (typeof this.options.onClose === 'function') {
            this.options.onClose = this.options.onClose;
        } else {
            this.options.onClose = function() {};
        }

        // Create banner
        this.create()
        this.show()
        this.listen()
    }

    SmartBanner.prototype = {

        constructor: SmartBanner

        , create: function() {
            var iconURL
                , link=(this.options.url ? this.options.url : (this.type == 'windows' ? 'ms-windows-store:navigate?appid=' : (this.type == 'android' ? 'market://details?id=' : (this.type == 'kindle' ? 'amzn://apps/android?asin=' : 'https://itunes.apple.com/' + this.options.appStoreLanguage + '/app/id'))) + this.appId)
                , price = this.price || this.options.price
                , inStore=price ? price + ' - ' + (this.type == 'android' ? this.options.inGooglePlay : this.type == 'kindle' ? this.options.inAmazonAppStore : this.type == 'ios' ? this.options.inAppStore : this.options.inWindowsStore) : ''
                , gloss=this.options.iconGloss === null ? (this.type=='ios') : this.options.iconGloss

            if (this.type == 'android' && this.options.GooglePlayParams) {
                link = link + '&referrer=' + this.options.GooglePlayParams;
            }

            if(this.type == "ios"){
            var split = window.location.pathname.split("/");
           if(split.length>=5){
            var team = split[4].split("-");

            var team_uid = parseInt(team[team.length-1]);
            if(isNaN(team_uid) === true && split.length>=7){
              var team = split[6].split("-");
              var team_uid = parseInt(team[team.length-1]);
            }
           }
            var team1_uid = parseInt($('#team1_uid').text());
            var team2_uid = parseInt($('#team2_uid').text());

            var sports_apps = [2672, 2673, 2527, 2530, 2536, 3050, 3061, 3052];

            var inArray1 = jQuery.inArray(team1_uid, sports_apps);
            var inArray2 = jQuery.inArray(team2_uid, sports_apps);
            if(inArray1 != -1 && inArray2 != -1){
                  team_uid = sports_apps[inArray1];
            }
            else if(inArray1 != -1){
                team_uid = sports_apps[inArray1];
            }
            else if(inArray2 != -1){
                team_uid = sports_apps[inArray2];
            }
            
            var language = "de";
            if(this.options.appStoreLanguage == "en"){
              language = "us";
            }
            
            if(team_uid === 2672){
              link = "https://itunes.apple.com/"+language+"/app/sport-news-fc-bayern-munchen/id1135020819?ls=1&mt=8";
              this.title ="FC Bayern München Edition App";
            }
            else if(team_uid === 2673){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-borussia-dortmund/id1152990636?mt=8";
              this.title ="Borussia Dortmund Edition App";
            }
            else if(team_uid === 2527){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-borussia-monchengladbach/id1154099897?mt=8";
              this.title ="Borussia Mönchengladbach Edition App";
            }
            else if(team_uid === 2530){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-fc-schalke-04/id1019232559?mt=8";
              this.title ="FC Schalke 04 App";
            }
            else if(team_uid === 2536){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-tsv-1860-munchen/id1156414077?mt=8";
              this.title ="TSV 1860 München Edition App";
            }
            else if(team_uid === 3050){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-besiktas-jk-edition/id1156503117?mt=8";
              this.title ="Beşiktaş JK edition App";
            }
            else if(team_uid === 3061){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-galatasaray-sk/id1156504066?mt=8";
              this.title ="Galatasaray SK edition App";
            }
            else if(team_uid === 3052){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-fenerbahce-sk/id1156501568?mt=8";
              this.title ="Fenerbahçe SK edition App";
            }
            else if(split[1]=='sportsnews'){
              link = "https://itunes.apple.com/"+language+"/app/sports-news-by-bet-it-best/id855089269?mt=8";
              this.title= "Sportsnews by Bet IT Best";
              }
            else{
              link = "https://itunes.apple.com/"+language+"/app/id916854354";
              this.title= "Livescores by Bet IT Best";
            }
          }


            var banner = '<div id="smartbanner" class="'+this.type+'"><div class="sb-container"><a href="#" class="sb-close">&times;</a><span class="sb-icon"></span><div class="sb-info"><strong>'+this.title+'</strong><span>'+this.author+'</span><span>'+inStore+'</span></div><a href="'+link+'" class="sb-button"><span>'+this.options.button+'</span></a></div></div>';
            (this.options.layer) ? $(this.options.appendToSelector).append(banner) : $(this.options.appendToSelector).prepend(banner);
            if(this.type == "ios"){
              if(team_uid === 2672){
                  iconURL = "/pool/uploads/apps-logos/bayern-munich-app-ios-logo.png";
              } else if(team_uid === 2673){
                  iconURL = "/pool/uploads/apps-logos/borrusia-dortmund-app-ios-logo.png";
              } else if(team_uid === 2527){
                  iconURL = "/pool/uploads/apps-logos/monchengladbach-app-ios-logo.png";
              } else if(team_uid === 2530){
                  iconURL = "/pool/uploads/apps-logos/shalke-app-ios-logo.png";
              } else if(team_uid === 2536){
                  iconURL = "/pool/uploads/apps-logos/1860-munich-app-ios-logo.png";
              } else if(team_uid === 3050){
                  iconURL = "/pool/uploads/apps-logos/besiktas-jk-app-ios-logo_converted.png";
              } else if(team_uid === 3061){
                  iconURL = "/pool/uploads/apps-logos/galatasaray-sk-app-ios-logo.png";
              } else if(team_uid === 3052){
                  iconURL = "/pool/uploads/apps-logos/fenerbahce-sk-app-ios-logo.png";
              }
              
          }
          if(!iconURL){
            if(this.options.icon) {
                iconURL = this.options.icon;
            } else if(this.iconUrl) {
                iconURL = this.iconUrl;
            } else if ($('link[rel="apple-touch-icon-precomposed"]').length > 0) {
                iconURL = $('link[rel="apple-touch-icon-precomposed"]').attr('href')
                if (this.options.iconGloss === null) gloss = false
            } else if ($('link[rel="apple-touch-icon"]').length > 0) {
                iconURL = $('link[rel="apple-touch-icon"]').attr('href')
            } else if ($('meta[name="msApplication-TileImage"]').length > 0) {
                iconURL = $('meta[name="msApplication-TileImage"]').attr('content')
            } else if ($('meta[name="msapplication-TileImage"]').length > 0) { /* redundant because ms docs show two case usages */
                iconURL = $('meta[name="msapplication-TileImage"]').attr('content')
            }
          }
            if (iconURL) {
                $('#smartbanner .sb-icon').css('background-image','url('+iconURL+')')
                if (gloss) $('#smartbanner .sb-icon').addClass('gloss')
            } else{
                $('#smartbanner').addClass('no-icon')
            }

            this.bannerHeight = $('#smartbanner').outerHeight() + 2

            if (this.scale > 1) {
                $('#smartbanner')
                    .css('top', parseFloat($('#smartbanner').css('top')) * this.scale)
                    .css('height', parseFloat($('#smartbanner').css('height')) * this.scale)
                    .hide()
                $('#smartbanner .sb-container')
                    .css('-webkit-transform', 'scale('+this.scale+')')
                    .css('-msie-transform', 'scale('+this.scale+')')
                    .css('-moz-transform', 'scale('+this.scale+')')
                    .css('width', $(window).width() / this.scale)
            }
            $('#smartbanner').css('position', (this.options.layer) ? 'absolute' : 'static');


        }

        , listen: function () {
            $('#smartbanner .sb-close').on('click',$.proxy(this.close, this))
            $('#smartbanner .sb-button').on('click',$.proxy(this.install, this))
        }

        , show: function(callback) {
            var banner = $('#smartbanner');
            banner.stop();

            if (this.options.layer) {
                banner.animate({top: 0, display: 'block'}, this.options.speedIn).addClass('shown').show();
                $(this.pushSelector).animate({paddingTop: this.origHtmlMargin + (this.bannerHeight * this.scale)}, this.options.speedIn, 'swing', callback);
            } else {
                if ($.support.transition) {
                    banner.animate({top:0},this.options.speedIn).addClass('shown');
                    var transitionCallback = function() {
                        $('html').removeClass('sb-animation');
                        if (callback) {
                            callback();
                        }
                    };
                    $(this.pushSelector).addClass('sb-animation').one($.support.transition.end, transitionCallback).emulateTransitionEnd(this.options.speedIn).css('margin-top', this.origHtmlMargin+(this.bannerHeight*this.scale));
                } else {
                    banner.slideDown(this.options.speedIn).addClass('shown');
                }
            }
        }

        , hide: function(callback) {
            var banner = $('#smartbanner');
            banner.stop();

            if (this.options.layer) {
                banner.animate({top: -1 * this.bannerHeight * this.scale, display: 'block'}, this.options.speedIn).removeClass('shown');
                $(this.pushSelector).animate({paddingTop: this.origHtmlMargin}, this.options.speedIn, 'swing', callback);
            } else {
                if ($.support.transition) {
                    if ( this.type !== 'android' )
                        banner.css('top', -1*this.bannerHeight*this.scale).removeClass('shown');
                    else
                        banner.css({display:'none'}).removeClass('shown');
                    var transitionCallback = function() {
                        $('html').removeClass('sb-animation');
                        if (callback) {
                            callback();
                        }
                    };
                    $(this.pushSelector).addClass('sb-animation').one($.support.transition.end, transitionCallback).emulateTransitionEnd(this.options.speedOut).css('margin-top', this.origHtmlMargin);
                } else {
                    banner.slideUp(this.options.speedOut).removeClass('shown');
                }
            }
        }

        , close: function(e) {
            e.preventDefault()
            this.hide()
            this.setCookie('sb-closed','true',this.options.daysHidden);
            this.options.onClose(e);
        }

        , install: function(e) {
            if (this.options.hideOnInstall) {
                this.hide()
            }
            this.setCookie('sb-installed','true',this.options.daysReminder)
            this.options.onInstall(e);
        }

        , setCookie: function(name, value, exdays) {
            var exdate = new Date()
            exdate.setDate(exdate.getDate()+exdays)
            value=encodeURI(value)+((exdays==null)?'':'; expires='+exdate.toUTCString())
            document.cookie=name+'='+value+'; path=/;'
        }

        , getCookie: function(name) {
            var i,x,y,ARRcookies = document.cookie.split(";")
            for(i=0;i<ARRcookies.length;i++) {
                x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="))
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1)
                x = x.replace(/^\s+|\s+$/g,"")
                if (x==name) {
                    return decodeURI(y)
                }
            }
            return null
        }

        // Demo only
        , switchType: function() {
            var that = this

            this.hide(function () {
                that.type = that.type == 'android' ? 'ios' : 'android'
                var meta = $(that.type == 'android' ? 'meta[name="google-play-app"]' : 'meta[name="apple-itunes-app"]').attr('content')
                that.appId = /app-id=([^\s,]+)/.exec(meta)[1]

                $('#smartbanner').detach()
                that.create()
                that.show()
            })
        }
    }

    $.smartbanner = function (option) {
        var $window = $(window)
            , data = $window.data('smartbanner')
            , options = typeof option == 'object' && option
        if (!data) $window.data('smartbanner', (data = new SmartBanner(options)))
        if (typeof option == 'string') data[option]()
    }

    // override these globally if you like (they are all optional)
    $.smartbanner.defaults = {
        title: null, // What the title of the app should be in the banner (defaults to <title>)
        author: null, // What the author of the app should be in the banner (defaults to <meta name="author"> or hostname)
        price: 'FREE', // Price of the app
        appStoreLanguage: 'us', // Language code for App Store
        inAppStore: 'On the App Store', // Text of price for iOS
        inGooglePlay: 'In Google Play', // Text of price for Android
        inAmazonAppStore: 'In the Amazon Appstore',
        inWindowsStore: 'In the Windows Store', //Text of price for Windows
        GooglePlayParams: null, // Aditional parameters for the market
        icon: null, // The URL of the icon (defaults to <meta name="apple-touch-icon">)
        iconGloss: null, // Force gloss effect for iOS even for precomposed
        button: 'VIEW', // Text for the install button
        url: null, // The URL for the button. Keep null if you want the button to link to the app store.
        scale: 'auto', // Scale based on viewport size (set to 1 to disable)
        speedIn: 300, // Show animation speed of the banner
        speedOut: 400, // Close animation speed of the banner
        daysHidden: 15, // Duration to hide the banner after being closed (0 = always show banner)
        daysReminder: 90, // Duration to hide the banner after "VIEW" is clicked *separate from when the close button is clicked* (0 = always show banner)
        force: null, // Choose 'ios', 'android' or 'windows'. Don't do a browser check, just always show this banner
        hideOnInstall: true, // Hide the banner after "VIEW" is clicked.
        layer: false, // Display as overlay layer or slide down the page
        iOSUniversalApp: true, // If the iOS App is a universal app for both iPad and iPhone, display Smart Banner to iPad users, too.
        appendToSelector: 'body', //Append the banner to a specific selector
        pushSelector: 'html' // What element is going to push the site content down; this is where the banner append animation will start.
    }

    $.smartbanner.Constructor = SmartBanner;


    // ============================================================
    // Bootstrap transition
    // Copyright 2011-2014 Twitter, Inc.
    // Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)

    function transitionEnd() {
        var el = document.createElement('smartbanner')

        var transEndEventNames = {
            WebkitTransition: 'webkitTransitionEnd',
            MozTransition: 'transitionend',
            OTransition: 'oTransitionEnd otransitionend',
            transition: 'transitionend'
        }

        for (var name in transEndEventNames) {
            if (el.style[name] !== undefined) {
                return {end: transEndEventNames[name]}
            }
        }

        return false // explicit for ie8 (  ._.)
    }

    if ($.support.transition !== undefined)
        return  // Prevent conflict with Twitter Bootstrap

    // http://blog.alexmaccaw.com/css-transitions
    $.fn.emulateTransitionEnd = function(duration) {
        var called = false, $el = this
        $(this).one($.support.transition.end, function() {
            called = true
        })
        var callback = function() {
            if (!called) $($el).trigger($.support.transition.end)
        }
        setTimeout(callback, duration)
        return this
    }

    $(function() {
        $.support.transition = transitionEnd()
    })
    // ============================================================

}(window.jQuery);