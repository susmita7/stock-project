let tl=gsap.timeline({defaults:{duration:1}});

tl.from('.text' , {opacity:0 , y:-70, stagger:.4});



//scroll to top




//Get the button
var mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}




var preloader =document.getElementById("loading");

function loading(){
     
  preloader.style.display ="none";

}



//overlay for services in-out


function overlay_about(){
  let over=document.getElementById("overlay-about");
  gsap.to(over , {scale:1,duration:.8, opacity:1,display:'block'});

//   let tl = gsap.timeline({defaults:{duration:1}});

// tl.from('.anim' , {opacity:0 ,y:-50, stagger: .7})
// .from('.img', {opacity:0, x:-50}, "-=1.8");

}



function reverse_about(){
  let cross=document.getElementById("overlay-about");
  gsap.to(cross, {scale:0,duration:.7 , opacity:0 , display:'none'});

}



//overlay for services in-out


function overlay_ser(){
  let over=document.getElementById("overlay-ser");
  gsap.to(over , {scale:1,duration:.8, opacity:1,display:'block'});

//   let tl = gsap.timeline({defaults:{duration:.7}});

// tl.from('.anim' , {opacity:0 ,y:-50, stagger: .7})

}



function reverse_ser(){
  let cross=document.getElementById("overlay-ser");
  gsap.to(cross, {scale:0,duration:.7 , opacity:0 , display:'none'});

}