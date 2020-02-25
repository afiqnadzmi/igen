<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<div class="main_div">
   	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Pre-defined Letters</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Pre-defined Letters</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th>Letter Name</th>
                        <th style="width: 100px;" class='aligncentertable'>Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT id, letter_name, letter_desc FROM predefined_letter";
                $sql_result = mysql_query($sql);
                while ($newArray = mysql_fetch_array($sql_result)) {
                    $i = $i + 1;
                    echo"<tr class='plugintr'>
                    <td>" . $i . "</td>
                    <td>" . $newArray['letter_name'] . "</td>";
                    echo "<td class='aligncentertable'><a style='font-size: 10pt;color:blue;' onclick='edit(" . $newArray['id'] . ")'>Generate</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
    <div id="popup"></div>
</p></div></div></div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
    
    function edit(letter_id){
        $.ajax({
            type:'POST',
            url:"?widget=letter_popup",
            data:{
                letter_id:letter_id
            },
            success:function(data){
                if(data != false){
                    $('#popup').append(data);
                }else{
                    alert('Error While Proccessing');
                }
            }
        });
    }
    
    function checkall(chkid,gid){
        if($('#chkall' + gid).is(':checked')){
            $("[name="+chkid+"]").each(function(i,dom){
                $(dom).attr("checked",true);
            })
        }else{
            $("[name="+chkid+"]").each(function(i,dom){
                $(dom).attr("checked",false);
            })
        }
    }
    
</script>
<style>
#popup_box1 {
    position: fixed;
    _position: absolute;
    top: 173px !important;
</style>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>