//overlay for dept_admin

function overlay_admin(){
    let over=document.getElementById("overlay-admin");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_admin(){
    let cross=document.getElementById("overlay-admin");
    gsap.to(cross , {duration:.5, opacity:0, display:'none'});

}

//overlay for EU

function overlay_EU(){
    let over=document.getElementById("overlay-EU");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_EU(){
    let cross=document.getElementById("overlay-EU");
    gsap.to(cross , {duration:.5, opacity:0, display:'none'});

}

//animation

let tl=gsap.timeline({defaults:{duration:1}});

tl.from('#text-heading' , {opacity:0 , y:-100 , stagger:.6})
.from('.rect' , {opacity:0 , x:-70, stagger:.4});

//eye

$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});




