<?php

/*
    Plugin Name: simonsattemp
    Description: attempt to get info from browzer languages
    Author: Simon Holtz
    Version: 1.0
*/
//http://stackoverflow.com/questions/12553160/getting-visitors-country-from-their-ip
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}
function makeJSForSlider($slider_html_id){
    $s = "";
//     $s .= "$('.".$slider_html_id."')";
//    $s .= "  <button id='myButton' onclick=".'"'. //"alert('hi1');".
//            //" $('$slider_html_id').cycle('goto', 3); alert('hi');".
//            
//            "var z=document.getElementById('".$slider_html_id."'); ".
//          // " $(z).cycle('goto', 3);".
//            
//            
//           // "alert('hi2');".
//            '"'." >my</button> \n";
//    $s .= '<button data-cycle-cmd="pause">Pause</button>';
//     $s .= '    <button data-cycle-cmd="remove"  data-cycle-arg="0">Remove Slide</button>';//data-cycle-context="#$slider_html_id"
//     $s .= "<button id='test'>test</button>";
    
     //$s .= "<script src='/cyclone-slider-2/src/LocationAndLanguageRelevancy/locbasedSliderModifications.js'></script>";
    // $s .= "<script   type='text/javascript' src='/wordpress\wp-content\plugins\cyclone-slider-2\src\LocationAndLanguageRelevancy/locbasedSliderModifications.js'></script>";
     
    $s .="<script>";//type='text/javascript'
   // $s .=" alert('calling jsAttempt'); ";
//    $s .= " jQuery(document).ready(function($){ ";
//    //$s .=" jsAttempt('$slider_html_id'); ";//'$slider_html_id'
//    $s .=" jsAttempt($('$slider_html_id')); ";//'$slider_html_id'
//    //'"'+slider_html_id+'"')
//   $s .= " alert('called jsAttempt'); });";
//    
    //$s .= "</script >";
    
    //$s .=
    // $s .="". "$('.".$slider_html_id."');";
    
    
    $s .=
    "function xinspect(o,i){".
    "   if(typeof i=='undefined') i=''; ".
    "   if(i.length>50)return '[MAX ITERATIONS]'; ".
    "   var r=[]; ".
    "   for(var p in o){ ".
    "       var t=typeof o[p]; ". 
    "       r.push(i+'".'"'."'+p+'".'"'." ('+t+') => '+(t=='object' ? 'object:'+xinspect(o[p],i+'  ') : o[p]+''));".
    "   }".
    "   return r.join(i + ".'"\n"'."); ".
    " } ";
    
     //$s .= "alert('hi1'); \n";
    $s .=
    "function xinspect2(o,i){".
    "   if(typeof i=='undefined') i=''; ".
    "   if(i.length>50)return '[MAX ITERATIONS]'; ".
    "   var r=[]; ".
    "   for(var p in o){ ".
    
    
    "       r.push(i+' ' +p);".
            
    "   }".
           
    "   for(var p in o['children']){ ".    
    "       r.push(i+' ' +p + ' ' + o['children'][p]);".       
    "   }".
            
            
    "   return r.join(i + ".'"\n"'."); ".
    " } ";

// example of use:
   // $s .= "alert('hi2'); \n";
   //$s .= " alert(xinspect(document));";
    
    // $s .= "var x=document.getElementById('".$slider_html_id."');";
     //$s .= " alert(x); \n";
   //   $s .= " alert(xinspect2(x));";
     // $s .= " alert(xinspect2(x.cycle));";
   // $s .= "alert('hi2'); \n". "$('.".$slider_html_id."')";
    //$s .= "alert( $(".$slider_html_id ." ) ); \n";
    
    // $s .= "";
    $s .= "function setBackwards(slider, next, pref) {"
            
            . " next.toggleClass( 'cycloneslider-next', false ).toggleClass( 'cycloneslider-prev', true );"
            . " pref.toggleClass( 'cycloneslider-next', true ).toggleClass( 'cycloneslider-prev', false );"
            . " jQuery(slider).cycle('resume');"
            . " var changedOpts = slider.data('cycle.opts');"
            . " changedOpts.reverse = true;"
            . "}";
    
    $s .= "function setForwards(slider, next, pref) {"
            . " next.toggleClass( 'cycloneslider-next', true ).toggleClass( 'cycloneslider-prev', false );"
            . " pref.toggleClass( 'cycloneslider-next', false ).toggleClass( 'cycloneslider-prev', true );"
            . " jQuery(slider).cycle('resume');"
            . " var changedOpts = slider.data('cycle.opts');"
            . " changedOpts.reverse = false;"
            . "}";
    
    
  $s .= "jQuery(document).ready(function($){
      var slider = $('#".$slider_html_id."').children(':first');
        //$(slider).cycle('reinit');
      var lockBroken = false;
      var numberOfRelevantSlides = 0;
     
      try{
      jQuery(slider).ready(function($){
      
       //cycloneslider-prev
       //alert('sliders next and pref ');
        var sliderNext = $('#".$slider_html_id."').find('.cycloneslider-next' );
        var sliderPref = $('#".$slider_html_id."').find('.cycloneslider-prev' );
        try{
        
      
      //alert('sliderNext '+sliderNext.attr('class')+ ' '+sliderNext.hasClass('cycloneslider-next') ); //+' '+ xinspect2(sliderNext)
      //alert(sliderNext['html']);
      //sliderNext.toggleClass( 'cycloneslider-next', false ).toggleClass( 'cycloneslider-prev', true );
      //sliderPref.toggleClass( 'cycloneslider-next', true ).toggleClass( 'cycloneslider-prev', false );
      setBackwards(slider,sliderNext,sliderPref );
      setForwards(slider,sliderNext,sliderPref );
      //alert('sliderNext '+sliderNext.attr('class'));
      }catch(e){
        alert(e);
        }
        

      // alert('init slider.data '+ slider.data('cycle.opts').slideCount);
      for(var i = 0; i <  slider.data('cycle.opts').slideCount ; i++){
      // alert('init 0 i '+i);
      var nextSlide = $(slider).children().eq(i);
      var nextSlideCode =  nextSlide.find('code').eq(0);
      try{
      //alert(nextSlideCode.text() +' '+xinspect2(nextSlideCode));
      
      if(nextSlideCode.text().match(/\d+/) != null){
       // if(nextSlideCode.innerHTML.indexOf('1') > -1){
           numberOfRelevantSlides++;
         }
         }catch(e){alert(e); }
      }
       //alert('init 0.1');
      var Options = slider.data('cycle.opts');
      //var setTimeout = Options.timeout;
      if(numberOfRelevantSlides == 0){
        lockBroken = true;
      }else if(numberOfRelevantSlides == 1){
        //Options.timeout = 0;
        $(slider).cycle('pause');
       // alert('paused ');
      }
      
     // alert('init ');
       });
      }catch(e){
      alert(e);
        }
  if (sliderNext === undefined) {
        var sliderNext = $('#".$slider_html_id."').find('.cycloneslider-next' );
        var sliderPref = $('#".$slider_html_id."').find('.cycloneslider-prev' );
        }
$( slider ).on( 'cycle-bootstrap', function( e, optionHash, API ) {
        // advanceSlide handles next, prev
        //alert(xinspect2(API));
        var origAdvanceSlide = API.advanceSlide;
        API.advanceSlide = function(n) {
            if (true) {
                origAdvanceSlide.call(API,n);
            }
        }
        
        var ocalcNextSlide = API.calcNextSlide;
        API.calcNextSlide = function(n) {
            if (true) {
                ocalcNextSlide.call(API,n);
            }
        }
        
        //alert((API.calcNextSlide));
//        var origtrigger = API.trigger;
//        API.trigger = function(n) {
//            alert(n);
//            if (true) {
//                origtrigger.call(API,n);
//            }
//        }
//        
//        var origcalcNextSlide = API.calcNextSlide;
//        alert(origcalcNextSlide);
//        API.calcNextSlide = function(n) {
//            //alert(n);
//            if (true) {
//                origcalcNextSlide.call(API,n);
//            }
//        }
        //

        // jump handles the goto a specific slide
        var origJump = API.jump;
        API.jump = function(n) {
            if (true) {
                origJump.call(API,n);
            }
        }
    });


$(slider).on( 'cycle-pager-activated', function(event, optionHash) {
   // alert('pager-event'+ xinspect2(event));
//    $(slider).cycle('resume');
//    var changedOpts = slider.data('cycle.opts');
//    changedOpts.reverse = false;
    //todo add potential break
    try{
    setForwards(slider,sliderNext,sliderPref );
    }catch(e){
     alert(e);
     
     }
});

$(slider).on( 'cycle-next', function( event, optionHash ) {
    //alert('cycle-next '+ xinspect2(event));
    $(slider).cycle('resume');
    var changedOpts = slider.data('cycle.opts');
    changedOpts.reverse = false;
    //todo add potential break
    setForwards(slider,sliderNext,sliderPref );
}); 
    


   $(slider).on( 'cycle-before', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
    // your event handler code here
    // argument opts is the slideshow's option hash
    //alert('cycle-before ');
    //event.preventDefault();
    //alert('cycle-before ' + xinspect2(event.target));
   // alert('cycle-before '  + slider.data('cycle.opts').currSlide + ' ' + slider.data('cycle.opts').nextSlide+ ' ');
//   try{
//   var someval = incomingSlideEl.getElementsByTagName('code')[0];//incomingSlideEl['children'][0] ;
//    //alert('c-before '+ someval.tagName + ' ' + xinspect2(someval));
//    //slider.cycle('goto',0);
//    }catch(e){
//     alert(e);
//     //throw e;
//    }
//alert('cycle-before ' + xinspect2(event));   
// alert('isTrigger ' + xinspect2(event['isTrigger']) + ' incomingSlideEl '+ xinspect2(incomingSlideEl) );
   // alert('isTrigger tag' + xinspect2(event['isTrigger'])  );
    //alert('cycle-before ' + xinspect2(event.isTrigger));
    
try{
        var nextSlideNum = ( slider.data('cycle.opts').nextSlide +1 )% slider.data('cycle.opts').slideCount ;
        //alert('nextSlideNum '+ nextSlideNum);
        var nextSlide = $(slider).children().eq(nextSlideNum);
        var nextSlideCode =  nextSlide.find('code').eq(0);
        
        var changedOpts = slider.data('cycle.opts');
        
        

        if(nextSlideCode.text().indexOf('1') >= 0){
           // alert('matches');
        }else{
            if(lockBroken){

            }else{
                //alert('cycle-before c '  + slider.data('cycle.opts').currSlide + ' a ' + slider.data('cycle.opts').nextSlide+ ' ');
                 setBackwards(slider,sliderNext,sliderPref );
                //changedOpts.reverse = true;
                //slider.cycle('goto',0);
           }
        }
        
        if(slider.data('cycle.opts').nextSlide == 0){
       // changedOpts.reverse = false;
       
        setForwards(slider,sliderNext,sliderPref );
       }
    }catch(e){
     alert('cycle-before e '+e);
    }


});  

$(slider).on( 'cycle-after', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
   //alert(incomingSlideEl);
   //alert('cycle-after '  + slider.data('cycle.opts').currSlide + ' ' + slider.data('cycle.opts').nextSlide+ ' ');
//   if(slider.data('cycle.opts').nextSlide == 0){
//    changedOpts.reverse = false;
//   }
//   try{
//        var nextSlide = $(slider).children().eq(slider.data('cycle.opts').nextSlide);
//        var nextSlideCode =  nextSlide.find('code').eq(0);
//        if(nextSlideCode.text().indexOf('1') >= 0){
//           // alert('matches');
//        }else{
//            if(lockBroken){
//
//            }else{
//                var changedOpts = slider.data('cycle.opts');
//                changedOpts.reverse = true;
//                //slider.cycle('goto',0);
//           }
//        }
//    }catch(e){
//     alert(e);
//    }
    //slider.cycle('goto',0);
    //var someval = incomingSlideEl.getElementsByTagName('code')[0];//incomingSlideEl['children'][0] ;
    //alert('c-before '+ someval.tagName + ' '+ someval.innerHTML +' ' + xinspect2(someval) );
    //if(nextSlideCode.innerHTML.indexOf('1') > -1){
    
});  
$(slider).on( 'cycle-update-view-before', function( event, optionHash, outgoingSlideEl, incomingSlideEl, forwardFlag ) {
   
   //alert('cycle-update-view-before ' + xinspect2(event));
   try{
   var someval = incomingSlideEl.getElementsByTagName('code')[0];//incomingSlideEl['children'][0] ;
    //alert('c-before '+ someval.tagName + ' ' + xinspect2(someval));
   // slider.cycle('goto',0);
    
    }catch(e){
     alert(e);
    }
});  
 
       
    $('#myButton').click(function(e){
        // e.preventDefault();
        
        //alert('button');
         var y=document.getElementById('".$slider_html_id."');
         //alert(xinspect2(y));
         var child = $('#".$slider_html_id."').children(':first');
        // alert(xinspect2( $('#".$slider_html_id."').children(':first')));
         //alert(xinspect2(child));
        // alert(xinspect2(child.cycle));
         child.cycle('goto', 2);
         //
         //var element_type = field[0].tagName;
         //alert($('#$slider_html_id'));
//         alert(xinspect2($('#".$slider_html_id."').cycle));
//         alert(xinspect2($('#".$slider_html_id."').cycle.transitions));
//         alert(xinspect2($('#".$slider_html_id."').cycle.API));
//             alert(xinspect2($('#".$slider_html_id."').cycle.API.jump));
//         //alert(xinspect2($('#".$slider_html_id."').cycle.defaults));
         
         
        
         
        
        alert('button2');    
    }); 

   // alert('done'); 
});";
  
  
  //    (function() {
//      //  alert('hi1.1'); 
//        var y=document.getElementById('".$slider_html_id."');
//            $(y).cycle('goto', 3);
//            $('$slider_html_id').cycle('goto', 3);
//    })();
//    
//    
 // $s .= "alert('hi2'); ";
 //   $s .= " $('.".$slider_html_id."').cycle('goto', 2);\n";
   //  $s .= "alert('hi3'); \n";
   // $s .= "alert('hi'); \n";
 //    $s .= "x.cycle('goto', 2);";
//      $s .= "alert('hi4'); \n";
    //$('.cycle-slideshow').cycle('goto', 2);
  $s .= "</script >";
    return $s;
    
}
function UseNationalitySortFunction(&$arrayToSort , $slider_html_id){
    $GB = "109.159.41.19";
    $US = "173.252.110.27";
    $ClientIP = $_SERVER['REMOTE_ADDR'];
    if($ClientIP == "::1"){
        $ClientIP = $GB;
    }
    
    $countryCodes = array (strtoupper ( ip_info($ClientIP, "countrycode") ));//todo add browser languages way to optain the 
    $hasfoundMatch = false;
    
    $matches = array();
    
    foreach ($arrayToSort as $i => $value) {
        foreach ($countryCodes as $i2 => $value) {
            //echo "<br> check "+$arrayToSort[$i]['testimonial_nations'];
            if (strpos($arrayToSort[$i]['testimonial_nations'], $value) !== FALSE){   
                //$arrayToSort[$i]['matches_nations'] = true;//doesn't work
                array_push($matches, $i);
                $hasfoundMatch = true;
               
                // echo "found";
            }
        }
    }
    uksort(
  
            $arrayToSort, function($a, $b) use ($countryCodes, $arrayToSort) {
        //$myExtraArgument1 and 2 are available in this scope
        //perform sorting, return -1, 0, 1
        $aval = 0;$bval = 0;       
        if($a['testimonial_nations'] != NULL ) {
            foreach ($countryCodes as $i => $value) {
                if (strpos($arrayToSort[$a]['testimonial_nations'], $value) !== FALSE){   
                    $aval++;
                }
            }
        }
        if($arrayToSort[$b]['testimonial_nations'] != NULL){
            foreach ($countryCodes as $i => $value) {
                if (strpos($arrayToSort[$b]['testimonial_nations'], $value) !== FALSE){
                    $bval++;
                }
    
            }
        }
        
        //strcmp($a, $b)
        return ($aval > $bval) ? -1 : (($aval < $bval) ? 1 : 0)  ;
    });
    //$hasfoundMatch //TODO use this...
   
    return $matches;
}
function mySortFunction(&$arrayToSort, $myExtraArgument1, $myExtraArgument2) {
    usort($arrayToSort, function($a, $b) use ($myExtraArgument1, $myExtraArgument2) {
        //$myExtraArgument1 and 2 are available in this scope
        //perform sorting, return -1, 0, 1
        return strcmp($a, $b);
    });
}

function sort_by_region_meta(&$terms, $meta) {
    usort($terms, function($a, $b) use ($meta) {
        $name_a = get_term_meta($a->term_id, 'artist_lastname', true);
        $name_b = get_term_meta($b->term_id, 'artist_lastname', true);
        return strcmp($name_a, $name_b);  
    });
}


//print(ip_info("173.252.110.27", "countrycode") . "<br>");

//print(ip_info("109.159.41.19", "countrycode") . "<br>");
//print(foobar_func(null));
function foobar_func( $atts ){
  $result =   '<script>
function getLang()
{
 if (navigator.languages != undefined) 
 return navigator.languages[0]; 
 else 
 return navigator.language;
}
var d=new Date(Date.UTC(2014,1,26,3,0,0));
var dateFormat={weekday:"long",year:"numeric",month:"long",day:"numeric"};
var result = d.toLocaleDateString("i-default",dateFormat);
//alert();
document.getElementById("demo").innerHTML = getLang() + " "+ result ;
</script>' . $_SERVER['HTTP_ACCEPT_LANGUAGE'];
  
$result .=  " ".  $_SERVER['REMOTE_ADDR']. "<br>" ;
	return $result;
}


$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
?>