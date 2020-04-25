
//validation for form add

$(document).on("submit", "#form1", function (e) {
    e.preventDefault();


    var first_name = document.getElementById("first_name_add");
    var last_name = document.getElementById("last_name_add");
    var email = document.getElementById("email_add");
    var pass = document.getElementById("pass");
    var con_pass = document.getElementById("con_pass");

    if (first_name.value.trim() == "" || last_name.value.trim() == "" || pass.value.trim() == "" || con_pass.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});

//validation for form update

$(document).on("submit", "#form2", function (e) {
    e.preventDefault();
    var first_name = document.getElementById("first_name_up");
    var last_name = document.getElementById("last_name_up");

    if (first_name.value.trim() == "" || last_name.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});



// overlay for update in-out


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}

// overlay for add in-out


function overlay_add(){
    let over=document.getElementById("overlay-add");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_add(){
    let cross=document.getElementById("overlay-add");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


//overlay for update  (retrive content)

$(document).ready(function(){
    $('.editbtn').on('click',function(){

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


$(document).ready(function () {
    $(".fa-search").click(function () {
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});



// overlay for delete in-out


function overlay_delete(){
    let over=document.getElementById("overlay-delete");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_delete(){
    let cross=document.getElementById("overlay-delete");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}