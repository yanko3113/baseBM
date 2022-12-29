window.addEventListener('load', function() {
	$(window).scroll(testScroll);
});

var viewed = false;


function isScrollIntoView(elem) {
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

function testScroll() {
    // Cuando llegue al fondo color celeste debe iniciar el contador
    if (isScrollIntoView($(".bg-celeste")) && (!viewed)) {
        viewed = true;
        $('.counter').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-count');
            $({ countNum: $this.text() }).animate({
                countNum: countTo
            }, {
                duration: 8000,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        });
    }
}

// EFECTOS PARA SERVICIOS
$(window).scroll(function() {
    if ($(window).scrollTop() > 1400) {
        $("#servicioBmPeople").addClass("pulso");
        $("#servicioBmOutsourcing").addClass("pulso");
        $("#servicioBmTrade").addClass("pulso");
    } else {
        $("#servicioBmPeople").removeClass("pulso");
        $("#servicioBmOutsourcing").removeClass("pulso");
        $("#servicioBmTrade").removeClass("pulso");
    }
    if ($(window).scrollTop() > 1700) {
        $("#servicioBtl").addClass("pulso");
        $("#servicioBmImplant").addClass("pulso");
        $("#servicioBmPayroll").addClass("pulso");
    } else {
        $("#servicioBtl").removeClass("pulso");
        $("#servicioBmImplant").removeClass("pulso");
        $("#servicioBmPayroll").removeClass("pulso");
    }
    if ($(window).scrollTop() > 2500) {
        $("#servicioBmAcademy").addClass("pulso");
    } else {
        $("#servicioBmAcademy").removeClass("pulso");
    }
})
