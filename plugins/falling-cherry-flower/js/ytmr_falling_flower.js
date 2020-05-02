function GmEffect(args){this.init(args);}GmEffect.prototype = {init: function(args){this.is_focus_on = true;this.window_width = window.innerWidth,this.window_height = window.innerHeight;this.canvas_id = args.id;this.resizeWindow();this.falling_speed = args.falling_speed;var timer_id = false;jQuery(window).on('resize', function(){if(timer_id !== false){clearTimeout(timer_id); }timer_id = setTimeout(function(){ this.window_width = window.innerWidth;this.window_height = window.innerHeight;this.resizeWindow();}.bind(this), 1000);}.bind(this));this.ary_confetti = [];this.imgpath = args.img_path;this.n_confetti_max = args.n_confetti_max;this.new_confetti_time = args.new_confetti_time;this.new_confetti_num = args.new_confetti_num;window.addEventListener('blur', function(){this.is_focus_on = false;}.bind(this));window.addEventListener('focus', function(){this.is_focus_on = true;}.bind(this));setInterval(function(){if (this.is_focus_on) {if (this.n_confetti <= this.n_confetti_max) {this.createNewConfetti(this.new_confetti_num);}}}.bind(this), this.new_confetti_time);this.stage = new createjs.Stage(args.id);createjs.Ticker.setFPS(50);createjs.Ticker.addEventListener('tick', function(){if (this.is_focus_on) {this.moveConfetti();this.stage.update();}}.bind(this));},resizeWindow: function(){jQuery('#'+this.canvas_id).attr('width', this.window_width);jQuery('#'+this.canvas_id).attr('height', this.window_height);},random: function(min, max){if(max){return Math.floor(Math.random() * (max - min)) + min;} else {return Math.floor(Math.random() * min);}},createNewConfetti: function(len){for(var i=0; i < len; i++){var img_index = this.random(10);var img_path = this.imgpath + img_index + '.png';var cftti = new createjs.Bitmap(img_path);cftti.x = this.random(this.window_width);cftti.y = this.random(30, 60) * (-1);cftti.speedY = ((this.random(3, 13) + this.falling_speed) / 10);cftti.speedXangle = (this.random(2) / 100);cftti.rotateDir = this.random(2); cftti.moveXangle = 0;cftti.rotateX = (this.random(5,15) / 100);cftti.moveXrand = (this.random(2,14) / 10);cftti.rotate_angle = this.random(1, 3) * (this.random(2) == 0)? -1 : 1;cftti.scaleBase = 0.8;cftti.scaleX = cftti.scaleBase;cftti.scaleY = cftti.scaleBase;this.stage.addChild(cftti);this.ary_confetti.push(cftti);}},moveConfetti: function(){this.n_confetti = this.ary_confetti.length;for(var i=0; i < this.n_confetti; i++) {var obj = this.ary_confetti[i];if(obj){obj.y += obj.speedY;if(obj.y > this.window_height + 30){this.stage.removeChild(obj);this.ary_confetti.splice(i, 1);}if(obj.rotateDir == 0){obj.x += Math.cos(obj.moveXangle) * obj.moveXrand;obj.moveXangle += obj.speedXangle;}else{obj.x -= Math.cos(obj.moveXangle) * obj.moveXrand;obj.moveXangle += obj.speedXangle;}obj.rotation += obj.rotate_angle;obj.scaleX += obj.rotateX;if(obj.scaleX > obj.scaleBase){obj.rotateX *= -1;}else if(obj.scaleX < - obj.scaleBase){obj.rotateX *= -1;}}}}};
