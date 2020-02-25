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
            <input class='button' type='button' value='Confirm' onclick='selectBen("<?php echo $getID ?>")' id='buttonPro' style='width:90px' />
        </div>
        <input id="popupBoxClose" class="cursor_pointer" style="float:right;width:25px;text-align:center;font-weight: bold;color: dimgrey;" type="button" value="X" onclick="popup_box_close(this)" />
        <table cellpadding="0" cellspacing="0" style="margin-left: 10px;width:97%;">
            <tr class="tableth">
                <th style='text-align: center;'>Select</th>
                <th style='text-align: left;'>Benefits Name</th>
                <th style='text-align: left;'>Description</th>
            </tr>
            <?php
			
            $queryPro = mysql_query("SELECT * FROM benefits");
            while ($row = mysql_fetch_array($queryPro)) {
				$queryProperty = mysql_query('SELECT benefits_id from employee_benefits where benefits_id="'.$row['id'].'" AND emp_id='.$getID);
				$rowProperty = mysql_fetch_array($queryProperty);
				$checked="";
				if($row['id']==$rowProperty['benefits_id']){
					$checked="checked";
				}
                echo "<tr class='tabletr'>
                                    <td style='text-align: center;'><input type='checkbox' name='checkPro' value='" . $row['id'] . "'".$checked."/></td>
                                    <td style='text-align: left;'>" . $row['name'] . "</td>
                                    <td style='text-align: left;'>" . $row['description'] . "</td>
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
    function selectBen(id)
    {
		
       // var checkBoxPro = "<?php echo $pid ?>"; //1. get the stored property from database

        var check2 = $("input[name=checkPro]:checked").map(function(){ return this.value; }).get().join(","); //2. the checked property
     
        if(check2 != '')
        {
           // checkBoxPro =check2; //3. plus together and send to widget
            $.ajax({
                type:'POST',
                url: '?widget=benefitsrefresh',
                data:{
                    id:id,
                    checkBoxPro:check2
                },
                success: function(data) {
                    if(data!=false){
                        alert("Benifits have given")
                        $('#editModeBen').empty().append(data);

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
            alert('Please Select Benefits');
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