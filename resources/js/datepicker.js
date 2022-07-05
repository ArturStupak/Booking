import $ from 'jquery';
window.$ = window.jQuery = $;
import 'jquery-ui/ui/widgets/datepicker.js';

var dates = [];
$(function () {
    var arrival = $('#rezervdate').val();
    dates = JSON.parse(arrival) ;
    $("#datepicker").datepicker({
       minDate: 0,
        beforeShowDay: disableDates
    });
    $("#arrival").datepicker({
        minDate: 0,
        beforeShowDay: disableDates
    });
    $("#departure").datepicker({
        minDate: 0,
        beforeShowDay: disableDates
    });


});
function disableDates(date) {
    console.log(dates);
    var string = $.datepicker.formatDate('yy-mm-dd', date);
    return [dates.indexOf(string) === -1];
}

$(document).ready(function() {

    var arrival;
    var departure;

    $( "#arrival" ).datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0
    })


    $( "#departure" ).datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: 0
    });

    $('#arrival').change(function() {
        arrival = $(this).datepicker('getDate');
        $("#departure").datepicker("option", "minDate", arrival );
    })


    $('#departure').change(function() {
        departure = $(this).datepicker('getDate');
        $("#arrival").datepicker("option", "maxDate", departure );
    })

})







