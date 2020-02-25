<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>
	<style type="text/css">
    #passwordPop {

        position:fixed; 
        		
        _position:absolute; /* hack for internet explorer 6 */  
		
        height:150px;  
        width:40%;  
        background:#FFFFFF;  
        left: 700px;
        top: 185px;
        z-index:100; /* Layering ( on-top of others), if you have lots of layers: I just maximized, you can change it yourself */
        margin-left: -410px;  	
        /* additional features, can be omitted */
        /*        border:2px solid #ff0000;  */
        border:10px solid #C4C4C7;
        padding:15px;  
        font-size:15px;  
        -moz-box-shadow: 0 0 5px #EAEAEB;
        -webkit-box-shadow: 0 0 5px #EAEAEB;
        box-shadow: 0 0 5px #EAEAEB;
        overflow: auto;

    }
	
</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>


<div class="main_div">
	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Appraisal Rating</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">  
		<p>
    <div class="header_text">
     
		<?php
                if (isset($_GET['aid']) == true) {

				
       echo'<span>Edit Appraisal Rating</span>';
		}else{
		echo'<span>Create Appraisal Rating</span>';
		}
		
		?>
    </div>
    <div class="main_content">
        <div id="container" class="tablediv">

            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['aid']) == true) {
                    $sql_result7 = mysql_query("SELECT * FROM rating WHERE id=" . $_GET['aid'] . ";");
					
                    while ($newArray7 = mysql_fetch_array($sql_result7)) {
                        ?>

                        <table id="forms">
                            <tr>
                                <td colspan="2">
                                    <input type="button" class="button" value="Save" onclick="e_addquestion(<?php echo $_GET['aid'] ?>)" style="width: 70px;" />
                                    <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                                </td>
                            </tr>  
                            <tr>
                            <td style="width: 150px; vertical-align: top;">Rating</td>
                            <td><input type="text" id="rate" style="width: 150px" value="<?php  echo  $newArray7['rate']; ?>"></td>
                        </tr> 
                        <tr>
                            <td style="width: 150px; vertical-align: top;">Code</td>
                            <td><input type="text" id="code" style="width: 150px" value="<?php  echo  $newArray7['code']; ?>"></td>
                        </tr> 	
                        <tr>
                            <td style="width: 150px; vertical-align: top;">From</td>
                            <td><input type="text" id="from" style="width: 150px" value="<?php  echo  $newArray7['r_from']; ?>"></td>
                        </tr> 
                       <tr>
                            <td style="width: 150px; vertical-align: top;">To</td>
                            <td><input type="text" id="to" style="width: 150px" value="<?php  echo  $newArray7['r_to']; ?>"></td>
                        </tr> 
													
                        </table>
                    <?php }
                } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Create" onclick="addquestion()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr> 
                        <tr>
                            <td style="width: 150px; vertical-align: top;">Rating</td>
                            <td><input type="text" id="rate" style="width: 150px"></td>
                        </tr> 
                        <tr>
                            <td style="width: 150px; vertical-align: top;">Code</td>
                            <td><input type="text" id="code" style="width: 150px"></td>
                        </tr> 	
                        <tr>
                            <td style="width: 150px; vertical-align: top;">From</td>
                            <td><input type="text" id="from" style="width: 150px"></td>
                        </tr> 
                       <tr>
                            <td style="width: 150px; vertical-align: top;">To</td>
                            <td><input type="text" id="to" style="width: 150px"></td>
                        </tr> 						
                    </table>
                    <?php
                }
            } elseif ($igen_a_m == "a_m_view") {
                $sql_result7 = mysql_query("SELECT * FROM performance_appraisal WHERE id=" . $_GET['view_id'] . ";");
                $newArray7 = mysql_fetch_array($sql_result7);
                ?>
                <table>
                    <tr>
                        <td style="width: 150px; vertical-align: top;">Question</td>
                        <td><textarea id="e_question" style="width: 250px;"><?php echo $newArray7['question'] ?></textarea></td>
                    </tr>  
                </table>
            <?php } ?>
        </div>
    </div>
    <br/><br/>
	   
    <div class="header_text">
        <span>Rating List</span>
        <span style="float: right;">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <table>
                    <tr>
                        <td><input type="hidden" class="button" value="Print" onclick="print()" style="width: 70px;" /></td>
                    </tr>
                </table>
            <?php } ?>
        </span>
    </div>
	          
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                       
                        <th style="width:30px">No.</th>
                        <th>Rating </th>
						<th>Code</th>
						<th>Range </th>
						
                        <th class="aligncentertable" style="width:100px">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM rating';
                $rs = mysql_query($sql);

                $count = 1;
                while ($row = mysql_fetch_array($rs)) {
                    $pa_id = $row['id'];
                    echo '<tr class="plugintr">';

                    echo'<td>' . $count . '</td>
                         <td>' . $row['rate'] . '</td>
						  <td>' . $row['code'] . '</td>
						  <td>' . $row['r_from'] ." - " .$row['r_to']. '</td>';
						  
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a style="color:blue;cursor:pointer;text-decoration:none;" onclick="edit_func(' . $pa_id . ')">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="javascript:void()" onclick="del(' . $pa_id . ')">Delete</a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a style="color:blue;cursor:pointer;text-decoration:none;" onclick="view(' . $pa_id . ')">View</a></td>';
                    }
                    echo '</tr>';
                    $count++;
                }
                ?>  
            </table>
        </div>
    </div>

</p></div></div></div>

<script type="text/javascript">
    function view(id){
        window.location="?loc=performance_appraisal&view_id=" + id;
    }
    function clearNew(){
        window.location='?loc=performance_appraisal';
    }
    function addquestion(){
        var rate = $('#rate').val();
		var code = $('#code').val();
		var from = $('#from').val();
		var to = $('#to').val();
     
        if(rate == "" || rate== " "){
            alert("Please Insert Rate");
        }else if(code == "" || code== " "){
            alert("Please Insert Code");
        }else if(from == "" || from== " "){
            alert("Please Insert Range From");
        }else if(to == "" || to== " "){
            alert("Please Insert Range to");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addappraisal",
                data:{
                    rate:rate,
					code:code,
					r_from:from,
				    to:to,
					action:'r'
                },
                success:function(data){
		        
                    if(data==true){
                        alert("Rating Added");
                        window.location='?loc=rating';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    function cancelPW(){
	$("#passwordPop").hide();
	$("#forms").show(); 
	//location.reload();
	}
    function del(occid1){

        var result = confirm("Are you sure you want to delete this record?");
      
        if(result){
            $.ajax({
                type:'POST',
                url:'?widget=del_appraisal',
                data:{
                    occid1:occid1,
					action:'f'
                },
                success:function(data){
			
                    if(data==true){
                        alert('Form Deleted');
                        window.location='?loc=performance_appraisal';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    
    function checked_func(id){
        $.ajax({
            type:"POST",
            url:"?widget=check_appraisal",
            data:{
                id:id
            },
            success:function(data){
            
            }
        })
    }

    function edit_func(id){
	
        window.location = "?loc=rating&aid=" + id;
		
    }
function creategroup(){ 


        var group = $('#group').val();
        
        if(group == "" || group == " "){
            alert("Please Insert Question Group");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addappraisal",
                data:{
                    group:group,
                    action:"g"
                },
                success:function(data){
				
                    if(data==true){
                        alert("Please Proceed to key in Questions");
                        $("#forms").show();
						$("#passwordPop").hide();
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
    function e_addquestion(id){ 
        var question = $('#question').val();
	
	
        var rate = $('#rate').val();
		var code = $('#code').val();
		var from = $('#from').val();
		var to = $('#to').val();
     
        if(rate == "" || rate== " "){
            alert("Please Insert Rate");
        }else if(code == "" || code== " "){
            alert("Please Insert Code");
        }else if(from == "" || from== " "){
            alert("Please Insert Range From");
        }else if(to == "" || to== " "){
            alert("Please Insert Range to");
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=editappraisal",
                data:{
                   rate:rate,
					code:code,
					r_from:from,
				    to:to,
					r_id:id,
					action:'r'
                },
                success:function(data){
			
                    if(data==true){
                        alert("Rating Updated");
                        window.location='?loc=rating';
                    }else{
                        alert('Error While Processing');
                    }
                }
            });
        }
    }
	
    
    function print(){
        window.open("?widget=print_appraisal");
    }
</script>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>