$(document).ready(function () {
        $.post('comboBandeNotReportG2', {}, function (data) {
                $("#bandejaReportG2").html(data);
        });
        $.post('comboBandeNotReportG1', function (data) {
                $("#bandejaReportG1").html(data);
        });
        $.post('comboBandeNotReportG', {}, function (data) {
                $("#bandejaReportG").html(data);
        });

});