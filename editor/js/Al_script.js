// hello js

$(document).ready(function(){
  
     $('#al_tab1').click(function () {
          $('#alDm1').slideToggle('slow');
          $('#alDm2').hide(1000);
          $('#alDm3').hide(1000);
          $('#alDm4').hide(1000);
          $('#ch1').toggleClass('rotet1');
          $('#ch2').removeClass('rotet2');
          $('#ch3').removeClass('rotet3');
          $('#ch4').removeClass('rotet4');
          
          return false;
     })

     $('#al_tab2').click(function () {
          $('#alDm2').slideToggle('slow');
          $('#alDm1').hide(1000);
          $('#alDm3').hide(1000);
          $('#alDm4').hide(1000);
          $('#ch2').toggleClass('rotet2');
          $('#ch1').removeClass('rotet1');
          $('#ch3').removeClass('rotet3');
          $('#ch4').removeClass('rotet4');
         
          return false;
     })

     $('#al_tab3').click(function () {
          $('#alDm3').slideToggle('slow');
          $('#alDm2').hide(1000);
          $('#alDm1').hide(1000);
          $('#alDm4').hide(1000);
          $('#ch3').toggleClass('rotet3');
          $('#ch1').removeClass('rotet1');
          $('#ch2').removeClass('rotet2');
          $('#ch4').removeClass('rotet4');
         
          return false;
     })

     $('#al_tab4').click(function () {
          $('#alDm4').slideToggle('slow');
          $('#alDm2').hide(1000);
          $('#alDm1').hide(1000);
          $('#alDm3').hide(1000);
          $('#ch4').toggleClass('rotet4');
          $('#ch1').removeClass('rotet1');
          $('#ch2').removeClass('rotet2');
          $('#ch3').removeClass('rotet3');
         
          return false;
     })
 });