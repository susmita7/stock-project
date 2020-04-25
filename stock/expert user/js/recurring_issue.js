
//overlay add in-out

function overlay_issue(){
    let over=document.getElementById("overlay-issue");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_add(){
    let cross=document.getElementById("overlay-issue");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}

//search

$(document).ready(function(){
    $(".fa-search").click(function(){
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});