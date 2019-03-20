$(document).ready(function(){
   adjustFooter()
   $(window).resize(function(){
	adjustFooter()
   });

   $('.timepicker').timepicker();
});

function adjustFooter(){
    if ($(document).height() <= $(window).height()){
        $('footer').addClass("fixed-bottom");     
    }else{
	 $('footer').removeClass("fixed-bottom");
    }
}