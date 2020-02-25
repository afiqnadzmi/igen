<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<?php
$user_id = $_COOKIE["igen_user_id"];
$sql1 = "SELECT position_id, dep_id, group_id FROM employee WHERE id=" . $user_id;
$rs1 = mysql_query($sql1);
$row1 = mysql_fetch_array($rs1);
$position_id = $row1["position_id"];
$dep_id = $row1["dep_id"];
$group_id = $row1["group_id"];

$sql2 = "SELECT * FROM approval WHERE
        (dep_id = " . $dep_id . " AND group_id=" . $group_id . ") AND 
        (level_pos_1=" . $position_id
        . " OR level_pos_2=" . $position_id
        . " OR level_pos_3=" . $position_id . " OR superior_1=" . $user_id
        . " OR superior_2=" . $user_id . " OR superior_3=" . $user_id . ")";
$rs2 = mysql_query($sql2);
$row2 = mysql_fetch_array($rs2);

if ($row2["level_pos_1"] == $position_id || $row2["superior_1"] == $user_id) {
    $approval[] = 1;
}else{
    $approval[] = 0;
}
if ($row2["level_pos_2"] == $position_id || $row2["superior_2"] == $user_id) {
    $approval[] = 2;
}else{
    $approval[] = 0;
}
if ($row2["level_pos_3"] == $position_id || $row2["superior_3"] == $user_id) {
    $approval[] = 3;
}else{
    $approval[] = 0;
}

for($i=0; $i<count($approval); $i++){
    $approval_level = $approval_level . $approval[$i] . ',';
}

$sql = "SELECT *,e.id as eid
        FROM employee_movement ec join employee e
	on ec.emp_id=e.id where ec.id=" . $_GET["id"];
$rs = mysql_query($sql);
$row = mysql_fetch_array($rs);
?>
<style>

.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

</style>
<span id="aid" style="display: none;"><?php echo substr($approval_level, 0, -1); ?></span>
<div class="modal"></div>
<div class="main_div">
    <br/>
    <div class="header_text">
        <span>Off Time Approval</span>
        <span style="float: right;">
            <table>
                <tr>
                    <td><input class="button" type="button" onclick="back()" value="Back" style="width:100px" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="2">
                        <input type="button" class="button" value="Approve" onclick="approved(<?php echo $row["eid"] ?>,<?php echo $_GET["id"] ?>)" />
                        <input type="button" class="button" value="Reject" onclick="dissapprove(<?php echo $row["eid"] ?>,<?php echo $_GET["id"] ?>)" />
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">Employee Name</td>
                    <td><?php echo $row["full_name"] ?></td>
                </tr>
                <tr>
                    <td>From Time</td>
                    <td><?php echo $row["from_time"] ?></td>
                </tr>
                <tr>
                    <td>To Time</td>
                    <td><?php echo $row["to_time"] ?></td>
                </tr>
                <tr>
                    <td>Leave Date</td>
                    <td><?php echo $row["leave_date"] ?></td>
                </tr>
                <tr>
                    <td>Reason</td>
                    <td><?php echo $row["reason"] ?></td>
                </tr>
            </table>
        </div> 
    </div>
</div>
<script type="text/javascript">
    function back(){
        window.location = '?loc=dashboard';
    }
    function approved(eid, id){
	
        var aid = $("#aid").html();
		$(".modal").show();
        $.ajax({
         dataType:'json',
            url:"?widget=approve_move",
            data:{
                id:id,
                eid:eid,
                status:"Approved",
                aid:aid
            },
            success:function(data){
		
                if(data.query=="true"){
                    alert('E-Movement Approved');
                    window.location='?loc=dashboard';
                }
                else{
                    alert('Error While Processing');
                }
            }
        });
    }
    function dissapprove(eid, id){
        var aid = $("#aid").html();
        $.ajax({
            dataType:'json',
            url:'?widget=approve_move',
            data:{
                id:id,
                eid:eid,
                status:"Rejected",
                aid:aid
            },
            success:function(data){
                if(data.query=="true"){
                    alert('E-Movement Rejected');
                    window.location='?loc=dashboard';
                }
                else{
                    alert('Error While Processing');
                }
            }
        })
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