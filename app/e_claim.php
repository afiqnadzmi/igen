<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div style="padding-bottom: 5px;">
    <div id="tableLeave" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <table id="eclaimtable" style="border-collapse: collapse; width: 100%;" class="TFtable">
            <thead>
                <tr class="pluginth">
                    <th>No.</th>
                    <th>Claim Title</th>
                    <th>Claim Number</th>
                    <th>Insert Date</th>
                    <th>Claim Date</th>
                    <th style='text-align: right; padding-right: 10px;'>Amount (RM)</th>
                    <th>Remark</th>
                </tr>
            </thead>
            <?php
            $sql1 = "SELECT * FROM employee_claim WHERE emp_id = '" . $getID . "'";
            $sql_result1 = mysql_query($sql1);
            while ($newArray = mysql_fetch_array($sql_result1)) {
                $i = $i + 1;
                ?>
                <tr class="plugintr">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $newArray['claim_item_title']; ?></td>
                    <td><?php print $newArray['claim_no'] ?></td>
                    <td><?php print $newArray['insert_date'] ?></td>
                    <td><?php print $newArray['claim_date'] ?></td>
                    <td style='text-align: right; padding-right: 10px;'><?php print number_format($newArray['amount'], 2, '.', '') ?></td>
                    <td><?php print $newArray['remark'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<script language="javascript" type="text/javascript">
    $(function() {
        var pickerOpts = { dateFormat:"yy-mm-dd" };
        $("#claim_date").datepicker(pickerOpts);
    });
                            
    function addclaim(){
        var claim_title=$('#claim_title').val(), claim_number=$('#claim_number').val(), claim_date=$('#claim_date').val(), claim_amount=$('#claim_amount').val(), claim_remark=$('#claim_remark').val();
		var emp=<?php print $employee_id; ?>;
        if(claim_title=='' || claim_title==' '){
            $("#errorAdd").fadeIn(50);
            $("#errorAdd").html('<span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="_12" style="vertical-align:middle;color:red">Please Enter Claim Title.</span>');
            $("#errorAdd").fadeOut(6000);
        }else   if(claim_number=='' || claim_number==' '){
            $("#errorAdd").fadeIn(50);
            $("#errorAdd").html('<span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="_12" style="vertical-align:middle;color:red">Please Enter Claim Number.</span>');
            $("#errorAdd").fadeOut(6000);
        }else{
            $.ajax({
                type:'POST',
                url:'?widget=add_claim',
                data:{
                    claim_title:claim_title,
                    claim_number:claim_number,
                    claim_date:claim_date,
                    claim_amount:claim_amount,
                    claim_remark:claim_remark,
                    id:emp
                },
                success:function(data){
                    if(data!=false){
                        $('#changeDiv2').empty().append(data);

                    }else{
                        $("#errorAdd").fadeIn(50);
                        $("#errorAdd").html('<span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="_12" style="vertical-align:middle;color:red">An Error Occured While Saving. Please Try Again Later.</span>');
                        $("#errorAdd").fadeOut(6000);
                    }
                }
            });
        }
    }
    function delclaim(id){
		var result = confirm('Are you sure you want to delete this record?');
        if(result){
			$.ajax({
				type:'POST',
				url:'?widget=del_claim',
				data:{
					id:id
				},
				success:function(data){
					if(data!=false){
						$('#changeDiv2').empty().append(data);
					}else{
						$("#errorAdd").fadeIn(50);
						$("#errorAdd").html('<span class="i_warning">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="_12" style="vertical-align:middle;color:red">An Error Occured While Saving. Please Try Again Later.</span>');
						$("#errorAdd").fadeOut(6000);
					}
				}
			});
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