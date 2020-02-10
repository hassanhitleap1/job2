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




//////////////////////////////////////////////////////////// auto complete ////////////////////////////////////
var keywords=[];
// $(document).on("keypress","#message-text",function(e){
//
//     console.log(this.value);
//     url="/index.php?r=request-merchant/filter";
//     if(this.value != null && this.value != ''){
//         url+="&search="+this.value;
//     }
//     $.ajax({
//         url: url ,
//         type: 'GET',
//         dataType: 'JSON',
//         success: function (data) {
//             data.forEach(function (item){
//                 console.log(item);
//                 keywords.push(item.job_title+item.desc_job );
//             });
//
//
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             console.log('error')
//         }
//     });
// });


$(document).on("keyup","#search-box",function(e){
    var url="/index.php?r=request-merchant/filter";
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function(){
            $("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
                $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
    });
});

//To select country name
function selectCountry(val) {
    $("#search-box").val(val);
    $("#suggesstion-box").hide();
}


