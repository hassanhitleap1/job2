let SiteUrl = getSiteUrl() ;
 


function getSiteUrl() {
    let site_url=window.location.host;
    if (site_url=='localhost:8080'){
        return '';
    }
    return site_url+'/web';
}
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

$(document).on("click", ".action_user", function () {
    $('.modal').modal('show')
        .find('#modelContent')
        .load($(this).attr('value'));
});
$(document).on("click", ".view_vedio", function () {
    $('.modal').modal('show')
        .find('#modelContent')
        .load($(this).attr('value'));
});

$(document).on("click",".suggested-jobs",function(){
    $('.modal').modal('show')
        .find('#modelContent')
        .load($(this).attr('value'));
});



//////////////////////////////////////////////////////////// auto complete ////////////////////////////////////


$(document).on("keyup","#message-text",function(e){
  
    url=SiteUrl+"/index.php?r=request-merchant/filter";
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
    var url = SiteUrl +"/index.php?r=user-info&id="+user_id;
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
            $("#phone-user").html(data.user.phone);
            $("#nationality-user").html(data.nationality);
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

    var url = SiteUrl +"/index.php?r=request-merchant/get-request&id="+id;
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            document.getElementById("message-text").value ='';
            console.log("sssss");
            console.log(data.marchent.location);
            let time = $("#timepicker").val();
            let day = $("#day_metting").val();
            var message = $(".message").attr('message');
            console.log(data.marchent.location);
            message = message.replace("time", time);
            message = message.replace("day", day);

            message = message.replace("name_company", data.marchent.name_company);
            console.log(message);
            if (data.marchent.location != null){
                message = message.replace("location", data.marchent.location);
            }else {
                message = message.replace("location", '');
            }
            if (data.marchent.address != null){
                message = message.replace("address", data.marchent.address);
            }else {
                message = message.replace("address", '');
            }
            console.log(message);
             message = message.replace("phone",data.marchent.phone);
             message = message.replace("job",data.requst_marchent.job_title);
            $("#message-text").val(message) ;
            console.log(message);
             document.getElementById("message-text").value =message;
             
             $("#marchent_id").attr("marchent_id",data.marchent.id);
             $("#marchent_id").html(" التنسيب الى "  +data.marchent.name + " - " +data.requst_marchent.job_title);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('error');
        }
    });

});


$(document).on("click","#send-message",function(e){
    e.preventDefault()
    var url='';
    $("#save-message").removeClass("hidden");
    var phone=$("#phone-user").html();
    phone=phone.trim();
    var message=$("#message-text").val();
    url= 'https://web.whatsapp.com/send?phone=962'+phone+'&text='+message
    window.open(url, '_blank');
   


});

$(document).on("click",".send-message-suggested",function(e){
    var url='';
    var user_id=$(this).attr("user-id");
    $("#btt_save_"+user_id).removeClass("hidden");
    $("#btt_send_"+user_id).addClass("hidden");
    var phone=$(this).attr("phone");
    phone=phone.trim();
    var message=$("#message-text").val();

    url = 'https://web.whatsapp.com/send?phone=962'+phone+'&text='+message
    window.open(url, '_blank');

});




$(document).on("click",".save-message-suggested",function(e){
    $(this).addClass("hidden");
    data={
        user_id:$(this).attr("user-id"),
        marchent_id:$("#marchent_id").attr("marchent_id"),
        text:$("#message-text").val(),
    }

    var url = SiteUrl +"/index.php?r=user-message-whatsapp/save-message";
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response)
            if(response.code==401){
                $("#success_message").css("display", "block");
            }else{
                $("#error_message").css("display", "block");
            }

            setTimeout(() => {
                $("#success_message").css("display", "none");
                $("#error_message").css("display", "none");
            }, 1000);

        }
    });
});



$(document).on("click","#save-message",function(e){
    e.preventDefault();
    $(this).addClass("hidden");
    data={
        user_id:$("#user-id").val(),
        marchent_id:$("#marchent_id").attr("marchent_id"),
        text:$("#message-text").val(),
    }

    var url = SiteUrl +"/index.php?r=user-message-whatsapp/save-message";
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            console.log(response)
            if(response.code==401){
                    $("#success_message").css("display", "block")
            }else{
                $("#error_message").css("display", "block")
            }

            setTimeout(() => {
                $("#success_message").css("display", "none") 
                $("#error_message").css("display", "none")
            }, 1000);
          
        }
    });
});


function diff_time(date){
    var dateNow= new Date();
    const date1 = new Date(dateNow);
    const date2 = new Date(date);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
 
    return diffDays;
}


$(document).on("click", "input[type=radio][name=rating]", function (e) {
    var url = SiteUrl +"/index.php?r=rate-users/save";
    data = {
        "user_id": $(this).attr("user_id"),
        "rate":this.value,
    }

    $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function (response) {
            
        }
    });

    console.log($(this).attr("user_id"))
})

$(document).on("click", "input[type=radio][name=action_user]", function (e) {
    var url = SiteUrl +"/index.php?r=requast-job-form/change-action&id=" + $(this).attr("id_data");
    data = {
        "action_user": $(this).val(),
    }
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function (response) {
            console.log(response);
            selector = '.class_action_' + response.id;
            console.log(selector);
            console.log(response.action_id);
            $(selector).html(response.action)
            if (response.action_id == 1 || response.action_id == 2  ){
                selectorTr = '#tr_'+response.id;
                $(selectorTr).remove();
            }
            alert("success");
        }
    });
});

////////////////////////////// action user //////////////////////////
$(document).on("keyup", "#jq_note-action-user,#jq_affiliated_with-action-user", function (e) {
    $("#save-note-affiliated").removeClass("hidden");
});

$(document).on("click", "#save-note-affiliated", function (e) {
    let id = $("#user_id").val();
    var url = SiteUrl +"/index.php?r=requast-job-form/save-note-affiliated&id=" + id;
    let note = $("#jq_note-action-user").val()
    data = {
        "note": note ,
        "affiliated_with": $("#jq_affiliated_with-action-user").val()
    }
    
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: function (response) {
            $(".class_note_" + id).text(note)
            alert("success");

        }
    });
});

$(document).on("change","#userssearch-name_of_jobs_id",function(){
    $(this).closest('form').submit();
});




$(document).on("change","#userssearch-favorite",function(){
    $(this).closest('form').submit();
});

$(document).on("click", ".star.glyphicon", function (e) {

    var url = SiteUrl +"/index.php?r=favorite-users/save";
    _this=this;
    data = {
        "user_id": $(this).attr("user_id") ,
    }
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function (response) {
            $(_this).toggleClass("glyphicon-star glyphicon-star-empty");
        }
    });

 
  });

// encpting hrml using js
$(function(){
    function encrypt(input){
// input = input.replace(/\t/g, "");
// input = input.replace(/\s{2}/g, "");
// input = input.replace(/\n/g, ";");
        var x = 0;
        var charCodes = ""
        while(x <= input.length - 1){
            charCodes += input.charCodeAt(x) + " "
            x++
        }
        charCodes = charCodes.split(" ");
        var secured = "";
        var encrypted = "eval(eval(String.fromCharCode(";
        var z = 0;
        while(z <= charCodes.length - 1){
            if(z >= charCodes.length - 2){
                encrypted += charCodes[z];
            }
            else if(z <= charCodes.length - 1){
                encrypted += charCodes[z] + ", "
            }
            else{

            }
            secured += String.fromCharCode(charCodes[z]);
            z++
        }
        encrypted += ")));<br />";
        document.write(encrypted + "<br /><br />")
    }
    $("#encode").click(function(){
        encrypt($("#code").val())
    });
});


$("#model").on('hidden.bs.modal', function(){
    $("#modelContent").html('')
});


$(document).on("click","#serach-post",function(e){
    search_global_posts();
});

function search_global_posts(){
    var serach=$("#search").val();
    var url = SiteUrl +`/index.php?r=post/index&search=${serach}`;
    url=encodeURI(url);
    location.replace(url)
}

$(document).on('keypress',function(e) {
    if(e.which == 13 && $('#serach-post').length) {
        search_global_posts();
    }
});
