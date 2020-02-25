
<?php
$query5=mysql_query("SELECT * FROM session ORDER BY id DESC LIMIT 1 ");
$count5=mysql_num_rows($query5);
if($count5>0){
    while($row5=mysql_fetch_array($query5)){
	   $session_time=$row5['minutes']/60;
	  
	}
}

?>

    
    <script type="text/javascript">  

     var sess_pollInterval = <?php echo $session_time; ?>;
    var sess_expirationMinutes =<?php echo $session_time + 1; ?>;
    var sess_warningMinutes =<?php echo $session_time; ?>;
    var sess_intervalID;
    var sess_lastActivity;
  
    function initSession()
    {   
        sess_lastActivity = new Date();
        sessSetInterval();
        $(document).bind('keypress.session', function (ed, e)
        {
            sessKeyPressed(ed, e);
        });
    } 
    function sessSetInterval()
    {
        sess_intervalID = setInterval('sessInterval()', sess_pollInterval);
    }
    function sessClearInterval()
    {
        clearInterval(sess_intervalID);
    }
    function sessKeyPressed(ed, e)
    {
        sess_lastActivity = new Date();
    }
    function sessLogOut()
    {
        
         logout();
                            
    }
    function sessInterval()    
{
        var now = new Date();
        //get milliseconds of differneces
        var diff = now - sess_lastActivity;
        //get minutes between differences
        var diffMins = (diff / 1000 / 60);
        if (diffMins >= sess_warningMinutes)
        {
            //warn before expiring
            //stop the timer
            sessClearInterval();
            //promt for attention
            var active = confirm('Your session will expire in ' + (sess_expirationMinutes - sess_warningMinutes) +
                ' minutes (as of ' + now.toTimeString() + '), press OK to remain logged in ' +
                'or press Cancel to log off. \nIf you are logged off any changes will be lost.');
            if (active == true)
            {
                now = new Date();
                diff = now - sess_lastActivity;
                diffMins = (diff / 1000 / 60);
                if (diffMins > sess_expirationMinutes)
                {
                    sessLogOut();
                }
                else
                {
                    initSession();
                    sessSetInterval();
                    sess_lastActivity = new Date();
                }
            }
            else
            {
                sessLogOut();
            }
        }
    }

</script>


