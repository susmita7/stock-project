// overlay for update


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for delete in-out


function overlay_delete(){
    let over=document.getElementById("overlay-delete");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_delete(){
    let cross=document.getElementById("overlay-delete");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for send


function overlay_send(){
    let over=document.getElementById("overlay-send");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_send(){
    let cross=document.getElementById("overlay-send");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}



// search


$(document).ready(function () {
    $(".fa-search").click(function () {
        $('#search').val("");
        showAllNotifications();
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});