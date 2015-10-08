/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function xinspect2(o, i) {
    if (typeof i == 'undefined')
        i = '';
    if (i.length > 50)
        return '[MAX ITERATIONS]';
    var r = [];
    for (var p in o) {


        r.push(i + ' ' + p);

    }

    for (var p in o['children']) {
        r.push(i + ' ' + p + ' ' + o['children'][p]);
    }


    return r.join(i + "\n");
}

function jsAttempt(sliderOuter) {
//alert(sliderOuter);
    var sliderIn = sliderOuter.children(':first');
//alert(sliderIn);
//alert(xinspect2(sliderIn));
//
//var x = document.getElementById('".$slider_html_id."');

//jQuery(document).ready(function ($) {
//    $(slider_html_id).cycle('reinit');
//    $('#test').click(function () {
//        $(slider_html_id).cycle('goto', 2);
//        //alert(xinspect2('#$slider_html_id'));
//        var paused = $(slider_html_id).is('.cycle-paused');
//        alert(paused);
//        return false;
//    });
$(sliderIn).on( 'cycle-next', function( event, optionHash ) {
    //sliderIn.on('cycle-next', function (event, optionHash) {
// your event handler code here
// argument opts is the slideshow's option hash
        alert('cycle-next ' + xinspect2(event));
    });

    //alert('calling jsAttempt 1');
    sliderOuter.children(':first').on('cycle-before', function (event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag) {
// your event handler code here
// argument opts is the slideshow's option hash
        alert('cycle-before ' + xinspect2(event));
        alert('cycle-before ' + xinspect2(event['isTrigger']) + ' ' + xinspect2(incomingSlideEl));
        //alert('cycle-before ' + xinspect2(event.isTrigger));
    });


    if (!window.jQuery)
    {
        alert('no jQuery');
    }
   // alert('calling jsAttempt 2');
   
//           function () { 
//    //alert('calling jsAttempt 2.1');
//   
//   }
           
   //alert('calling jsAttempt 2');
//    $(document).ready(function () {
//       // $("#myButton").css("color", "red");
//       alert('calling jsAttempt 2.1');
//    });
    //sliderIn.cycle('goto', 3);
    //alert('calling jsAttempt 3');

    // $('#myButton').click(function (e) {  });
//// e.preventDefault();
//
////alert('button');
//        //var y = document.getElementById('".$slider_html_id."');
//        //alert(xinspect2(y));
//        //var child = $('#".$slider_html_id."').children(':first');
//        // alert(xinspect2( $('#".$slider_html_id."').children(':first')));
//        //alert(xinspect2(child));
//        // alert(xinspect2(child.cycle));
//        sliderIn.cycle('goto', 2);
//        //
//        //var element_type = field[0].tagName;
//        //alert($('#$slider_html_id'));
////         alert(xinspect2($('#".$slider_html_id."').cycle));
////         alert(xinspect2($('#".$slider_html_id."').cycle.transitions));
////         alert(xinspect2($('#".$slider_html_id."').cycle.API));
////             alert(xinspect2($('#".$slider_html_id."').cycle.API.jump));
////         //alert(xinspect2($('#".$slider_html_id."').cycle.defaults));

//        // $('#$slider_html_id').cycle('goto', 3);
//        // $(y).cycle('goto', 3);
//
//        alert('button2');

    // });
//    (function () {
//        //  alert('hi1.1'); 
//        var y = document.getElementById('".$slider_html_id."');
//        $(y).cycle('goto', 3);
//        $('$slider_html_id').cycle('goto', 3);
//        //y.cycle('goto', 2);
//        //    alert('hi1.2'); 
//
//    })();
    alert("locbasedSliderModifications");
//});
}

 var lockBroken = false;
 
 
 var lockBroken = false;
      var numberOfRelevantSlides = 0;
       alert('init 0');
      for(i = 0; i <  slider.data('cycle.opts').slideCount ; i++){
        var nextSlide = $(slider).children().eq(i).nextSlide;
        var nextSlideCode =  nextSlide.find('code').eq(0);
          if(nextSlideCode.innerHTML.indexOf('1') > -1){
              numberOfRelevantSlides++;
           }
      }
       alert('init 0.1');
      var Options = slider.data('cycle.opts');
      //var setTimeout = Options.timeout;
      if(numberOfRelevantSlides == 0){
        lockBroken = true;
      }else if(numberOfRelevantSlides == 1){
        //Options.timeout = 0;
        $(slider).cycle('pause');
        alert('paused ');
      }
      alert('init ');