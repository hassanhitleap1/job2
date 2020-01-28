jQuery(function($){'use strict';(function(){$('#preloader').delay(200).fadeOut('slow');}());$('.left-col-block, .right-col-block').theiaStickySidebar();});

function chart_div()
{
    var divToPrint=document.getElementById("cv_div");
    newWin= window.open("");
    newWin.document.write('<html><head>');
    newWin.document.write('</head><body>');
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write('</body></html>');
    newWin.print();
    newWin.close();
}
$(document).on('click', '#print_cv', function () {
    chart_div();
});
