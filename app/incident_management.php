
 <style type="text/css">

    #viewProfileOuterDiv{
        border-color: #007DC5;
        border-style:solid;
        /*        margin-top: 20px;*/
        width:1180px;
        height:auto;
        min-height: 380px;
        padding-bottom: 30px;
    }

    #viewProfileTabs {
        font-size: 12pt;
        padding-top:20px;
        font-weight: bold;
    }

    #viewProfileTabs td{
        padding-left:20px;
        cursor:pointer;
        font-family: arial;
    }

    .viewProfileInfo{
        padding-left:20px;
    }

    #editBut {
        width:100px;
        height:20px;
        border:1;
        background-color:#06263B;
        cursor:pointer;
        text-align:center;
        border-radius:5px;
        color:white;
        border:1px solid #9FC7D3;
    }

    #editBut:hover{
        background-color: #525050;
        cursor:pointer;
    }

    .mouseOver{
        font-size:100%;
        position:absolute;
        visibility:hidden;
        border:solid;
        border-width: 1px;
        border-radius:10px;
        z-index: 10;
    }

    #popup_box {
        position:fixed;
        _position:absolute;
        min-height:300px;
        width:600px;
        background:#FFFFFF;
        left: 300px;
        top: 150px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: 15px;
        /* additional features, can be omitted */
        padding:15px;
        font-size:15px;
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;

    }

    #popupBoxClose {
        line-height:15px;
        right:5px;
        top:5px;
        position:absolute;
        font-weight:500;
    }

    #titlebar{
        background-color: #007DC5;
        border-style:1;
        border-radius:5px;
        padding-top:3px;
		margin-left:5px;
        padding-bottom:3px;
        color:white;
    }
</style>

<style type="text/css">
    .popup{
        position: absolute; 
        float: left; 
        display: none; 
        width: 350px; 
        border: 1px solid mistyrose;
        background-color: mistyrose;
        padding: 15px 20px 10px 20px;
        -moz-box-shadow: 0 0 5px #mistyrose;
        -webkit-box-shadow: 0 0 5px #mistyrose;
        box-shadow: 0 0 5px #mistyrose;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -khtml-border-radius: 5px;
        border-radius: 5px;
    }
</style>

<script type="text/javascript">
   function personal(){
        $("#record").css("color","black");
        $("#salary").css("color","black");
        $("#personal").css("color","orchid");
        $("#ttable").css("color","black");

        $('#pi').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
    }
       
    
	function salary(){
        $("#record").css("color","black");
        $("#salary").css("color","orchid");
        $("#personal").css("color","black");
        $("#ttable").css("color","black");

        $('#sal').toggle('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
    }
	function tt(){
	
        $("#record").css("color","black");
        $("#salary").css("color","black");
        $("#personal").css("color","black");
        $("#ttable").css("color","orchid");

        $('#tt').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
        $('#r').hide('slow', function() {
        });
    }

    function record(){
        $("#record").css("color","orchid");
        $("#salary").css("color","black");
        $("#personal").css("color","black");
        $("#ttable").css("color","black");

        $('#r').toggle('slow', function() {
        });
        $('#sal').hide('slow', function() {
        });
        $('#tt').hide('slow', function() {
        });
        $('#pi').hide('slow', function() {
        });
    }
	
	
	function view_payroll(id){
	 
	  
	  
     window.open('?loc=incident_management&viewId='+id+'', '_parent')

	}
 </script>
 <script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tableRemark').dataTable({
            "bJQueryUI": true,  
            "sPaginationType": "full_numbers"
        });
    } );
	
	 $(document).ready(function() {
        oTable = $('#tableRemark1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
		oTable = $('#tableRemark2').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );

	  function emp_app_note(id){ 
        var doc = $(document).height(); 
        var popup = parseInt($(".pluginDiv").height())+parseInt($(".pluginDiv").position().top+parseInt($(".popup").height()));
        var difference = doc-popup;
        var total;
        
        if(difference >= 0){
            total = 0;
        }else{ 
            total = difference;
        }
        
        $.ajax({
            type:'POST',
            url:'?widget=emp_app_info',
            data:{
                id:id,
                action:"admin_remark"
            },
            success:function(data){ 
                $(".popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('.popup').show();
            $('.popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
	

</script>

 <div class="main_div" style="margin-left:0px">
 	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Incident Management</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  
		<p>
		 
            <div id="viewProfileTabs" style="margin-buttom:-10%">
                <table>
                    <tr>
                        <td id="personal" onclick="personal()" <?php if (isset($_GET['t']) == false) { ?> style="color:orchid" <?php } ?> >Incident Details</td>
                        <td id="salary" onclick="salary()" <?php if ($_GET['t'] == 's') { ?> style="color:orchid" <?php } ?>  >Injury Details</td>
                       <td id="ttable" onclick="tt()"  <?php if ($_GET['t'] == 't') { ?> style="color:orchid" <?php } ?>  >Injury Management</td> 
					    <td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td><td>&nbsp </td>
						<td>
                                <select style="width: 250px;" id="emp" onchange="view_payroll(this.value)">
                                    
                                    <?php
									$queryGetEmp = mysql_query("SELECT employee.full_name,employee.id FROM employee
  WHERE EXISTS (SELECT * FROM injury_details
                WHERE injury_details.emp_id =".$_GET["viewId"].")
OR
EXISTS (SELECT * FROM incident_detail
                WHERE incident_detail.emp_id = ".$_GET["viewId"].")
OR
EXISTS (SELECT * FROM injury_management
                WHERE injury_management.emp_id =".$_GET["viewId"].")");
									$count=mysql_num_rows($queryGetEmp);
								    if (isset($_GET["viewId"])) {
									$queryGetEmp1 = mysql_query("SELECT  distinct e.full_name, e.id as eid From employee e WHERE e.id=".$_GET["viewId"]);
									$count1=mysql_num_rows($queryGetEmp1);
									if($count1>0){
									  while ($rowGetEmp1 = mysql_fetch_array($queryGetEmp1)) {
                                        if($count>0){
                                            echo '<option value="' . $rowGetEmp1["eid"] . '">' . $rowGetEmp1["full_name"]. '</option>';
											}else{
								echo '<option value="">Please select</option>';
								
								}
                                        
                                    }
								}
									
									}
									
									
									$queryGetEmp = mysql_query("SELECT employee.full_name,employee.id FROM employee
  WHERE EXISTS (SELECT * FROM injury_details
                WHERE injury_details.emp_id = employee.id)
OR
EXISTS (SELECT * FROM incident_detail
                WHERE incident_detail.emp_id = employee.id)
OR
EXISTS (SELECT * FROM injury_management
                WHERE injury_management.emp_id = employee.id)");
									$count=mysql_num_rows($queryGetEmp);
									if($count>0){
                                    while ($rowGetEmp = mysql_fetch_array($queryGetEmp)) {
									if (isset($_GET["viewId"])) {
                                       if($_GET["viewId"]!=$rowGetEmp["id"]){
                                            echo '<option value="' . $rowGetEmp["id"] . '">' . $rowGetEmp["full_name"]  . '</option>';
											}
											
											}else{
											
											echo '<option value="' . $rowGetEmp["id"] . '">' . $rowGetEmp["full_name"]  . '</option>';
											}
                                        
                                    }
								}else{
								
								 echo '<option value="">No incident recorded</option>';
								}
                                    ?>
                                </select>
                            </td>
                       
                    </tr>
                </table>
				
            </div><br>
			
            <!--end of tabs-->
          
            <div class="viewProfileInfo"  style="">
                <!--Personal Information-->
				<div id="pi">
                <?php include 'widget/emp_incedent_management.php'; ?>
				</div>
                <!--Salary-->
                <div><?php include 'widget/injury_details.php'; ?></div>
                <!--Time Table-->
                <div id="tt" style="display:none; ">  
                   <?php include 'widget/injury_man.php'; ?>
                </div>

                

                <div id="popPro">
                    <!--display the pop up box for the property field-->
                </div>
            </div>
			
            <!--end of employee info-->
			<div class="popup"></div>
        </p></div></div></div>
		
    