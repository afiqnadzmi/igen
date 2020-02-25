<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div style="padding-bottom: 5px;">
    <div id="tableLeave" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;" class="plugindiv">
        <table id="eloantable" class="TFtable" style="border-collapse: collapse; width: 100%;">
            <thead>
                <tr class="pluginth">
                    <th style="width:10px">No.</th>
                    <th style="width:200px">Type of Loan</th>
                    <th style="width:100px; text-align: right; padding-right: 10px;">Loan Amount(RM)</th>
                    <th style="width:50px">Installment</th>
                    <th style="width:300px">Reason of Loan</th>
                    <th style="width:50px">Status</th>

                </tr>
            </thead>
            <?php
			$num_loan=0;
            $sql = 'SELECT * FROM employee_loan WHERE emp_id=' . $getID;
            $rs = mysql_query($sql);

            while ($row = mysql_fetch_array($rs)) {
                $num_loan = $num_loan + 1;
                $type_of_loan = $row['type_of_loan'];
                $loan_amount = $row['loan_amount'];
                $installment = $row['installment'];
                $reason_for_loan = $row['reason_for_loan'];
                $loan_status = $row['loan_status'];
				$loanid = $row['id'];
				$mouseover = 'class="cursor_pointer" onMouseover="emp_app(' . $loanid . ')" onMouseout="emp_app_hide()"';

                echo'<tr class="plugintr">
                        <td style="width:10px">' . $num_loan . '</td>
						<td style="width:200px"' . $mouseover . '>' . $type_of_loan . '</td>
                        <td style="width:100px; text-align: right; padding-right: 10px;">' . number_format($loan_amount, 2, '.', '') . '</td>
                        <td style="width:50px">' . $installment . '</td>
                        <td style="width:300px">' . $reason_for_loan . '</td>
                        <td style="width:50px">' . $loan_status . '</td>
                    </tr>';
            }
            ?>
        </table>
    </div>
</div>
<div id="popup"></div>
<style type="text/css">
    #popup{
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
function emp_app(id){ 
      
        var doc = $(document).height(); 
        var popup = parseInt($(".plugindiv").height())+parseInt($(".plugindiv").position().top+parseInt($("#popup").height()));
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
                action:"loan"
            },
            success:function(data){
              
                $("#popup").html(data);
            }  
        });   
        $(document).mousemove(function(e){
            $('#popup').show();
            $('#popup').css({
                left:  e.pageX + 20,
                top:   e.pageY + total
            });
        });
    }
    
    function emp_app_hide(){
        $(document).mousemove(function(){
            $('#popup').hide();
        });
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