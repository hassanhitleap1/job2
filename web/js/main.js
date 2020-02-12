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
                html+= '<tr class="custom-message"  id="'+item.id+'">' +
                    '<th scope="col">#</th>'+
                    '<th scope="col">'+item.name+'</th>'+
                    '<th scope="col">'+item.area+'</th>'+
                    '<th scope="col">'+item.job_title+'</th>'+
                    '<th scope="col">'+item.desc_job+'</th>'+
                    '<th scope="col">'+item.phone+'</th>'+
                    '<th scope="col">'+item.created_at+'</th>';
                '</tr>';
           

                index=1;
            });
            $(".suggesstion-box").html(html);


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error')
        }
    });
});

$(document).on("change","#user-id",function(e){
    var user_id=$(this).val();
    var url="/index.php?r=user-info&id="+user_id;
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            console.log(data)
            $("#user-name").html(data.name);
            $("#phone-for").attr('phone',data.phone);
            $("#priorities").html(data.priorities);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error');
        }
    });
    
});


$(document).on("click",".custom-message",function(e){
    var id=$(this).attr('id');
    var message=$(".message").attr('message');
    1
    var url="/index.php?r=request-merchant/get-request&id="+id;
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            // $("#message-text").val='';
            document.getElementById("message-text").value ='';
            var message=$(".message").attr('message');
             message = message.replace("phone",data.marchent.phone);
             message = message.replace("job",data.requst_marchent.job_title);
             document.getElementById("message-text").value =message;
             //$("#message-text").val=message;

    


        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error');
        }
    });

});


$(document).on("click","#send-message",function(e){
    var url='';
    var phone=$("#phone-for").attr('phone');
    var message=$("#message-text").val();
    url= 'https://api.whatsapp.com/send?phone=962'+phone+'&text='+message
    window.open(url,'_blank');
});





