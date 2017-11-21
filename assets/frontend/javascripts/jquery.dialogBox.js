/*!
 * dialogBox v0.0.2
 * by Liuyuchao
 * Copyright 2015.3
 * Date: Wed Mar 25 2015
  
 */

 ;(function($,window,document){

 	var pluginName = 'dialogBox',
 		defaults = {

 			width: null, //number,Pop-up layer width
 			height: null,  //number,Pop-up height
 			autoSize: true,  //boolean, are adaptive size, default adaptation
 			autoHide: false,  //boolean, are self disappear with time parameters share
 			time: 3000,  //number,Disappear time, in milliseconds
 			zIndex: 99999,  //number,Pop-up layer is positioned level
 			hasMask: false,  //boolean, Whether to display the mask layer
 			hasClose: false,  //boolean, Whether to display the Close button
 			hasBtn: false,  //boolean,Whether to display the operation buttons, such as canceled, OK
 			confirmValue: null,  //string,OK button text
 			confirm: function(){}, //function,Click OK when the callback function
 			cancelValue: null,  //string,Cancel button text
 			cancel: function(){},  //function,Click Cancel callback function is disabled by default pop-up box
 			effect: '', //string,Animation effects: fade (default),newspaper,fall,scaled,flip-horizontal,flip-vertical,sign,
 			type: 'normal', //string,Dialog type: normal (common dialogs),correct(Correct / operation was successful dialog box), error (error / warning dialog)
 			title: '',  //string,Title content, if not set, together with the close button (regardless of the setting display or not) does not display the title
 			content: '',  //string,DOM object,jQuery Object,Text content, which can be DOM object, jQuery object plain string, html tag string and URL address, when the content of the URL, the embedded iframe target page.
 			callback: function(){}   //function,Callback
			
 		};

 	function DialogBox(element,options){
 		this.element = element;
 		this.settings = $.extend({}, defaults, options);
 		this.init();		
 	}
	
 	DialogBox.prototype = {	

 		//初始化弹出框
 		init: function(){
 			var that = this,
 				element = this.element;
 				
 			that.render(element);
 			that.setStyle();
 			that.show();
 			that.trigger(element);
 		},

 		//获取元素id值
        getIdValue: function(element){
            var $this = $(element),
                selectID = $this.attr('id');
                
            if(typeof(selectID) !== 'undefined'){
                return selectID;
            }else{
                selectID='';
                return selectID;
            }
        },

 		//创建弹出框
 		create: function(element){
 			var that = this,
 				$this = $(element),
 				id = that.getIdValue(element),
 				title =  that.settings.title,
 				hasBtn = that.settings.hasBtn,
 				hasMask = that.settings.hasMask,
 				hasClose = that.settings.hasClose,
 				confirmValue = that.settings.confirmValue,
 				cancelValue = that.settings.cancelValue,
 				dialogHTML = [];

 			if(!title){
 				dialogHTML[0] = '<section id="' + id + '" class="dialog-box"><div class="dialog-box-container"><div class="dialog-box-content"></div>';			
 			}else{
 				if(!hasClose){
					dialogHTML[0] = '<section id="' + id + '" class="dialog-box"><div class="dialog-box-container"><div class="dialog-box-title"><h3>'+ title + '</h3></div><div class="dialog-box-content"></div>';
 				}else{					
 					dialogHTML[0] = '<section id="' + id + '" class="dialog-box"><div class="dialog-box-container"><div class="dialog-box-title"><h3>'+ title + '</h3><span class="dialog-box-close">×</span></div><div class="dialog-box-content"></div>';
 				}
 			}

 			if(!hasBtn){
 				dialogHTML[1] = '</div></section>';
 			}else{
 				if(confirmValue && cancelValue){
 					dialogHTML[1] = '<div class="dialog-btn"><span class="dialog-btn-cancel">' + cancelValue + '</span><span class="dialog-btn-confirm">' + confirmValue + '</span></div></div></section>';
 				}else if(cancelValue){
 					dialogHTML[1] = '<div class="dialog-btn"><span class="dialog-btn-cancel">' + cancelValue + '</span></div></div></section>';
 				}else if(confirmValue){
 					dialogHTML[1] = '<div class="dialog-btn"><span class="dialog-btn-confirm">' + confirmValue + '</span></div></div></section>';
 				}else{
 					dialogHTML[1] = '<div class="dialog-btn"><span class="dialog-btn-cancel">取消</span><span class="dialog-btn-confirm">确定</span></div></div></section>';
 				}
 			}

 			if(!hasMask){
 				dialogHTML[2] = '';
 			}else{
 				dialogHTML[2] = '<div id="dialog-box-mask"></div>';
 			}

 			return dialogHTML;	
 		},

 		//渲染弹出框
 		render: function(element){
 			var that = this,
 				$this = $(element),
 				dialogHTML = that.create($this),
 				$content = that.parseContent();
 				
 			$this.replaceWith(dialogHTML[0] + dialogHTML[1]);

 			if(typeof($content) === 'object'){
 				$content.appendTo('.dialog-box-content');
 			}else{
 				$('.dialog-box-content').append($content);
 			}

 			$('body').append(dialogHTML[2]);
 		},

 		//解析并处理弹出框内容
 		parseContent: function(){
 			var that = this,
 				content = that.settings.content,
 				width = that.settings.width,
 				height = that.settings.height,
 				type = that.settings.type,
 				$iframe = $('<iframe>'),
 				random = '?tmp=' + Math.random(),
 				urlReg = /^(https?:\/\/|\/|\.\/|\.\.\/)/;

 			//是外部页面时
 			if(urlReg.test(content)){

 				$iframe.attr({
 					src: content + random,
 					marginheight: '0',
 					marginwidth: '0',
 					frameborder: 'no',
 					scrolling: 'no',
 					name: 'dialog-box-iframe',
 					id: 'dialog-box-iframe'
 				})
 				.on('load',function(){

 					//动态自适应iframe高度;
 					var $iframe = $(window.frames['dialog-box-iframe'].document),
 						$iframeBody = $(window.frames['dialog-box-iframe'].document.body),
 						iframeWidth = $iframe.outerWidth() - 8,
 						iframeHeight = $iframe.outerHeight() - 16,
 						$dialogBox = $('.dialog-box'),
 						$content = $('.dialog-box-content'),
 						$container = $('.dialog-box-container');

 						dialogBoxWidth = iframeWidth + 40;
 						dialogBoxHeight = iframeHeight + 130;
 						
 					if(that.settings.autoSize){	
 						$(this).width(iframeWidth);
 						$(this).height(iframeHeight);

 						$iframeBody.css({
 							margin: '0',
 							padding: '0'
 						});

 						$content.css({
 							width: iframeWidth + 'px',
 							height: iframeHeight + 'px'
 						});

 						$container.css({
 							width: dialogBoxWidth + 'px',
 							height: function(){
 								if(that.settings.hasBtn){
 									return dialogBoxHeight + 'px';
 								}else{
 									return dialogBoxHeight - 54 + 'px';
 								}
 							}
 						});

 						$dialogBox.css({
 							width: dialogBoxWidth,
 							height: function(){
 								if(that.settings.hasBtn){
									if(type === '' || type === 'normal'){
	 									return dialogBoxHeight + 'px';
	 								}else if(type === 'error' || type === 'correct'){
	 									dialogBoxHeight = dialogBoxHeight + 4;
	 									return dialogBoxHeight + 'px';
	 								}
 								}else{
 									return dialogBoxHeight - 50 + 'px';
 								}
 							},
 							'margin-top': function(){
 								if(that.settings.hasBtn){
									if(type === '' || type === 'normal'){
	 									return -Math.round(dialogBoxHeight/2) + 'px';
	 								}else if(type === 'error' || type === 'correct'){
	 									dialogBoxHeight = dialogBoxHeight;
	 									return -Math.round(dialogBoxHeight/2) + 'px';
	 								}	
 								}else{
 									return -Math.round((dialogBoxHeight - 50)/2) + 'px';
 								}		
 							},
 							'margin-left': -Math.round(dialogBoxWidth/2) + 'px'
 						});

 					}else{
 						$(this).width(that.settings.width - 40);
 						$(this).height(that.settings.height - 130);
 					}
 				});
				return $iframe;

			//是jQuery对象时
 			}else if(content instanceof jQuery){
 				return content.clone(true,true);
 			//是DOM对象时
 			}else if(content.nodeType === 1 && content.nodeName === 'string'){				
 				return content.innerHTML;
 			}else{
 				return content;
 			}
 		},

 		//显示弹出框
 		show: function(){
 			$('.dialog-box').css({display:'block'});

 			setTimeout(function(){
 				$('.dialog-box').addClass('show');
 			},50)

 			$('#dialog-box-mask').show();
 		},

 		//隐藏弹出框
 		hide: function(element){
 			var $this = $(element),
 				$dialogBox = $('.dialog-box'),
 				$iframe = $('#dialogBox-box-iframe');

 			$dialogBox.removeClass('show');

 			setTimeout(function(){
 				if($iframe){
 					$iframe.attr('src','_blank');
 				}

 				$dialogBox.replaceWith('<div id="' + $this.attr('id') + '"></div/>');
 				$('#dialog-box-mask').remove();
 			},150)
 		},

 		//设置弹出框样式
 		setStyle: function(){
 			var that = this,
 				$dialog = $('.dialog-box'),
 				$container = $('.dialog-box-container'),
 				$content = $('.dialog-box-content'),
 				$mask  = $('#dialog-box-mask'),
 				type = that.settings.type,
 				EFFECT = 'effect';

 			//弹出框外框样式
 			$dialog.css({
 				width: function(){
 					if(that.settings.width){
 						return that.settings.width + 'px';
 					}else{
 						if(that.settings.autoSize){
 							return $(this).width();
 						}
 					}
 				},
 				height: function(){
 					if(that.settings.height){
 						if(type === '' || type === 'normal'){
 							return that.settings.height + 'px';
 						}else if(type === 'error' || type === 'correct'){
 							return that.settings.height + 4 + 'px';
 						}
 					}else{
 						if(that.settings.autoSize){
 							return $(this).height();
 						}
 					}
 				},
 				'margin-top': function(){
 					var height;

					if(type === '' || type === 'normal'){
						if(that.settings.autoSize){
							height = $(this).height();
						}else{
							height = that.settings.height;
						}
					}else if(type === 'error' || type === 'correct'){
						if(that.settings.autoSize){
							height = $(this).height();
						}else{
							height = that.settings.height + 4;
						}
					}
					return -Math.round(height/2) + 'px';
 				},
 				'margin-left': function(){
 					var width = $(this).width();
                                        if ($(window).width() - $("#favbar").width() > 100)
                                        {
                                            return -Math.round((width + ($("#favbar").width() - $("nav#sidebar").width()))/2) + 'px';
                                        }
                                        else
                                        {
                                            return -Math.round(width/2) + "px";
                                        }
 				},
 				'z-index': that.settings.zIndex
 			});

 			//弹出框内层容器样式
 			$container.css({
 				width: function(){
 					if(that.settings.width){
						return that.settings.width + 'px';
 					}else{
 						return;
 					}
 				},
 				height: function(){
 					if(that.settings.height){
 						return that.settings.height + 'px';
 					}else{
 						return;
 					}
 				}
 			});

 			//弹出框内容样式
 			$content.css({
 				width: function(){
 					if(that.settings.width){
 						return that.settings.width - 40 + 'px';
 					}else{
 						return;
 					}
 				},
 				height: function(){
 					if(that.settings.height){
 						return that.settings.height - 130 + 'px';
 					}else{
 						return;
 					}
 				}
 			});

 			//遮罩层样式
 			$mask.css({
 				height: $(document).height() + 'px'
 			});
 		

 			//判断弹出框类型
 			switch(that.settings.type){
 				case 'correct':
 					$container.addClass('correct');
 					break;
 				case 'error':
 					$container.addClass('error');
 					break;
 				default:
 					$container.addClass('normal');;
 					break;
 			}

 			//弹出框多种动画效果
 			switch(that.settings.effect){
 				case 'newspaper':
 					$dialog.addClass(EFFECT + '-newspaper');
 					break;
 				case 'fall':
 					$dialog.addClass(EFFECT + '-fall');
 					break;
 				case 'scaled':
 					$dialog.addClass(EFFECT + '-scaled');
 					break;
 				case 'flip-horizontal':
 					$dialog.addClass(EFFECT + '-flip-horizontal');
 					break;
 				case 'flip-vertical':
 					$dialog.addClass(EFFECT + '-flip-vertical');
 					break;
 				case 'sign':
 					$dialog.addClass(EFFECT + '-sign');
 					break;
 				default:
 					$dialog.addClass(EFFECT + '-fade');
 					break;
 			}

 		},

 		//弹出框触屏器(系列事件)
 		trigger: function(element,event){
 			var that = this,
 				$this = $(element);
 			
 			if($.isFunction(that.settings.callback)){
 				that.settings.callback();
 			}

 			$('.dialog-box-close,#dialog-box-mask,.dialog-btn-cancel,.dialog-btn-confirm').on('click',function(event){
 				that.hide($this);
 				event.stopPropagation();
 			});

 			$(document).keyup(function(event){
 				if(event.keyCode === 27){
 					that.hide($this);
 				}
 			});

 			if(that.settings.autoHide){
 				setTimeout(function(){
 					that.hide($this);
 				},that.settings.time)
 			}

 			if($.isFunction(that.settings.confirm)){
 				$('.dialog-btn-confirm').on('click',function(){
 					that.settings.confirm();
 				})
 			}

 			if($.isFunction(that.settings.cancel)){
 				$('.dialog-btn-cancel').on('click',function(){
 					that.settings.cancel();
 				})
 			}

 		}

 	};

 	$.fn[pluginName] = function(options) {
        this.each(function() {
            if (!$.data(this, "plugin_" + pluginName)) {
                $.data(this, "plugin_" + pluginName, new DialogBox(this, options));			
			}
        });
		return this;
    };
	
 })(jQuery,window,document)