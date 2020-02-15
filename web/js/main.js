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
            var diffTime='';
            data.forEach(function (item){
                 diffTime =diff_time(item.created_at);
                $("#created-at-user").html(diffTime +" days");
                html+= '<tr class="custom-message"  id="'+item.id+'">' +
                    '<th scope="col">#</th>'+
                    '<th scope="col">'+item.name+'</th>'+
                    '<th scope="col">'+item.area+'</th>'+
                    '<th scope="col">'+item.job_title+'</th>'+
                    '<th scope="col">'+item.desc_job+'</th>'+
                    '<th scope="col">'+item.phone+'</th>'+
                    '<th scope="col">'+diffTime +' dayes'+'</th>';
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

            $("#user-name").html(data.user.name);
            $("#phone-for").attr('phone',data.user.phone);
            $("#priorities").html(data.user.priorities);
            $("#priorities").html(data.user.priorities);
            $("#experience-user").html(data.user.experience);
            $("#phone-user").html(data.phone);
            $("#nationality-user").html('phone',data.nationality);
            $("#area-user").html(data.user.area);
           
            var gender="غير محدد";
            if (data.user.gender == 1) {
                gender ="ذكر";
            } else if (data.user.gender == 2) {
                gender= "انثى";
            }
            $("#gender-user").html(gender);

            $("#coun-send-sms-user").html(data.message_count);

            $("#agree-user").html(data.user.agree);

            var diffTime =diff_time(data.user.created_at);
            $("#created-at-user").html(diffTime +" days");
        
           
           
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
    $("#save-message").removeClass("hidden");
    var phone=$("#phone-for").attr('phone');
    var message=$("#message-text").val();
    url= 'https://api.whatsapp.com/send?phone=962'+phone+'&text='+message
    window.open(url,'_blank');
});


$(document).on("click","#save-message",function(e){
    $(this).addClass("hidden");
});




function diff_time(date){
    var dateNow= new Date();
    const date1 = new Date(dateNow);
    const date2 = new Date(date);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
    console.log(diffDays);
    return diffDays;
}