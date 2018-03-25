 
<?php
if(!isset($_SESSION['nickname'])){
    (new UsersController())->login();
}
else{
?>
<div id="wrapper" >
    <div id="menu">
        <div class="welcome"><b><?php echo "Pokalbių kambarys"; ?></b></div>
        <!--<div class="logout"><a id="exit" href="#">Exit Chat</a></div>-->
        <div style="clear:both"></div>
    </div>    
    <div id="chatbox"><?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?></div>
     
    <form name="message" action="">
        <input name="usermsg" type="text" id="usermsg" size="63" />
        <input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
    </form>
</div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});
</script>
    <script type="text/javascript">
// jQuery Document
        $(document).ready(function(){
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Ar jūs tikrai norite atsijungti?");
		if(exit===true){window.location = '?logout=true';}		
	});
});
//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
        //Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") + 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	}
		});
	}
        setInterval (loadLog, 2500);
</script>
<?php
}
if(isset($_GET['logout'])){ 
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>". $_SESSION['nickname'] ." paliko pokalbį.</i><br/></div>");
    fclose($fp);
     
    session_destroy();
    header("Location: ?view=users&action=login"); //Redirect the user
}
?>

