
// overlay for add in-out

function overlay_add(){
    let over=document.getElementById("overlay-add");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_add(){
    let cross=document.getElementById("overlay-add");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for update in-out


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}


// overlay for delete in-out


function overlay_delete(){
    let over=document.getElementById("overlay-delete");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_delete(){
    let cross=document.getElementById("overlay-delete");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}

// update modal


$(document).ready(function(){
    $('.editbtn').on('click',function(){
        // $('#update-modal').modal('show');

        $tr =$(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        $('#item').val(data[1]);
    });
});




// search


$(document).ready(function(){
    $(".fa-search").click(function(){
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});

