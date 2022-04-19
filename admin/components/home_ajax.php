<script>
    ////news
setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "home_ajax/news_counter.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#newsArticles").html(data); 
         
        }
    });

}, 100);
 //users
setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "home_ajax/users_counter.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#allUsers").html(data); 
         
        }
    });

}, 100);
 //active scrapers
 setInterval(function(){ 
      $.ajax({    
        type: "GET",
        url: "home_ajax/scrape_counter.php",             
        dataType: "html",                  
        success: function(data){                    
            $("#activeScrapers").html(data); 
         
        }
    });

}, 100);
</script>