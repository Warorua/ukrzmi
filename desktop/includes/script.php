<script type="text/javascript">
  $(function() {
    $("#term").autocomplete({
      source: 'search/title_autocomplete.php',
      autoFocus: true,
      classes: {
        "ui-autocomplete": "autoSearch shadow",

      }
    });
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script>
  document.addEventListener('click', function(e) {
    // Hamburger menu
    if (e.target.classList.contains('hamburger-toggle')) {
      e.target.children[0].classList.toggle('active');
    }
  })
</script>
<script>
  $(function() {
    $(".dropdown-menu > li > a.trigger").on("click", function(e) {
      var current = $(this).next();
      var grandparent = $(this).parent().parent();
      if ($(this).hasClass('left-caret') || $(this).hasClass('right-caret'))
        $(this).toggleClass('right-caret left-caret');
      grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
      grandparent.find(".sub-menu:visible").not(current).hide();
      current.toggle();
      e.stopPropagation();
    });
    $(".dropdown-menu > li > a:not(.trigger)").on("click", function() {
      var root = $(this).closest('.dropdown');
      root.find('.left-caret').toggleClass('right-caret left-caret');
      root.find('.sub-menu:visible').hide();
    });
  });
</script>
<script>
$(document).ready(function() {
  var containerHeight = $('#containerSc').height();
  var element2Height = $('#moveable-element').height();
  
  $('#containerSc').scroll(function() {
    var scrollTop = $(this).scrollTop();
    var maxScroll = containerHeight - element2Height;
    
    if (scrollTop > maxScroll) {
      $('#moveable-element').css('top', maxScroll - scrollTop + 'px');
    } else {
      $('#moveable-element').css('top', '0');
    }
  });
});

</script>
<?php
$pdo->close();
?>