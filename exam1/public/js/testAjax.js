$(document).ready(function () {
   $('button').on('click', function(e) {
       $place = $('#place')
       $place.load('test.php?data=select', (e) => {
           $place.toggleClass('d-none')
       })
   })
});