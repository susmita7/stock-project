// $(document).ready(function(){
//     $('.main-slider').slick({
//         centerMode: true,
//         centerPadding: '60px',
//         slidesToShow: 3,
//         nextArrow:$('.next'),
//         prevArrow:$('.prev'),
//         responsive: [
//           {
//             breakpoint: 768,
//             settings: {
//               arrows: false,
//               centerMode: true,
//               centerPadding: '10px',
//               slidesToShow: 1
//             }
//           },
//           {
//             breakpoint: 400,
//             settings: {
//               arrows: false,
//               centerMode: true,
//               centerPadding: '10px',
//               slidesToShow: 1
//             }
//           }
//         ]
//       });
//   });

$(document).ready(function () {
  $('.main-slider').slick({
    dots: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    touchMove: false,
    nextArrow: $('.next'),
    prevArrow: $('.prev'),
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '10px',
          slidesToShow: 1
        }
      },
      {
        breakpoint: 600,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '10px',
          slidesToShow: 1
        }
      }
    ]
  });
});


// $(document).ready(function () {
//     $('.main-slider').slick({
//         lazyLoad: 'ondemand',
//         slidesToShow: 3,
//         slidesToScroll: 1,
//         nextArrow: $('.next'),
//         prevArrow: $('.prev'),
//     });
// });