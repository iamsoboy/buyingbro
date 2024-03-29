<div class="navbar navbar-default">
	<div class="container">
    	<div class="navbar-header">
        	<a class="navbar-brand" href="<?php echo $_SERVER['REQUEST_URI'];?>"><?php echo $jkl["g"];?> - <?php echo JAK_TITLE;?></a>
    	</div>
	</div>
</div>
 
 <!--- Container -->
 <div class="container">
 	
 	<div class="row">
 		<div class="col-sm-8">
 			
 			<!--- Chat output -->
 			<div id="jrc_chat_output" class="direct-chat-messages" style="background-image: none">
 				<?php if (isset($proactivemsg) && !empty($proactivemsg)) { ?>
 				<div class="direct-chat-msg right">
 					<div class="direct-chat-info clearfix">
 						<span class="direct-chat-name pull-left"><?php echo $jkl["g56"];?></span>
 						<span class="direct-chat-timestamp pull-right"><?php echo JAK_base::jakTimesince(time(), JAK_DATEFORMAT, JAK_TIMEFORMAT);?></span>
 					</div>
 					<img class="direct-chat-img" src="<?php echo BASE_URL.JAK_FILES_DIRECTORY;?>/system.jpg" alt="<?php echo $jkl["g52"];?>">
 					<div class="direct-chat-text">
 						<?php echo $proactivemsg;?>
 					</div>
 				</div>
 				<?php } ?>
 				<div class="direct-chat-msg right">
 					<div class="direct-chat-info clearfix">
 						<span class="direct-chat-name pull-left"><?php echo $jkl["g56"];?></span>
 						<span class="direct-chat-timestamp pull-right"><?php echo JAK_base::jakTimesince(time(), JAK_DATEFORMAT, JAK_TIMEFORMAT);?></span>
 					</div>
 					<img class="direct-chat-img" src="<?php echo BASE_URL.JAK_FILES_DIRECTORY;?>/system.jpg" alt="<?php echo $jkl["g52"];?>">
 					<div class="direct-chat-text">
 						<?php echo $headermsg;?>
 					</div>
 				</div>
 			</div>
 				
 		<div id="client_input_container">
 				
 			<form class="jak-ajaxform" class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
 					
 				<div class="form-group" id="msgError">
 					<label class="sr-only" for="message"><?php echo $jkl["g6"];?></label>
					<div class="input-group">
						<div class="emoji-picker">
							<div id="emoji"></div>
						</div>
						<textarea name="message" id="message" rows="2" class="form-control"></textarea>
					</div>
				</div>
				<button name="sendMSG" id="sendMessage" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> <?php echo $jkl["g10"];?></button>
 					
 				<input type="hidden" name="start_chat" value="1" />
 				<input type="hidden" name="slide_chat" value="<?php if (isset($page1)) echo $page1;?>" />
				<input type="hidden" name="lang" value="<?php if (isset($page2)) echo $page2;?>" />
 					
 			</form>
 		</div>

 		<?php if (isset($jakhs['copyright']) && !empty($jakhs['copyright'])) echo '<div class="copyright text-center">'.$jakhs['copyright'].'</div>';?>
 			
 	</div>	
 	<div class="col-sm-4 sidebar">
 		
 		<p><img src="<?php echo BASE_URL.JAK_FILES_DIRECTORY;?>/system.jpg" class="img-thumbnail img-fluid mt-1" alt="avatar"></p>
 		
 		<div class="alert alert-info alert-block"><?php echo $jkl["g60"];?></div>
 			
 	</div>
 	</div>	
 </div>