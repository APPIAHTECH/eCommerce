
$(document).ready(function() {
  $('#products').pinterest_grid({
    no_columns: 4,
    padding_x: 10,
    padding_y: 10,
    margin_bottom: 50,
    single_column_breakpoint: 700
  });

  $(".btn-update-item").on('click', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var href = $(this).data('href');
		var quantity = $("#product_" + id).val();
		window.location.href = href + "/" + quantity;
  });
    
    // Add smooth scrolling to all links
  $("ul li a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 2000, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
    
    
     $('.contingut').css("opacity","0");
    $('.pujar').click(function(){

      $('body, html').animate({
       scrollTop:'0px'
      },1500);

   });

   $(window).scroll(function(){

     if($(this).scrollTop() > 0){
       $('.pujar').slideDown(300);
       $('.contingut').css("opacity","1");
     } else {
       $('.pujar').slideUp(300);
       $('.contingut').css({
           opacity: "1",
           transition:"all ease 1s"
           
       });
     };

   });
});
