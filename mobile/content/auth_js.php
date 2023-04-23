<!---universal--->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js'></script>
<script>
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
<script> 
  //////////////////////////////////////////////
  // Increase/descrease font size
  document.getElementById('resettext').style.display = 'none';
	$('#increasetext').click(function() {
    document.getElementById('resettext').style.display = '';
		curSize = parseInt($('#cardContent').css('font-size')) + 2;
		if (curSize <= 32)
			$('#cardContent').css('font-size', curSize);
	});

	$('#resettext').click(function() {
    document.getElementById('resettext').style.display = 'none';
		if (curSize != 18)
			$('#cardContent').css('font-size', 18);
	});

	$('#decreasetext').click(function() {
    document.getElementById('resettext').style.display = '';
		curSize = parseInt($('#cardContent').css('font-size')) - 2;
		if (curSize >= 8)
			$('#cardContent').css('font-size', curSize);
	}); 
  $('#lightOff').css('display', 'none');
  $('#lightOn').click(function() {
    $('#lightOff').css('display', '');
    $('#lightOn').css('display', 'none');
    document.getElementById('showSpace').className += ' showSpace';
    document.getElementById('hideSpace').className += ' hideSpace';
    document.getElementById('hideTop').className += ' hideSpace';
    document.getElementsById('myBody').className += ' bg-dark';
    
    
	});
  $('#lightOff').click(function() {
    $('#lightOff').css('display', 'none');
    $('#lightOn').css('display', '');
    document.getElementById('showSpace').classList.remove('showSpace');
    document.getElementById('hideSpace').classList.remove('hideSpace');
    document.getElementById('hideTop').classList.remove('hideSpace');
    document.getElementsById('myBody').classList.remove('bg-dark');
    
	});
</script>

 <script>
    var $window = $(window),
  window_height = $window.height() - 150, // I'm using 150 (a random number) so the image appears 150px after it enters the screen, so the effect can be appreciated
  $img = $('img.some_img'),
  img_loaded = false,
  img_top = $img.offset().top;

$window.on('scroll', function() {

  if (($window.scrollTop() + window_height) > img_top && img_loaded == false) {

    $img.attr('src', $img.attr('data-src'));

  }

});
</script>
<script>
///UNIAN
  $(document).ready(function(){
$("div[class='read-also-slider__item'],img[width='370'],img[data-width='200'],div[class='social-btn-bottom'],div[class='read-also-slider__info'],a[class='article__tag'],div[class='publication-bottom'],a[class='publication__tag'],a[class='publication__gn'],img[src='/images/gnews.svg'],a[class='anchor'],img[src='<?php echo $data['photo_url'] ?>'], div[class='bnr-block__bnr'], div[class='owl-photo'], div[class='owl-photo__item'], span[class='owl-photo__title'], div[class='owl-carousel']").remove();
$("div[class='owl-photo']").empty();
$('span').not('[class]').remove();
});
  </script>
 <script>
///PRAVDA
  $(document).ready(function(){
$("a[href='https://t.me/EurointegrationComUA'], ins[class='adsbygoogle'], div[class='article__title'], div[id='div-gpt-ad-1637938597466-0'], div[class='image-box'], a[href='https://www.patreon.com/EuropeanPravda'], table img").remove();
});
  </script>
  <script>
    ////korrespondent
    $(document).ready(function(){
$("div[id='insertNewsBlock']").remove();
});
$('div').not('[class]').filter(function(){
     return  $.trim($(this).text()) === '' 
}).remove();
  </script>
   <script>
///theguardian
  $(document).ready(function(){
$("aside[data-component='rich-link']").remove();
});
  </script>
  <script>
///////p with no class, no id and no text
  $('p', '.ajaxPostText').not('[id],[class]').filter(function(){
     return  $.trim($(this).text()) === '' 
}).remove();
  </script>