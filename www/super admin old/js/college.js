// $(document).ready(function(){
//      $('#btn_add').click(function(){
//          var name=$('#clg_name').val();

//          if(name){
//              $.ajax({
//                  url:"insert.php",
//                  method:"POST",
//                  data:{clg_name:name},
//                  dataType:"text",
//                  success:function(data){
//                      $('#clg_name').val("");
//                  }
//              })
//          }
//      });  
// });


$(document).ready(function(){
    $('.editbtn').on('click',function(){
        // $('#update-modal').modal('show');

        $tr =$(this).closest('tr');

        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);

        $('#clg_name').val(data[1]);
    });
});



// overlay for update


function overlay_update(){
    let over=document.getElementById("overlay-update");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_update(){
    let cross=document.getElementById("overlay-update");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}

// overlay for add


function overlay_add(){
    let over=document.getElementById("overlay-add");
    gsap.to(over , {duration:.5, opacity:1 , display:'block'});
}

function reverse_add(){
    let cross=document.getElementById("overlay-add");
    gsap.to(cross, {duration:.5 , opacity:0 , display:'none'});

}