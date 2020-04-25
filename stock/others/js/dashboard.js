var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
    panel.style.maxHeight = null;
    } else {
    panel.style.maxHeight = '200px';
    } 
});
}



$(document).ready(function(){

    var trigger =$('.con_tabs a'),
    container= $('.content');


    trigger.on('click',function(){

        var $this =$(this),
        target = $this.data('target');

        container.load(target + '.php');


        return false;

    });
});





