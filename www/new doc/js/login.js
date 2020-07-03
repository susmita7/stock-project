let tl_1=gsap.timeline({defaults:{duration:1.1}});

tl_1.from('#text_left' , {opacity:0 , y:-100 , stagger:.4})



$(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
      input.attr("type", "text");
    } else {
      input.attr("type", "password");
    }
});



function get_form2() {
  $('#form1').css('display', 'none');
  $('#form2').css('display', 'block');
}

function get_form3() {
  $('#form2').css('display', 'none');
  $('#form3').css('display', 'block');
}