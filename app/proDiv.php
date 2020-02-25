<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="pluginDiv" style="padding-bottom: 5px;">
    <div id="editModePRO" style="padding: 8px 10px 10px 10px;width:97%;border:solid;border-color:lightgrey;">
        <?php
        $sql = 'SELECT DISTINCT ep.id AS ep_id, p.id,p.property_name, p.specification, p.serial_no, pc.name
                                        FROM employee_property AS ep
                                        INNER JOIN
                                        property AS p
                                        ON ep.property_id = p.id
                                        JOIN property_category AS pc
                                        ON pc.id = p.category_id
                                        WHERE ep.emp_id =' . $_GET['viewId'];
        $sqlGetProperty = mysql_query($sql);
        ?>
        <?php if ($igen_a_hr == "a_hr_edit") { ?>
            <div style="padding-bottom: 5px;"><input class="button" type="button" value="Add" onclick="loadPopupBox()"/></div>
        <?php } ?>
        <table id="propertyTable" class="TFtable" style="width:100%">
            <thead>
                <tr class="pluginth">
                    <th style="width: 30px;">No.</th>
                    <th style="width: 300px;">Property Category</th>
                    <th style="width: 300px;">Property Name</th>
                    <th style="width: 200px;">Serial No.</th>
                    <th class="aligncenter" style="width: 150px;">Action</th>
                </tr>
            </thead>
            <?php
            $num = 0;
            while ($rowGetProperty = mysql_fetch_array($sqlGetProperty)) {
                $num = $num + 1;
                $mouseover = 'class="cursor_pointer" onMouseover="emp_app_pro(' . $rowGetProperty['ep_id'] . ')" onMouseout="emp_app_pro_hide()"';

                echo '<tr class="plugintr">
                    <td>' . $num . '</td>
                    <td ' . $mouseover . '>' . $rowGetProperty['name'] . '</td>
                    <td ' . $mouseover . '>' . $rowGetProperty['property_name'] . '</td>
                    <td>' . $rowGetProperty['serial_no'] . '</td>
                    <td class="aligncenter"><a onclick="returnPro(' . $rowGetProperty['id'] . ')" style="cursor:pointer">Return</a></td>
                    </tr>';
            }
            ?>
        </table>
    </div>
    <div style="color: blue; padding: 5px;">* Mouse over <span style="font-weight: bold;">Property Category & Property Name</span> to see more details *</div>
</div>
<div class="popupss"></div>

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
    function emp_app_pro(id){ 
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
                action:"admin_pro"
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
    
    function emp_app_pro_hide(){
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