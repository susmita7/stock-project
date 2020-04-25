var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } else {
            panel.style.maxHeight = '200px';
        }
    });
}



$(document).ready(function () {

    var trigger = $('.con_tabs a'),
        container = $('.content');


    trigger.on('click', function () {

        var $this = $(this),
            target = $this.data('target');

        container.load(target + '.php');


        return false;

    });
});




function side_menu_open() {
    if (window.matchMedia("(max-width: 600px)").matches) {
        gsap.to('.side_menu', {
            width: '60%',
            display: 'block'
        })
        gsap.to(".admin" ,{display:'block'})
        gsap.to(".tabs" ,{display:'block'})
        gsap.to(".side_menu_footer" ,{display:'block'})
    }
}

function side_menu_close() {
    if (window.matchMedia("(max-width: 600px)").matches) {
        
        gsap.to(".admin" ,{display:'none'})
        gsap.to(".tabs" ,{display:'none'})
        gsap.to(".side_menu_footer" ,{display:'none', onComplete:function(){
            gsap.to('.side_menu', {
                width: '0%',
                display: 'none'
            })
        }})
        
        
    }
}