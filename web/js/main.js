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
$(document).on("keypress","#message-text",function(e){
    console.log(this.value);
    url="/index.php?r=request-merchant/filter";
    if(this.value != null && this.value != ''){
        url+="&search="+this.value;
    }
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            var html="";
            var index=1;
            $(".suggesstion-box").html(html);
            data.forEach(function (item){
                html+='<li  class="list-group-item" id="'+item.id+'">'+item.job_title + '  - ' +item.desc_job  +' </li>';
                keywords.push(item.job_title+item.desc_job ) ;
                index=1;
            });
            $(".suggesstion-box").html(html);


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error')
        }
    });
});

$(document).on("change","#messagejobuser-user_id",function(e){
    var user_id=$(this).val();

    var url="/index.php?r=user%2Fget-user&id=".user_id;

    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            $("#user-name").html(data.name);
            $("#priorities").html(data.priorities);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error')
        }
    });
    
});




