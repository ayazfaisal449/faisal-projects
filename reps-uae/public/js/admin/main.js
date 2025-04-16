$(document).ready(function () {
	$('nav ul li a.drop').unbind('click');
	//navigation dropdown
	$('nav ul li a.drop').click(function (e) {
		e.preventDefault();

		if($(this).next().is(':hidden')) {
			$(this).next().slideDown();
		} else {
			$(this).next().slideUp();
		}
	});
	
});