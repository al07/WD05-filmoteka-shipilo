$(document).ready(function() {
	


   $('#film_input').on("change", function() {
       $('#film_error').remove();
   });
   $('#genre_input').on("change", function() {
       $('#genre_error').remove();
   });
   $('#year_input').on("change", function() {
       $('#year_error').remove();
   });
});