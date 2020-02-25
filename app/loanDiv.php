<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="pluginDiv" style="padding-bottom: 5px;">
    <div id="loanDiv" style="width:97%;border:solid;border-color:lightgrey;padding: 8px 10px 10px 10px;">
        <div style="padding-bottom: 5px; display: none;"><input class="button" type="button" value="Edit" onclick="editLoan()"/></div>
        <table border="0" id="loantable" class="TFtable" style="width:100%">
            <thead>
                <tr class="pluginth">
                    <th style="width: 30px;">No.</th>
                    <th style="width: 300px">Loan Type</th>
                    <th class="alignrightable" style="width:150px;">Loan Amount (RM)</th>
                    <th class="alignrightable" style="width:150px">Installment (Month)</th>
                    <th class="alignrightable" style="width:150px">Installment/Month (RM)</th>
                    <th style="width:100px">Status</th>
                </tr>
            </thead>
            <?php
            $sql = 'SELECT * FROM employee_loan WHERE emp_id=' . $getID;
            $rs = mysql_query($sql);
            $num = 0;
            while ($row = mysql_fetch_array($rs)) {
                $num = $num + 1;
                $loan_id = $row['id'];
                $type_of_loan = $row['type_of_loan'];
                $loan_amount = $row['loan_amount'];
                $installment = $row['installment'];
                $reason_for_loan = $row['reason_for_loan'];
                $rep_month = $row['rep_month'];
                $loan_status = $row['loan_status'];

                $mouseover = 'class="cursor_pointer" onMouseover="emp_app_loan(' . $loan_id . ')" onMouseout="emp_app_loan_hide()"';

                echo'<tr class="plugintr">
                        <td>' . $num . '</td>
                        <td ' . $mouseover . '>' . $type_of_loan . '</td>
                        <td class="alignrightable">' . number_format($loan_amount, 2, '.', '') . '</td>
                        <td>' . $rep_month . '</td>
                        <td class="alignrightable">' . number_format($installment, 2, '.', '') . '</td>
                        <td>' . $loan_status . '</td>
                    </tr>';
            }
            ?>
        </table>
    </div>
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Loan Type</span> to see more details *</div>
</div>
<div class="popup"></div>

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
    function emp_app_loan(id){ 
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
                action:"admin_loan"
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
    
    function emp_app_loan_hide(){
        $(document).mousemove(function(){
            $('.popup').hide();
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