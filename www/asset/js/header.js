$(document).ready(function(){
  setupMobileNav();
});

function setupMobileNav(){
  var navGrabber = $("#mobile-nav-grabber");
  var navGrabberClose = $("#mobile-nav-close");
  var mobileNav = $("#mobile-nav");
  var desktopNav = $("#desktop-nav li")
  
  // Fill in contents of the mobile nav with that of the desktop's nav
  desktopNav.each(function(i){
    // Exclude the home link & the grabber
    if ((0 < i) && (i < desktopNav.length-1)){
      mobileNav.append("<li>" + $(this).html() + "</li>");
    }
  });
  
  // Whenver the grabber is clicked, show the mobile nav
  navGrabber.click(function(){
    mobileNav.fadeIn();
  });
  
  // Whenever the close button is clicked, close the mobile nav!
  navGrabberClose.click(function(){
    mobileNav.stop();
    mobileNav.fadeOut();
  });
}

        //$("#logout").click(function(){
        //  console.log("E");
        //    $.ajax({
        //        url: '/',
        //        type: 'POST',
        //        data: { logout:'hi there!'}
        //      });
        //    location.reload();
        //    console.log("E");
        //});