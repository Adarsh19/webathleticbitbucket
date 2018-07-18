$(document).ready(function () {

    var currentStep = 0;
    showStep(currentStep);
});

function showStep(n) {
    $('.step-fomr li').removeClass('covered');
    var form_progress = $('.step-form li');
    form_progress[n].className += " covered";

    var form_steps = $('.step');
    $('.step').css({
        'display': 'none'
    });

    form_steps[n].style.display = "block";
}
