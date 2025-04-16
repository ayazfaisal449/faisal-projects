
jQuery( document ).ready(function() {
jQuery(".tb-toggle").each(function(){
    jQuery(this).find(".box").hide();
});
        
jQuery(".tb-toggle").each(function(){
    jQuery(this).find(".trigger").click(function() {
        jQuery('.tb-toggle button').removeClass('active').next().slideUp('slow');
        jQuery(this).toggleClass("active").next().stop(true, true).slideToggle("slow");
        //return false;
    });
});
});