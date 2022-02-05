<script src="<?php echo BASE_URL;?>js/editor/tinymce.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
  tinymce.init({
    selector: '#content-editor',
    height: 300,
    menubar: false,
    plugins: [
      'advlist autolink lists link charmap print preview textcolor',
      'searchreplace visualblocks code fullscreen',
      'insertdatetime table contextmenu paste code codesample'
    ],
    toolbar: 'insert | undo redo | bold italic underline | bullist numlist | removeformat codesample code',
    language: '<?php echo $BT_LANGUAGE;?>',
    <?php if ($jkl["rtlsupport"]) { ?>
    directionality : 'rtl',
    <?php } ?>
    relative_urls: false
  });

  <?php if (JAK_TICKET_SIMILAR == 1) { ?>

  $("#subject").on("keyup", function(e) {
    // We call the function for client is typing and input is bigger then 3
    if (e.keyCode != 13 && $(this).val().length > 2) {
      ticketSearch($(this).val());
    } else {
      $('#loadsimArticle').html("");
      $('#similarArticle').fadeOut();
      return false;
    }
  });

  <?php } ?>

});

function ticketSearch(v) {
  
  // Check if we have a value
  if (v) {
    
    // similar Article Container
    var sac = $('#similarArticle');

    // similar Article Div
    var sadiv = $('#loadsimArticle');

    // Get the value again from the input field
    var newTsubject = $('#subject').val();

    // Now let's cross check if the value is the same or stop the request
    if (newTsubject != v) {
      sadiv.html("");
      sac.fadeOut();
      return false;
    }
            
    var request = new XMLHttpRequest();
    request.open('GET', '<?php echo BASE_URL;?>include/similar_search.php?s='+newTsubject, true);
            
    request.onload = function() {
      if (request.status >= 200 && request.status < 400) {
        // Success!
        var data = JSON.parse(request.responseText);
                  
        if (data.status == 1) {
                      
          // Show Similar Article Container
          sac.fadeIn();

          // Load the content
          sadiv.html(data.articles);
                  
        } else {
          
          // Nothing to do, remove the container    
          sadiv.html("");
          sac.fadeOut();

        }
      }
    }
              
      request.onerror = function() {
        // There was a connection error of some sort
        sadiv.html("");
        sac.fadeOut();
      }
              
      request.send();
        
  } else {
    // We could not output something.
    sadiv.html("");
    sac.fadeOut();
    return false;
  }
}
</script>