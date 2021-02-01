//Covid Change View
$(".daily-preview .top-statistics .tests label").text(function () {
    var text = $(this).text();
    $(this).text(text.replace("Confirmed", "New"));
});
$(".total-preview .top-statistics .tests label").text(function () {
    var text = $(this).text();
    $(this).text(text.replace("Confirmed", "Total"));
});
$(".daily-preview .top-statistics .deaths label").text(function () {
    var text = $(this).text();
    $(this).text(text.replace("Deaths", "New Deaths"));
});
$(".total-preview .top-statistics .deaths label").text(function () {
    var text = $(this).text();
    $(this).text(text.replace("Deaths", "Total Deaths"));
});
$(".daily-preview .top-statistics .active label").text(function () {
    var text = $(this).text();
    $(this).text(text.replace("Total Tests", "Active Cases"));
});
$('.daily-preview .new-cases span').each(function() {
    var text = $(this).text();
    $(this).text(text.replace('Last 24 hours:', ''));
});
$('.total-preview .top-statistics .deaths[title="Deaths"]').appendTo($('.total-preview .top-statistics .deaths[title="Deaths"]').parent());
//Percentage
var new_cases = $('.daily-preview .top-statistics .tests .new-cases .tests').text()
var int_new = parseInt(new_cases.replace(',',''))
var active_cases = $('.daily-preview .top-statistics .active .new-cases .active').text()
var int_active = parseInt(active_cases.replace(',',''))
var positive_percentage = ((int_new/int_active)*100).toFixed(2)
$('<li class="active" title="Active Cases"><div><div class="icon active-icon"></div><label title="Active Cases">Positive Rate</label></div><div class="new-cases"><span class="active">'+positive_percentage+'%</span></div></li>').insertAfter('.daily-preview li.deaths');
