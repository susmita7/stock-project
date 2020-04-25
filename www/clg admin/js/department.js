
//validation for form add

$(document).on("submit", "#form1", function (e) {
    e.preventDefault();

    var correct_way = /^[A-Za-z]+$/;

    var dept = document.getElementById("dept_add");

    if(dept.value == correct_way){
        true;
    }else{
        swal("Error!", "Special charcters and digits not allowed", "error");
    }


    if (dept.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});

//validation for form update

$(document).on("submit", "#form2", function (e) {
    e.preventDefault();

    var correct_way = /^[A-Za-z]+$/;

    var dept = document.getElementById("dept_up");

    if(dept.value == correct_way){
        true;
    }else{
        swal("Error!", "Special charcters and digits not allowed", "error");
    }


    if (dept.value.trim() == "") {
        swal("Error!", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});


//update modal


$(document).ready(function () {
    $('.editbtn').on('click', function () {
        // $('#update-modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#dept_up').val(data[1]);
    });
});



// overlay for update


function overlay_update() {
    let over = document.getElementById("overlay-update");
    gsap.to(over, {
        duration: .5,
        opacity: 1,
        display: 'block'
    });
}

function reverse_update() {
    let cross = document.getElementById("overlay-update");
    gsap.to(cross, {
        duration: .5,
        opacity: 0,
        display: 'none'
    });

}

// overlay for add


function overlay_add() {
    let over = document.getElementById("overlay-add");
    gsap.to(over, {
        duration: .5,
        opacity: 1,
        display: 'block'
    });
}

function reverse_add() {
    let cross = document.getElementById("overlay-add");
    gsap.to(cross, {
        duration: .5,
        opacity: 0,
        display: 'none'
    });

}


// search


$(document).ready(function () {
    $(".fa-search").click(function () {
        $(".icon").toggleClass("show_search");
        $("input[type='text']").toggleClass("show_search")
    });
});

