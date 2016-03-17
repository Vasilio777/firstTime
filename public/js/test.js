$(function() {


															// Аккордеон выбранной лекции (листинг видео/методы/допы)
	var Accordion = function (el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.link');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	};

	Accordion.prototype.dropdown = function (e) {
		var $el = e.data.el;
		var $this = $(this),
			$next = $this.next();

		$next.slideToggle(1200);
		$this.parent().toggleClass('open');

		if (!e.data.multiple) {
			$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
		}
	};

	var accordion = new Accordion($('.accordion'), false);

														// Кнопки Добавить видео/методические указания
	var videofile = $('input[name="videofile"]'),
		userfile = $('input[name="userfile"]'),
		logofile = $('input[name="logofile"]');

	videofile.hide();
	userfile.hide();
	logofile.hide();


	$('.add_method > button:submit').on('click', function (event) {
		event.preventDefault();
		self = $(this);
		self.prev().click();
	});

	$(videofile).add(userfile).change(function () {
		var self = $(this),
			filename = self.val();

		if (filename !== undefined) {
			self.parent().submit();
		}
	});

	$('#add_video > button:submit').on('click', function (event) {
		event.preventDefault();
		videofile.click();
	});

													// ----------- Асинхронное добавление логотипа в новый курс

	$(logofile).change(function () {

		var fd = new FormData(),
			self = $(this);

		fd.append("logofile", this.files[0]);
		if (self.val() !== undefined && self.val() !== '') {
			$.ajax({
				url: '/courses/addLogo',
				type: "POST",
				headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
				data: fd,
				processData: false,
				contentType: false,
				success: function ($list) {
					self.parent().parent().find('.onliOneCourse').before($list);
				},
				error: function (msg) {
					console.log(msg);
				}
			});
		}
	});

	$('#add_logo > button:submit').on('click', function (event) {
		event.preventDefault();
		logofile.click();
	});

													// ----------- Слайдинг добавления лекции

	$('.buttonLecChange').on('click', function() {

		$(this).toggleClass('buttonChange');
		$('.changeLecForm').slideToggle(400).css({display: "block"});
		if ($(this).hasClass('buttonChange')) {
			$('body').animate({scrollTop: $(document).height()}, 1000);
			var input = $('#add_video').find('input[type=text]');
			//setTimeout(function() { input.focus(); }, 1200);
			input.focus();
		}
	});

													// ------------ Слайдинг описания видео
	$('.buttonchange').on('click', function() {

		var self = $(this),
			changeForm = $('.changeForm'),
			input = self.next(changeForm).find('textarea');

		self.toggleClass('buttonChange');
		self.next(changeForm).slideToggle(400).css({display: "block"});
		if (self.hasClass('buttonChange')) { input.focus(); }
	});
});

//(function (window) {
//
//// This library re-implements setTimeout, setInterval, clearTimeout, clearInterval for iOS6.
//// iOS6 suffers from a bug that kills timers that are created while a page is scrolling.
//// This library fixes that problem by recreating timers after scrolling finishes (with interval correction).
//// This code is released in the public domain. Do with it what you want, without limitations. I do not promise
//// that it works, or that I will provide support (don't sue me).
//// Author: rkorving@wizcorp.jp
//
//	var timeouts = {};
//	var intervals = {};
//	var orgSetTimeout = window.setTimeout;
//	var orgSetInterval = window.setInterval;
//	var orgClearTimeout = window.clearTimeout;
//	var orgClearInterval = window.clearInterval;
//
//
//	function createTimer(set, map, args) {
//		var id, cb = args[0], repeat = (set === orgSetInterval);
//
//		function callback() {
//			if (cb) {
//				cb.apply(window, arguments);
//
//				if (!repeat) {
//					delete map[id];
//					cb = null;
//				}
//			}
//		}
//
//		args[0] = callback;
//
//		id = set.apply(window, args);
//
//		map[id] = { args: args, created: Date.now(), cb: cb, id: id };
//
//		return id;
//	}
//
//
//	function resetTimer(set, clear, map, virtualId, correctInterval) {
//		var timer = map[virtualId];
//
//		if (!timer) {
//			return;
//		}
//
//		var repeat = (set === orgSetInterval);
//
//// cleanup
//
//		clear(timer.id);
//
//// reduce the interval (arg 1 in the args array)
//
//		if (!repeat) {
//			var interval = timer.args[1];
//
//			var reduction = Date.now() - timer.created;
//			if (reduction < 0) {
//				reduction = 0;
//			}
//
//			interval -= reduction;
//			if (interval < 0) {
//				interval = 0;
//			}
//
//			timer.args[1] = interval;
//		}
//
//// recreate
//
//		function callback() {
//			if (timer.cb) {
//				timer.cb.apply(window, arguments);
//				if (!repeat) {
//					delete map[virtualId];
//					timer.cb = null;
//				}
//			}
//		}
//
//		timer.args[0] = callback;
//		timer.created = Date.now();
//		timer.id = set.apply(window, timer.args);
//	}
//
//
//	window.setTimeout = function () {
//		return createTimer(orgSetTimeout, timeouts, arguments);
//	};
//
//
//	window.setInterval = function () {
//		return createTimer(orgSetInterval, intervals, arguments);
//	};
//
//	window.clearTimeout = function (id) {
//		var timer = timeouts[id];
//
//		if (timer) {
//			delete timeouts[id];
//			orgClearTimeout(timer.id);
//		}
//	};
//
//	window.clearInterval = function (id) {
//		var timer = intervals[id];
//
//		if (timer) {
//			delete intervals[id];
//			orgClearInterval(timer.id);
//		}
//	};
//
//	window.addEventListener('scroll', function () {
//// recreate the timers using adjusted intervals
//// we cannot know how long the scroll-freeze lasted, so we cannot take that into account
//
//		var virtualId;
//
//		for (virtualId in timeouts) {
//			resetTimer(orgSetTimeout, orgClearTimeout, timeouts, virtualId);
//		}
//
//		for (virtualId in intervals) {
//			resetTimer(orgSetInterval, orgClearInterval, intervals, virtualId);
//		}
//	});
//
//}(window));

// ------------ Блокировка перехода по ссылке на курсы		.filter('.plate:not(:eq(0))')
//$('.plate:not(:eq(0))').filter('.plate:not(:last)').on('click', function (event) {
//	event.preventDefault();
//});

//$("select").change(function () {
//	if ($("#selectar").val() == "Prepod") {
//
//		$("#twoForm").css({display: "none"});
//		$("#oneForm").slideDown(400).css({display: "block"});
//		;
//	}
//	else if ($("#selectar").val() == "Student") {
//		$("#oneForm").css({display: "none"});
//		$("#twoForm").slideDown(400).css({display: "block"});
//	}
//	else {
//		$("#oneForm").slideUp(400);
//		$("#twoForm").slideUp(400);
//	}
//})