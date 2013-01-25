$(document).ready(function () {
  var a = 0;
                
  /* Image Cycle */
  //Settings
  var faderSettings = {
    timing: 9000,
    fadeSpeed: 400,
    numberOfImages: 3
  };
 
  var images=["/images/truck_full_view.jpg","/images/slideshow3_phx.jpg","/images/az_truck2.jpg"]; // literal array
 
  var displayImage = function(index) {
    //console.log("displayImage "+index);
    $('.truckshow').fadeOut(faderSettings.fadeSpeed, function() {
      $(this).css({
        'backgroundImage': 'url('+ images[index] + ')'
      }).fadeIn(faderSettings.fadeSpeed).animate({
        borderTopLeftRadius: 60,
        borderBottomRightRadius: 60,
        borderTopRightRadius:5,
        borderBottomLeftRadius:5
      },2500).animate({
        borderTopLeftRadius: 5,
        borderBottomRightRadius: 5,
        borderTopRightRadius:60,
        borderBottomLeftRadius:60
      },2500);
    });
  };
 
  function outer(){
    //var a = 0;
 
    function inner(){
      //console.log("a="+a);
      if(a==faderSettings.numberOfImages-1){
        a = 0;
      } else {
        a++;
      }
      //console.log("displayImage: " +a);
      displayImage(a);
    }
    return inner;
  }
  var imageFade = outer();
  var cycleMe = setInterval(imageFade, faderSettings.timing);

  $('.truckshow').animate({
    borderTopLeftRadius: 60,
    borderBottomRightRadius: 60,
    borderTopRightRadius:5,
    borderBottomLeftRadius:5
  },2500).animate({
    borderTopLeftRadius: 5,
    borderBottomRightRadius: 5,
    borderTopRightRadius:60,
    borderBottomLeftRadius:60
  },2500);
    
  $('.emplinks').show();
  $('a#clickshow').click(function() {
    $('.emplinks').toggle('slow');
    return false;
  })
});