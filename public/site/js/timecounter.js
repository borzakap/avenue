$(document).ready(function () {
    var $date_to = $('.counter').data('dateto');

    setInterval(function () {
        var date_now = new Date();
        var delta = Math.abs($date_to - (date_now  / 1000));
        console.log($date_to);
        // days
        var days = Math.floor(delta / 86400);
        delta -= days * 86400;
        $("#days").html((days < 10 ? "0" : "") + days);
        // hours
        var hours = Math.floor(delta / 3600) % 24;
        delta -= hours * 3600;
        $("#hours").html((hours < 10 ? "0" : "") + hours);
        // minutes
        var minutes = Math.floor(delta / 60) % 60;
        delta -= minutes * 60;
        $("#minutes").html((minutes < 10 ? "0" : "") + minutes);
        // seconds
        var seconds = Math.floor(delta) % 60;
        $("#seconds").html((seconds < 10 ? "0" : "") + seconds);
    }, 1000);
});
    