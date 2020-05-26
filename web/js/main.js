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


$(document).on("click",".suggested-jobs",function(){
    $('.modal').modal('show')
        .find('#modelContent')
        .load($(this).attr('value'));
});



//////////////////////////////////////////////////////////// auto complete ////////////////////////////////////


$(document).on("keyup","#message-text",function(e){
  
    url="/web/index.php?r=request-merchant/filter";
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
    var url="/web/index.php?r=user-info&id="+user_id;
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

    var url="/web/index.php?r=request-merchant/get-request&id="+id;
    $.ajax({
        url: url ,
        type: 'GET',
        dataType: 'JSON',
        success: function (data) {
            document.getElementById("message-text").value ='';
            var message=$(".message").attr('message');
             message = message.replace("phone",data.marchent.phone);
             message = message.replace("job",data.requst_marchent.job_title);
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
    var url='';
    $("#save-message").removeClass("hidden");
    var phone=$("#phone-user").html();
    phone=phone.trim();
    var message=$("#message-text").val();
    url= 'https://api.whatsapp.com/send?phone=962'+phone+'&text='+message
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

    url= 'https://api.whatsapp.com/send?phone=962'+phone+'&text='+message
    window.open(url, '_blank');

});




$(document).on("click",".save-message-suggested",function(e){
    $(this).addClass("hidden");
    data={
        user_id:$(this).attr("user-id"),
        marchent_id:$("#marchent_id").attr("marchent_id"),
        text:$("#message-text").val(),
    }

    var url="/web/index.php?r=user-message-whatsapp/save-message";
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
    $(this).addClass("hidden");
    data={
        user_id:$("#user-id").val(),
        marchent_id:$("#marchent_id").attr("marchent_id"),
        text:$("#message-text").val(),
    }

    var url="/web/index.php?r=user-message-whatsapp/save-message";
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


var d = new Date();
var n = d.getFullYear();
var count_m = n - 1992;
var degreees_=["باكالوريا","وبلوم","دكتوراه","اعدادي","ثانوي","اساسي"];

let data = {
    errors: {},
    form:{
          name:'',
          phone:'',
         gender:1,
         agree:'',
        nationality:'',
        governorate:'',
        area:'',
        degrees: [],
        specialization: [],
        the_college_universitys: [],
        year_academic_achievement: [],
        job_title: [],
        year_from_exp: [],
        month_to_exp: [],
        month_from_exp: [],
        year_to_exp: [],
        year_from_exp: [],
        facility_name: [],
        name_courses: [],
        destinations: [],
        month_from_course: [],
        year_from_course: [],
        month_to_course: [],
        year_to_course: [],
        cv:''
    },
    nationalitys:[],
    governorates:[],
    degree:[],
    year: n,
    from_year: 1992,
    count: count_m,
    count_experience: 1,
    count_academic_achievement:1,
    count_courses:1,

     
  
};
var app = new Vue({
    el: '#app',
    data: data,
    methods: {
        add_experience() {
            if (this.count_experience) {
                this.count_experience++;
            }
        },
        remove_experience() {
            if (this.count_experience) {
                this.count_experience--;
            }
        },
        add_academic_achievement() {
            if (this.count_academic_achievement) {
                this.count_academic_achievement++;
            }
        },
        remove_academic_achievement() {
            if (this.count_academic_achievement) {
                this.count_academic_achievement--;
            }
        },
        add_courses(){
            if (this.count_courses) {
                this.count_courses++;
            }
        },
        remove_courses(){
            if (this.count_courses) {
                this.count_courses--;
            }
        },

        submitform(e){
            
            e.preventDefault();
           this.errors={};
            if(this.form.name ==""){
                this.errors['name']=["name is required"];
            }
            if(this.form.phone ==""){
                this.errors['phone']=["phone is required"];
            }
            var pattern= /^\(?(079|078|077)\)?([0-9]{7})$/;

            if(this.form.phone && ! this.form.phone.match(pattern)){
                this.errors['phone']=["phone is pattern"];
            }

            if(this.form.agree ==""){
                this.errors['agree']=["agree is required"];
            }
            if(this.form.agree && isNaN(this.form.agree)){
                this.errors['agree']=["set valiade agree"];
            }
            if(this.form.nationality ==""){
                this.errors['nationality']=["nationality must be selected "];
            }
            if(this.form.governorate ==""){
                this.errors['governorate']=["governorate must be selected "];
            }
            
            if(this.form.area ==""){
                this.errors['area']=["area is required"];
            }

           // if(this.count_academic_achievement >=1){
           //     if(this.form.degrees.length >=1){
           //
           //     }
           //
           // }

            for(let i=1; i <= this.count_academic_achievement;i++){
                if(!(this.form.degrees[i]=='undefined' &&
                    this.form.specialization[i]=='undefined' &&
                    this.form.the_college_universitys[i]=='undefined' &&
                    this.form.year_academic_achievement[i]=='undefined'
                )){
                    console.log(this.degrees)
                    console.log(this.specialization)
                    console.log(this.the_college_universitys)
                    console.log(this.year_academic_achievement)
                    this.errors['experience']=["area is required"];
                }

            }

                // degrees: [],
                // specialization: [],
                // the_college_universitys: [],
                // year_academic_achievement: [],


        return;
            
        }
    },
    mounted() {
        axios
            .get(`/index.php?r=requat-job/get-data`)
            .then(response => {
                this.nationalitys = response.data.data.nationality;
                this.governorates = response.data.data.governorate;
                this.degree= response.data.data.degrees;
                
            });
    }
});
