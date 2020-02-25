<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */


//ok

?>

<div class="main_div">
   	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Shift Maintenance</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <?php if ($igen_a_m == "a_m_edit") { ?>
        <div class="header_text">
            <span>Shift Maintenance</span>
        </div>
        <div class="main_content">
            <div id="container" class="tablediv">
                <form>
                    <?php
                    if (isset($_GET['id']) == true) {
                        $sql1 = "SELECT * FROM shift s where id=" . $_GET['id'] . ";";
                        $sql_result1 = mysql_query($sql1);
                        $row1 = mysql_fetch_array($sql_result1);
                    }
					$total_hours=array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24);
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <?php
                                if (isset($_GET['id']) == true) {
                                    ?>
                                    <input type="button" class="button" value="Save" onclick="update_func(<?php echo $_GET["id"] ?>)" style="width: 70px;"/>
                                    <input type="reset" class="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
                                    <?php
                                } else {
                                    ?>
                                    <input type="button" class="button" value="Add" onclick="save_func()" style="width: 70px;"/>
                                    <input type="reset" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                                    <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:200px;">Shift Name</td>
                            <td><input type="text" class="input_text" id="department_name" style="width: 250px;" value="<?php echo $row1["name"]; ?>" /></td>
                        </tr>
						 <tr>
						 
                            <td style="width:200px;">Total Working Hours</td>
                            <td>
								<select name="hours" id="shift_t_hours">
									<option value="0">-None-</option>
									<?php
									foreach($total_hours as $val){
										$selected="";
										if($val==$row1["total_hours"]){
											$selected="selected";
										}
										echo '<option value="'.$val.'"'.$selected.'>'.$val.'</option>';
									}
									?>
								</select>
							</td>
                        </tr>
                        <tr>
                            <td style="width:200px; vertical-align: top;">Shift Description</td>
                            <td><textarea id="department_description" style="width: 250px; height: 100px;"><?php echo $row1["description"]; ?></textarea></td>
                        </tr>
                    </table>
                    <?php
                    if (isset($_GET['id']) == true) {
                        include_once "app/shift_time_table_24.php";
                    }
                    ?>
                </form>
            </div>
        </div>
        <br/><br/>
        <?php
    } elseif ($igen_a_m == "a_m_view") {
        $sql1 = "SELECT * FROM shift s where id=" . $_GET['view_id'] . ";";
        $sql_result1 = mysql_query($sql1);
        $row1 = mysql_fetch_array($sql_result1);
        ?>
        <div class="header_text">
            <span>Shift Maintenance</span>
        </div>
        <div class="main_content">
            <div id="container" class="tablediv">
                <table>
                    <?php if (isset($_GET['view_id']) == true) { ?>
                        <tr>
                            <td colspan="2">
                                <input type="reset" class="button" value="Back" onclick="clearNew()" style="width: 70px;"/>
                            </td>
                        <tr>
                        <?php } ?>
                        <td style="width:200px;">Shift Name</td>
                        <td><input type="text" class="input_text" id="department_name" style="width: 250px;" value="<?php echo $row1["name"]; ?>" readonly="readonly" /></td>
                    </tr>
					
                    <tr>
                        <td style="width:200px; vertical-align: top;">Shift Description</td>
                        <td><textarea id="department_description" style="width: 250px; height: 100px;" readonly="readonly"><?php echo $row1["description"]; ?></textarea></td>
                    </tr>
                </table>
                <?php
                if (isset($_GET['view_id']) == true) {
                    include_once "app/shift_time_table_24.php";
                }
                ?>
            </div>
        </div>
        <br/><br/>
        <?php
    }
    if (isset($_GET['id']) != true && isset($_GET['view_id']) != true) {
        ?>
        <div class="header_text">
            <span>Shift List</span>
        </div>
        <div class="main_content">
            <div class="plugindiv">
                <table id="tablecolor" class="TFtable">
                    <thead>
                        <tr class="pluginth">
                            <th style="width: 30px;">No.</th>
                            <th>Shift Name</th>
							<th>Total Working Hours</th>
                            <th style="width: 400px;">Description</th>
                            <th style="width: 150px;" class="aligncentertable">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM shift s";
                    $rs = mysql_query($sql);
                    $i = 1;
                    while ($row = mysql_fetch_array($rs)) {
                        echo "<tr class='plugintr'>";
                        echo "<td>";
                        echo $i;
                        echo "</td>";
                        echo "<td>";
                        echo $row["name"];
                        echo "</td>";
						  echo "<td>";
                        echo $row["total_hours"];
                        echo "</td>";
                        echo "<td>";
                        echo substr($row["description"], 0, 60) . '...';
                        echo "</td>";
                        if ($igen_a_m == "a_m_edit") {
                            echo "<td class='aligncentertable'>";
                            echo "<a title='Edit' href='javascript:edit(" . $row["id"] . ")'><i class='far fa-edit' style='color:#000;'></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title='Delete' href='javascript:del(" . $row["id"] . ")'><i class='fas fa-trash-alt' style='color:#000;'></i></a>";
                            echo "</td>";
                        } elseif ($igen_a_m == "a_m_view") {
                            echo "<td class='aligncentertable'>";
                            echo "<a title='View' href='javascript:view(" . $row["id"] . ")'><i class='far fa-eye' aria-hidden='true'></i></a>";
                            echo "</td>";
                        }
                        echo "</tr>";
                        ++$i;
                    }
					
                    ?>
                </table>
            </div>
        </div>
        <?php
    }
    ?>
</p></div></div></div>
<script type="text/javascript">
    function view(id){
        window.location="?loc=shift&view_id=" + id;
    }
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    });
    function update_func(id){
        var shift_name = document.getElementById('department_name').value;
        var shift_description = document.getElementById('department_description').value;
		var total_hours = $("#shift_t_hours").val();
	
        var from1_h="";
        var from1_m="";
        var time1_f="";
        var to1_h="";
        var to1_m="";
        var time1_t="";
        var from2_h="";
        var from2_m="";
        var time2_f="";
        var to2_h="";
        var to2_m="";
        var time2_t="";
                
        var str = "";
		
        $("#time_table tr:gt(0)").each(function(index){
            //alert(index + ":" + $(this).text())
            from1_h=$(this).find("[id^=from1_h]").val();
            from1_m=$(this).find("[id^=from1_m]").val();
            time1_f=$(this).find("[id^=time1_f]").val();
			
            //to1_h=$(this).find("[id^=to1_h]").val();
            //to1_m=$(this).find("[id^=to1_m]").val();
            time1_t=$(this).find("[id^=time1_t]").val();
			
            //from2_h=$(this).find("[id^=from2_h]").val();
            //from2_m=$(this).find("[id^=from2_m]").val();
            time2_f=$(this).find("[id^=time2_f]").val();
			
            to2_h=$(this).find("[id^=to2_h]").val();
            to2_m=$(this).find("[id^=to2_m]").val();
            time2_t=$(this).find("[id^=time2_t]").val();
			
            str = str + from1_h+":"+from1_m+" "+";"+to2_h+":"+to2_m+" "+";";
		    /*str = str + from1_h+":"+from1_m+" "+";"+to2_h+":"+to2_m+" "+";"
			     +to1_h + ":"+to1_m +":" + ";"+from2_h +":"+from2_m+";";*/
                
				
        });
		str = str.substring(0,str.length - 1);
        
        if(shift_name == '' || shift_name == ' '){
            alert("Please Insert Shift Name");
        }else if(total_hours == '' || total_hours == '0'){
            alert("Please Insert Total Working Hours");
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=updateshift",
                data:{
                    shift_name:shift_name,
                    shift_description:shift_description,
                    id:id,
					total_hours:total_hours,
                    str:str
                },
                success:function(data){
                    if(data == true){
                        alert("Shift Updated");
                        window.location='?loc=shift';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })    
        }
    }
    function searchHead_func(){
        // When site loaded, load the Popupbox First
        loadPopupBox();
	
        $('#popupBoxClose').click(function(){
            unloadPopupBox();
        });
    };
    function loadPopupBox() {	// To Load the Popupbox
        $('#popup_box').fadeIn("slow");
        $("#container").css({ // this is just for style
            "opacity": "0.6"
        });
    }
    function e_searchHead_func(){
        // When site loaded, load the Popupbox First
        e_loadPopupBox();
        $('#e_popupBoxClose').click( function() {			
            e_unloadPopupBox();
        });
    };
    function e_loadPopupBox() {	// To Load the Popupbox
        $('#e_popup_box').fadeIn("slow");
        $("#container").css({ // this is just for style
            "opacity": "0.6"
        });
    }
    function unloadPopupBox() {	// TO Unload the Popupbox
        $('#popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }	
    function e_unloadPopupBox() {	// TO Unload the Popupbox
        $('#e_popup_box').fadeOut("slow");
        $("#container").css({ // this is just for style		
            "opacity": "1"  
        }); 
    }	
    function clearNew(){
        window.location="?loc=shift";
    }
    function edit(id){
        window.location = "?loc=shift&id=" + id;
    }

    function search(){
        $('#search_box').toggle('slow');
    }

    function search_func(){
        var name = document.getElementById("search_name").value;
        window.location="?loc=department&name=" + name;
    }

    function save_func(){
        var shift_name = document.getElementById('department_name').value;
        var shift_description = document.getElementById('department_description').value;
        
        if(shift_name == '' || shift_name == ' '){
            alert("Please Insert Shift Name");
        }else{
            $.ajax({
                type:"POST",
                url:"?widget=addshift",
                data:{
                    shift_name:shift_name,
                    shift_description:shift_description
                },
                success:function(data){
                    if(data == true){
                        alert("Shift Added");
                        window.location='?loc=shift';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
    }
    
    function del(id){
        var result = confirm("Are you sure you want to delete this record?");
        if(result){
            $.ajax({
                type:"POST",
                url:"?widget=del_shift",
                data:{
                    id:id
                },
                success:function(data){
                    if(data == true){
                        alert("Shift Deleted");
                        window.location = '?loc=shift';
                    }else{
                        alert("Error While Proccessing");
                    }
                }
            })
        }
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