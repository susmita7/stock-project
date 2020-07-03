
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

// overlay for insert uploa file

function overlay_uploads(){
    let over=document.getElementById("overlay-uploads");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_uploads(){
    let cross=document.getElementById("overlay-uploads");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}



// search

$(document).ready(function(){
    $(".fa-search").click(function(){
        $("#search").val("");
        showFiles();
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});