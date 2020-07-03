
// overlay for order

function overlay_order(){
    let over=document.getElementById("overlay-order");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_order(){
    let cross=document.getElementById("overlay-order");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for upload file

function overlay_upload(){
    let over=document.getElementById("overlay-upload");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_upload(){
    let cross=document.getElementById("overlay-upload");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}



// search

$(document).ready(function(){
    $(".fa-search").click(function(){
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});