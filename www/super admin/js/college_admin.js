// overlay for update


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}

// overlay for add


function overlay_add(){
    let over=document.getElementById("overlay-add");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_add(){
    let cross=document.getElementById("overlay-add");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for update in-out


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}



$(document).ready(function(){
    $('.editbtn').on('click',function(){
        // $('#update-modal').modal('show');

        $tr =$(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        $('#first_name_up').val(data[0]);
        $('#last_name_up').val(data[1]);
        $('#email_up').val(data[2]);
    });
});


// search


$(document).ready(function(){
    $(".fa-search").click(function(){
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});





$(document).on("submit", "#form", function (e) {
    e.preventDefault();


    var first = document.getElementById("first_name_add");
    var last = document.getElementById("last_name_add");
    var email = document.getElementById("email_add");
    var password = document.getElementById("password");
    var con_pass = document.getElementById("con_password");
    var clg = document.getElementById("clg_name_add");


    if (first.value.trim() == "" ||last.value.trim() == "" || email.value.trim() == "" || password.value.trim() == "" || con_password.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});


$(document).on("submit", "#form2", function (e) {

    e.preventDefault();

    var first = document.getElementById("first_name_up");
    var last = document.getElementById("last_name_up");
    var email = document.getElementById("email_up");
    var clg = document.getElementById("clg_name_up");
    

    if (first.value.trim() == "" || last.value.trim() == "" || email.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
        true;
    }
});