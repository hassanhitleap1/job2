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
});

