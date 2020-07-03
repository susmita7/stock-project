
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


// search


$(document).ready(function(){
    $(".fa-search").click(function(){
        $('#myInput').val("");
        showColleges();
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});