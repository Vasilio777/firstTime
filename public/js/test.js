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

	$('#add_video > button:submit').on('click', function (event) {
		event.preventDefault();
		videofile.click();
	});

	$('#add_method > button:submit').on('click', function (event) {
		event.preventDefault();
		userfile.click();
	});

	$('#add_logo > button:submit').on('click', function (event) {
		console.log(123);
		event.preventDefault();
		logofile.click();
	});

	$(videofile).add(userfile).change(function () {
		var self = $(this),
			filename = self.val();

		if (filename !== undefined) {
			self.parent().submit();
		}
	});
													// ----------- Асинхронное добавление логотипа в новый курс
	$(logofile).change(function () {
		var self=$(this),
			filename = self.val();
		if (filename !== undefined && filename !== '') {
			$.ajax({
				url: '/courses/addLogo',
				type: "POST",
				data: {filename:filename},
				headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
				success: function($list){
					self.parent().parent().before($list);
				},
				error: function(msg){
					console.log(msg);
				}
			});
		}
		console.log(filename);
	});

													// ----------- Слайдинг описания лекции
	$('.buttonLecChange').on('click', function() {
		$(this).toggleClass('buttonChange');
		$('.changeLecForm').slideToggle(400).css({display: "flex"});
	});

													// ------------ Слайдинг описания видео
	$('.buttonchange').on('click', function() {

		$(this).toggleClass('buttonChange');
		$(this).next($('.changeForm')).slideToggle(400).css({display: "block"});
	});
});

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