$(document).ready(function () {
    $("#btn-print-cv").click(function (e) { 
        e.preventDefault();
        window.print();

    });    
    $("#sendjob-all").click( function(e){
        if( $(this).is(':checked') ){
            $('input:checkbox').prop('checked',true);   
        }else{
            $('input:checkbox').prop('checked', false);
        }
     });
    
     $("tr").click( function(e){
        if($(this).hasClass("success")){
            $(this).removeClass("success"); 
        }else{
            $(this).addClass("success");
           
        }
        
     });
});


$(document).on('click', '#print_cv', function () {
    printDiv();
    //chart_div();
});


function chart_div()
{

    var styelink='';
    var SITE_URL= window.location.origin+'';
    styelink='<link href="'+SITE_URL+'/assets/b518d80/css/bootstrap.css"  rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/assets/6768feb/css/bootstrap-rtl.css"  rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/font-awesome.min.css" rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/style.css"  rel="stylesheet">';
    styelink+='<style>.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>';
    var divToPrint=document.getElementById("cv_div");
    newWin= window.open("");
    newWin.document.write('<html><head>');
    newWin.document.write(styelink);
    newWin.document.write('</head><body>');
    newWin.document.write(divToPrint.outerHTML);
    newWin.document.write('</body></html>');
    newWin.print();
    // newWin.close();
}

function printDiv()
{
    var styelink='';
    var SITE_URL= window.location.origin+'';
    styelink='<link href="'+SITE_URL+'/assets/b518d80/css/bootstrap.css"  rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/assets/6768feb/css/bootstrap-rtl.css"  rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/font-awesome.min.css" rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/style.css"  rel="stylesheet">';
    styelink+='<style>.theiaStickySidebar:after {content: ""; display: table; clear: both;}</style>';
    // var a9= parseInt($(".swiper-pagination-total").html())+1;
    // var b9= $(window).height();
    // var b91= $(window).height();
    // $(".questions-main-container .content-container").height(a9*b9);
    // $(".result-page-container").height($(window).height());
    var divToPrint=document.getElementById('cv_div');
    //var divToPrint1=document.getElementById('print-result-a');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><head><link href="'+SITE_URL+'/assets/b518d80/css/bootstrap.css"  rel="stylesheet"><link href="'+SITE_URL+'/assets/6768feb/css/bootstrap-rtl.css"  rel="stylesheet"><link href="'+SITE_URL+'/resumex/css/font-awesome.min.css" rel="stylesheet"><link href="'+SITE_URL+'/resumex/css/style.css"  rel="stylesheet"></head><body onload="window.print()">'+ divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){
        newWin.close();
       // $(".questions-main-container").addClass("zoomOut").removeClass("animated zoomIn").fadeOut();
    },10);
}

