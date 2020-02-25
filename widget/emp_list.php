<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style>
    .button {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:2px 2px;
        color: white;
        cursor: pointer;
        position: relative;
        top: -6px;
        background-color: blue;
        background-image: url('css/theme_c/BG_Button.png');
        background-repeat: repeat-x;

    }

    .button:hover {
        height: 30px;
        width:70px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        padding:3px 2px;
        background-color:#0099CC;
        color: white;
        cursor: pointer; 

    }
    .tablecolor{
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
        background-color: beige;
        width: 98%;
    }


    .tablecolor table{
        border-collapse: collapse;
        width: 100%;
    }

    .tableth th
    {
        /*    background-color:#F8F8F8;*/
        background-color: darkblue;
        color: white;
        padding: 5px 0 5px 10px;
        text-align: left;
    }
    .tablerow
    {
        background-color: #EBF6FC;
    }
    .tabletr
    {
        /*    background-color:#F8F8F8;*/
        background-color: beige;
        color: black;
    }
    .tabletr td{
        padding-top: 5px;
        padding-bottom: 5px;
        padding-left: 10px;
    }
    a{
        text-decoration: none;
        color:blue; 
    }
    a:hover{
        cursor: pointer;
        text-decoration: underline;
    }
</style>

<div style="padding: 15px 0px 5px 15px;">
    <?php 
	$checkbox="";
        if (isset($_GET["inc"]) == true && ($_GET["inc"] == "emp" || $_GET["inc"] == "sup" || $_GET["inc"] == "pres" || $_GET["inc"] == "wby" || $_GET["inc"] == "rby" || $_GET["inc"] == "review" || $_GET["inc"] == "couns" || $_GET["inc"] == "couns2" || $_GET["inc"] == "couns3")) {
			$checkbox="radio";
		}else{
			$checkbox="checkbox";
			echo'<input type="button"  class="button" value="Select All" onclick="select_all()" style="width: 100px;"/>';
		}
	?>
    <input type="button" class="button" value="Deselect All" onclick="deselect_all()" style="width: 100px;"/>
    <input type="button" class="button" value="Done" onclick="done()" style="width: 100px;"/>
</div>
<div class="tablecolor" style="width: 95%;">
    <table>
        <tr class="tableth">
            <th style="width:50px">ID</th>
            <th>Employee Name</th>
			 <th>department</th>
            <th style="width: 70px;">Select</th>
        </tr>
        <?php
        if (isset($_GET["s"]) == true && $_GET["s"] != "") {
            $status = ' AND emp_status = "' . $_GET["s"] . '"';
        } else {
            $status = '';
        }
		
        $sql = "select e.*, d.dep_name from employee e inner join department d on e.dep_id=d.id inner join position p on e.position_id=p.id";
        if ($_GET['d'] != ""){
            if ($_GET['d'] == "ALL") {
                if($_GET['b'] == "ALL"){
                    $sql .=" ";
                }else{
                        $sql .=" where e.branch_id = " . $_GET['b'];
                }               
            } else {
                $sql .=" where e.dep_id = " . $_GET['d'];
            }
        }
		if($_GET['type']!="0"){
		
		$sql .=" AND e.is_contract ='".$_GET['type']."'";
		
		}
        if($_GET['e']=="Malaysian"){   
            $sql .=" AND e.country ='Malaysia'";
        }else if($_GET['e']=="Foreign"){
            $sql .=" AND e.country !='Malaysia'";
        }else{
            $sql .=" ";
        }
        $sql .=$status;

        echo $sql;

        if ($_GET['list'] != "")
            $idss = explode(",", $_GET['list']);

        $result = mysql_query($sql);
        $i = 1;
        $emp_old_id="0";
        while ($rs = mysql_fetch_array($result)) {
            $emp_old_id.=",".$rs['emp_old_id'];
            foreach ($idss as $id) {
                if ($id == $rs['id'])
                    $checked = "checked";
            }
		  if (!isset($_GET["inc"]) == true && ($_GET["inc"] != "emp" || $_GET["inc"] != "sup" || $_GET["inc"] != "pres" || $_GET["inc"] != "wby" || $_GET["inc"] != "rby" || $_GET["inc"] != "review")) {
				print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td>" . $rs['dep_name'] . "</td><td><input type='".$checkbox."' name='" . $rs['full_name'] . "'class='check' value='" . $rs['id'] . "' $checked></td>";
		    }else{
				print "<tr class='tabletr'><td>EMP" . str_pad($rs['id'],6, "0", STR_PAD_LEFT) . "</td><td>" . $rs['full_name'] . "</td><td>" . $rs['dep_name'] . "</td><td><input type='".$checkbox."' name='employee_name' class='check' value='" . $rs['id'] . "' $checked></td>";
			}
            $checked = "";
        }
        echo"<input id='emp_old_id' type='hidden' value='".$emp_old_id."'>";
        ?>
    </table>
</div>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>

<script type="text/javascript">
    function select_all(){
        $("input").attr("checked",true);
    }
    function deselect_all(){
        $("input").attr("checked",false);
    }
    function done(){
        var ids = new Array();
        var names = new Array();
		var inc="<?php echo $_GET['inc'];?>";
			
		if(inc=="emp" || inc=="sup" || inc=="pres" || inc=="wby" || inc=="rby" || inc=="review" || inc=="couns" || inc=="couns2"|| inc=="couns3"){
			$("input:radio:checked'").each(function(i,dom){
				ids[i] = $(dom).val();
				names[i] = '<option>' + $(dom).attr("name") + '</option>';
			});
		}else{
			$("input:checkbox:checked'").each(function(i,dom){
					ids[i] = $(dom).val();
					names[i] = '<option>' + $(dom).attr("name") + '</option>';
				});
		}

        var newStr = ids.toString();
		
        if(newStr == ""){
            window.close();
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=append_emp",
                data:{
                    newStr:newStr,
                    inc:inc
                },
                success:function(data){
					
                    if(data != false){
						if(inc=="emp"){
							$("#employee_name_ids", opener.window.document).html(newStr);
                            $("#employee_name_view", opener.window.document).empty().append(data);
							employee_detail(newStr);
						}else if(inc=="sup"){
							$("#supervisor_ids", opener.window.document).html(newStr);
							$("#supervisor_incharge", opener.window.document).empty().append(data);
							window.close();
						 }else if(inc=="pres"){
							$("#presponsible_ids", opener.window.document).html(newStr);
							$("#presponsible", opener.window.document).empty().append(data);
							window.close();
						 }else if(inc=="wby"){
							$("#writtenby_ids", opener.window.document).html(newStr);
							$("#writtenby", opener.window.document).empty().append(data);
							employee_detail(newStr, inc);
						 }else if(inc=="lteam"){
							$("#lteam_ids", opener.window.document).html(newStr);
							$("#list_of_team_members", opener.window.document).empty().append(data);
						    window.close();
						 }else if(inc=="rby"){
							$("#reviewed_by_ids", opener.window.document).html(newStr);
							$("#reviewed_by", opener.window.document).empty().append(data);
							employee_detail(newStr, inc);
						 }else if(inc=="review"){
							$("#tag_reviewer_ids", opener.window.document).html(newStr);
							$("#tag_reviewer", opener.window.document).empty().append(data);
						    window.close();
						 }else if(inc=="couns"){
							$("#employee_name_ids", opener.window.document).html(newStr);
							$("#employee_name_view", opener.window.document).empty().append(data);
							employee_detail(newStr, inc);
						 }else if(inc=="couns2"){
							$("#employee_name_ids2", opener.window.document).html(newStr);
							$("#employee_name_view2", opener.window.document).empty().append(data);
							employee_detail(newStr, inc);
						 }else if(inc=="couns3"){
							
							$("#employee_name_ids3", opener.window.document).html(newStr);
							$("#employee_name_view3", opener.window.document).empty().append(data);
							
							employee_detail(newStr, inc);
						 }else if(inc=="qp"){
                           $("#employee_ids", opener.window.document).html($("#emp_old_id").val());
                            $("#employee_list_view", opener.window.document).empty().append(data);
                            window.close();
                         }else{
							$("#employee_ids", opener.window.document).html(newStr);
							$("#employee_list_view", opener.window.document).empty().append(data);
							window.close();
						 }
                    }else{
                        alert('Error While Proccessing');
                    }
                }
            });
        }
    }
	
	function employee_detail(id, inc){
 
		$.ajax({
                dataType:'json',
                url:"?widget=showemployee_detail",
				//dataType: 'json',
               data:{
					id:id
				},
                success:function(data){
					dob = new Date(data.data2);
					var today = new Date();
					var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
					if(inc=="wby"){
						$("#written-by-title", opener.window.document).val(data.data4);
					}else if(inc=="rby"){
						$("#reviewed-title", opener.window.document).val(data.data4);
						$("#written-department", opener.window.document).val(data.data3);
					}else if(inc=="couns"){
						$("#witness_d_name", opener.window.document).val(data.data3);	
						$("#witness_num", opener.window.document).val(pad(data.data7, 6));
						$("#witness_cp", opener.window.document).val(data.data4);
					}else if(inc=="couns2"){	
					
						$("#witness_num2", opener.window.document).val(pad(data.data7, 6));
					}else if(inc=="couns3"){
					
						$("#witness_num3", opener.window.document).val(pad(data.data7, 6));
					}else{
						$("#department", opener.window.document).val(data.data3);	
						$("#age", opener.window.document).val(data.data7);
						$("#job-title", opener.window.document).val(data.data4);
						$("#employee_works", opener.window.document).val(data.data5);
						$("#month_employee", opener.window.document).val(data.data6);
						if(data.data1=="M"){
							$("#male", opener.window.document).prop("checked", true);
						}else if(data.data1=="F"){
							$("#female", opener.window.document).prop("checked", true);
						}
					}
					window.close();					
                    
                } 

            });	
	}
	
	function pad(number, length) {
   
    var str = '' + number;
    while (str.length < length) {
        str = '0' + str;
    }
   
    return "EMP"+str;

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