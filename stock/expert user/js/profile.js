// overlay for update


function overlay_update(){
    let over=document.getElementById("overlay-up");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-up");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}



// overlay for password


function overlay_pass(){
    let over=document.getElementById("overlay-pass");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_pass(){
    let cross=document.getElementById("overlay-pass");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}