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
    chart_div();
});


function chart_div()
{

    var styelink='';
    var SITE_URL= window.location.origin+'/web';
    styelink='<link href="'+SITE_URL+'/assets/b518d80/css/bootstrap.css" media="print" rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/assets/6768feb/css/bootstrap-rtl.css" media="print" rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/font-awesome.min.css" media="print" rel="stylesheet">';
    styelink+='<link href="'+SITE_URL+'/resumex/css/style.css"  media="print" rel="stylesheet">';
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

