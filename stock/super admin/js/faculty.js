//validation add form

$(document).on("submit", "#form", function (e) {
    e.preventDefault();

    var correct_way = /^[A-Za-z]+$/;

    var faculty = document.getElementById("name_fac");

    if(faculty.value == correct_way){
        true;
    }else{
        swal("Error!", "Special charcters and digits not allowed", "error");
    }


    if (faculty.value.trim() == "") {
        swal("Error", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});



//validation add form

$(document).on("submit", "#form2", function (e) {
    e.preventDefault();

    var correct_way = /^[A-Za-z]+$/;

    var faculty = document.getElementById("fac_name");

    if(faculty.value == correct_way){
        true;
    }else{
        swal("Error!", "Special charcters and digits not allowed", "error");
    }


    if (faculty.value.trim() == "") {
        swal("Error", "whitesapces not allowed", "error");
    }else {
          
        true;
    }
});



$(document).ready(function () {
    $('.editbtn').on('click', function () {
        // $('#update-modal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function () {
            return $(this).text();
        }).get();

        console.log(data);

        $('#fac_name').val(data[1]);
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