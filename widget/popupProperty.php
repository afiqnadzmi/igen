<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div id="popup_box" style="border:10px solid #C4C4C7;">
    <form>
        <?php
        $getID = $_GET['id'];
		
        ?>
        <div style="padding-bottom: 5px; padding-left: 10px;">
            <input class='button' type='button' value='Confirm' onclick='selectPro("<?php echo $getID ?>")' id='buttonPro' style='width:90px' />
        </div>
        <input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="popup_box_close(this)" />
        <table cellpadding="0" cellspacing="0" style="margin-left: 10px;width:97%;">
            <tr class="tableth">
                <th style='text-align: center;'>Select</th>
                <th style='text-align: left;'>Property Name</th>
                <th style='text-align: left;'>Specification</th>
                <th style='text-align: left;'>Stock in Date</th>
            </tr>
            <?php
            $queryPro = mysql_query("SELECT * FROM property WHERE is_active='Y' AND is_occupy = 'N';");

            $pid = "";
            $queryProperty = mysql_query('SELECT p.id,p.property_name FROM employee_property as ep
                                            INNER JOIN property AS p
                                            ON ep.property_id = p.id WHERE ep.emp_id=' . $getID);
            while ($rowProperty = mysql_fetch_array($queryProperty)) {
                $pid.=$rowProperty["id"] . ",";
            }

            while ($row = mysql_fetch_array($queryPro)) {
                echo "<tr class='tabletr'>
                                    <td style='text-align: center;'><input type='checkbox' name='checkPro' value='" . $row['id'] . "' /></td>
                                    <td style='text-align: left;'>" . $row['property_name'] . "</td>
                                    <td style='text-align: left;'>" . $row['specification'] . "</td>
                                    <td style='text-align: left;'>" . $row['stock_in_date'] . "</td>
                                </tr>";
            }
            ?>
        </table>
    </form>
</div>
<script type="text/javascript">
    function popup_box_close(obj){
        $(obj).parent().parent().remove();
    }
    function selectPro(id)
    {
        var checkBoxPro = "<?php echo $pid ?>"; //1. get the stored property from database

        var check2 = $("input[name=checkPro]:checked").map(function(){ return this.value; }).get().join(","); //2. the checked property
       
        if(check2 != '')
        {
            checkBoxPro = checkBoxPro + check2; //3. plus together and send to widget

            $.ajax({
                type:'POST',
                url: '?widget=propertyrefresh',
                data:{
                    id:id,
                    checkBoxPro:checkBoxPro
                },
                success: function(data) {
                    if(data!=false){
                        alert("Property Assigned")
                        $('#editModePRO').empty().append(data);

                    }else{
                        alert('Error While Processing');
                    }
                }

            })
            $('#popup_box').fadeOut("slow");
            $("#container").css({
                "opacity": "1"
            });
        }
        else
        {
            alert('Please Select Property');
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