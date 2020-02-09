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


$(document).on("click",".msgwhatsapp",function(){
    $('.modal').modal('show')
        .find('#modelContent')
        .load($(this).attr('value'));
});





$( "#message-whatsapp" ).autocomplete({
    var  message="";
    var availableTags = [
        "ActionScript",
    ];

    var url="";
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            console.log(data)
        }
    });

    source: availableTags
    });
});
