<?php if (isset($_SESSION["webembed"])) { ?>
    <p class="text-center"><a href="<?php echo JAK_rewrite::jakParseurl('embedexit');?>"><i class="fa fa-window-restore"></i></a></p>
<?php } else { ?>

    <!-- Close the div's from the header.php file -->
    <?php echo (isset($row["custom2"]) && !empty($row["custom2"]) ? (isset($row["custom3"]) && !empty($row["custom3"]) ? '</div></div></div>' : '</div></div>') : '</div></div></div></div>');?>


    <?php if (isset($row["custom4"]) && $row["custom4"] == 1 && isset($similarart) && !empty($similarart)) { ?>

    <div class="section">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2 class="title text-center"><?php echo $similartitle;?></h2>
          <br>
          <div class="row">
            <?php if (isset($_SESSION["webembed"])) { ?>
                <p><a href="<?php echo JAK_rewrite::jakParseurl(JAK_SUPPORT_URL);?>" class="btn btn-secondary"><i class="fa fa-arrow-left"></i></a></p>
            <?php } else { ?>

            <?php foreach ($similarart as $s) {
                $similarurl = JAK_rewrite::jakParseurl($similarlink, $similarshort, $s["id"], JAK_rewrite::jakCleanurl($s["title"]));
            ?>
            <div class="col-md-4">
              <div class="card card-blog">
                <?php if (!empty($s["previmg"])) { ?>
        <div class="card-header card-header-image">
          <a href="<?php echo $similarurl;?>">
              <img class="card-img-top img-fluid" src="<?php echo BASE_URL.$s["previmg"];?>" alt="<?php echo $s["title"];?>">
              <div class="card-title">
                <?php echo $s["title"];?>
              </div>
            </a>
          </div>
        <?php } ?>
        <div class="card-body">
          <?php if (empty($s["previmg"])) { ?>
            <a href="<?php echo $similarurl;?>">
              <h6 class="card-category text-primary"><?php echo $s["title"];?></h6>
            </a>
          <?php } ?>

          <p class="card-text"><?php echo jak_cut_text($s["content"], 200, '...');?></p>
        </div>
        <div class="card-footer justify-content-center">
          <div class="author">
            <a href="<?php echo $similarurl;?>" class="text-primary"><?php echo $jkl["hd1"];?></a>
          </div>
          <div class="stats ml-auto">
            <i class="material-icons">schedule</i> <?php echo JAK_base::jakTimesince($s['time'], JAK_DATEFORMAT, JAK_TIMEFORMAT);?>
          </div>
        </div>
              </div>
            </div>
            <?php } } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php } ?>

    <!-- Footer -->
    <?php if (isset($row["custom3"]) && !empty($row["custom3"])) { ?>
        <footer class="footer footer-black footer-big">
           <div class="container">
            <div class="content">
               <div class="row">
                  <div class="col-md-5">
                    <?php if (isset($cms_text) && !empty($cms_text)) foreach ($cms_text as $t) {
                        if ($t["cmsid"] == 2) {
                            echo '<div data-editable data-name="title-2">'.$t["title"].'</div>';
                            echo '<div data-editable data-name="text-2">'.$t["description"].'</div>';
                        }
                    } ?>
                </div>
                <div class="col-md-2">
                    <?php if (isset($cms_text) && !empty($cms_text)) foreach ($cms_text as $t) {
                        if ($t["cmsid"] == 3) {
                            echo '<div data-editable data-name="title-3">'.$t["title"].'</div>';
                        }
                    } ?>
                    <div class="footer-nav-column">
                        <?php echo jak_build_menu(0, $mfooter, $page, 'nav flex-column', '', '', '', false, JAK_USERISLOGGED, 'nav-item', 'nav-link tfl', 0, 6);?>
                    </div>
                    <hr class="d-md-none">
                </div>
                <div class="col-md-2">
                    <?php if (isset($cms_text) && !empty($cms_text)) foreach ($cms_text as $t) {
                        if ($t["cmsid"] == 4) {
                            echo '<div data-editable data-name="title-4">'.$t["title"].'</div>';
                        }
                    } ?>
                    <div class="footer-nav-column">
                        <?php echo jak_build_menu(0, $mfooter, $page, 'nav flex-column', '', '', '', JAK_USERID, JAK_USERISLOGGED, 'nav-item', 'nav-link tfl', 6, 12);?>
                    </div>
                    <hr class="d-md-none">
                </div>
                <div class="col-md-3">
                    <?php if (isset($cms_text) && !empty($cms_text)) foreach ($cms_text as $t) {
                        if ($t["cmsid"] == 17) {
                            echo '<div data-editable data-name="title-17">'.$t["title"].'</div>';
                            echo '<div data-editable data-name="text-17">'.$t["description"].'</div>';
                        }
                    } ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="copyright pull-center">
            <!-- Do not remove or edit except you have a copyright link free license -->
            <p class="ctext">HelpDesk 3 Powered by <a href="https://www.jakweb.ch">JAKWEB</a></p>
        </div>
    </div>
</footer>
<?php } else { ?>
    <footer class="footer">
      <div class="container">
        <div class="footer-nav-column">
            <?php echo jak_build_menu(0, $mfooter, $page, 'float-left', '', '', '', JAK_USERID, JAK_USERISLOGGED, '', '', 0, 8);?>
        </div>
        
        <div class="copyright float-right">
          <p class="ctext">HelpDesk 3 Powered by <a href="https://www.jakweb.ch">JAKWEB</a></p>
      </div>
  </div>
</footer>
<?php } } ?>

<!-- Modal -->
<div class="modal fade" id="JAKModal" tabindex="-1" role="dialog" aria-labelledby="JAKModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="JAKModalLabel">&nbsp;</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $jkl['g3'];?></button>
    </div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/functions.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>template/modern/js/standard.js"></script>

<?php if (JAK_USERID && jak_get_access("answers", $jakuser->getVar("permissions"), JAK_SUPERADMINACCESS)) { ?>
<script type="text/javascript" src="<?php echo BASE_URL;?>template/modern/editor/content-tools.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>template/modern/editor/editor.js"></script>
<?php } ?>

<script type="text/javascript" src="<?php echo BASE_URL;?>js/contact.js"></script>
<?php if (!empty(JAK_RECAP_CLIENT) && !JAK_CLIENTID) { ?>
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&amp;render=explicit" async defer></script>
<script type="text/javascript">
  var CaptchaCallback = function() {
    $('.g-recaptcha').each(function(index, el) {
        grecaptcha.render(el, {'sitekey' : '<?php echo JAK_RECAP_CLIENT;?>'});
    });
  };
</script>
<?php } ?>
<script type="text/javascript">
    ls.main_url = "<?php echo BASE_URL;?>";
    ls.ls_submit = "<?php echo $jkl['g11'];?>";
    ls.ls_submitwait = "<?php echo $jkl['g8'];?>";
    $(document).ready(function() {
        jQuery("#pass").keyup(function() {
            passwordStrength(jQuery(this).val());
        });
        <?php if (JAK_CAPTCHA) { ?>
            $(".jak-ajaxform").append('<input type="hidden" name="<?php echo $random_name;?>" value="<?php echo $random_value;?>">');
        <?php } ?>
    });
</script>

<script type="text/javascript">
    <?php if (isset($_SESSION["infomsg"])) { ?>
        $.notify({icon: 'fa fa-info-circle', message: '<?php echo addslashes($_SESSION["infomsg"]);?>'}, {type: 'info', animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }});
    <?php } if (isset($_SESSION["successmsg"])) { ?>
        $.notify({icon: 'fa fa-check-square-o', message: '<?php echo addslashes($_SESSION["successmsg"]);?>'}, {type: 'success', animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }});
    <?php } if (isset($_SESSION["errormsg"])) { ?>
        $.notify({icon: 'fa fa-exclamation-triangle', message: '<?php echo addslashes($_SESSION["errormsg"]);?>'}, {type: 'danger', animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        }});
    <?php } ?>
</script>

<?php if (!empty($js_file_footer)) include_once('template/modern/tplblocks/'.$js_file_footer);?>

<?php if (JAK_CHATWIDGET_ID > 0) { ?>
<!-- helpdesk 3 widget -->
<script type="text/javascript">
    (function(w, d, s, u) {
        w.id = <?php echo JAK_CHATWIDGET_ID;?>; w.lang = '<?php echo $BT_LANGUAGE;?>'; w.cName = '<?php echo (isset($jakclient) ? $jakclient->getVar("username") : "");?>'; w.cEmail = '<?php echo (isset($jakclient) ? $jakclient->getVar("email") : "");?>'; w.cMessage = ''; w.lcjUrl = u;
        var h = d.getElementsByTagName(s)[0], j = d.createElement(s);
        j.async = true; j.src = '<?php echo BASE_URL;?>js/jaklcpchat.js';
        h.parentNode.insertBefore(j, h);
    })(window, document, 'script', '<?php echo BASE_URL;?>');
</script>
<div id="jaklcp-chat-container"></div>
<!-- end helpdesk 3 widget -->
<?php } ?>

</body>
</html>