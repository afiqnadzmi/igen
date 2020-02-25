<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        oTable = $('#tablecolor').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
    } );
</script>

<div class="main_div">
    </br>
    <div class="header_text">
        <span>Holiday Group by Race Maintenance</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td colspan="2">
                        <input type="button" class="button" value="Add" onclick="addgroup()" style="width: 70px;" />
                        <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;"/>
                    </td>
                </tr>
                <tr>
                    <td style="width: 200px;">Group Name</td>
                    <td><input class="input_text" type="text" id="grp_name" style="width: 250px"/></td>
                </tr>
                <tr>
                    <td>Race</td>
                    <td><!-- <input class="input_text" type="text" id="grp_desc" style="width: 250px"/> -->
                        <select class="input_text" id="dropRace" style="width:250px;">
                            <option value="0">--Please Select--</option>
                            <option value="Chinese">Chinese</option>
                            <option value="Indian">Indian</option>
                            <option value="Malay" selected="selected">Malay</option>
                            <option value="Prebumi">Prebumi</option>
                            <option value="Iban">Iban</option>
                            <option value="Bidayuh">Bidayuh</option>
                            <option value="Melanau">Melanau</option>
                            <option value="Kadazan">Kadazan</option>
                            <option value="Dusun">Dusun</option>
                            <option value="Minokok">Minokok</option>
                            <option value="Dumpas">Dumpas</option>
                            <option value="Senoi">Senoi</option>
                            <option value="Semang">Semang</option>
                            <option value="Foreigner">Foreigner</option>
                        </select>
                    </td>
                </tr>   
            </table>
        </div>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Holiday List</span>
    </div>
    <div class="main_content" style="padding-left: 10px;">
        <?php
        $sql = 'SELECT * FROM public_holiday';
        $rs = mysql_query($sql);
        while ($row = mysql_fetch_array($rs)) {
            $holi_id = $row['id'];
            $holi_name = $row['occasion_name'];
            if ($igen_a_m == "a_m_edit") {
                $sql2 = 'SELECT * FROM holiday_for_group WHERE group_id = ' . $_GET['holi_grp_id'] . ' AND holiday_id = ' . $holi_id . '';
            } elseif ($igen_a_m == "a_m_view") {
                $disabled = 'disabled="disabled"';
                $sql2 = 'SELECT * FROM holiday_for_group WHERE group_id = ' . $_GET['view_id'] . ' AND holiday_id = ' . $holi_id . '';
            }
            $rs2 = mysql_query($sql2);
            if ($rs2 && mysql_num_rows($rs2) > 0) {
                echo '<table><tr><td><input type="checkbox" id="checkid' . $holi_id . '" value="' . $holi_id . '" checked ' . $disabled . '> ' . $holi_name . '</td></tr></table>';
            } else {
                echo '<table><tr><td><input type="checkbox" id="checkid' . $holi_id . '" value="' . $holi_id . '" ' . $disabled . '> ' . $holi_name . '</td></tr></table>';
            }
        }
        ?>
    </div>
    <br/><br/>
    <div class="header_text">
        <span>Holiday Group by Race List</span>
    </div>
    <div class="main_content">
        <div class="plugindiv">
            <table id="tablecolor" class="TFtable">
                <thead>
                    <tr class="pluginth">
                        <th style="width: 30px;">No.</th>
                        <th style="width:150px">Group Name</th>
                        <th>Holiday Group by Race</th>
                        <th class="aligncenter" style="width:100px">Count</th>
                        <th style="width: 100px;" class="aligncentertable">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = 'SELECT * FROM holiday_group';
                $rs = mysql_query($sql);

                while ($row = mysql_fetch_array($rs)) {
                    $i = $i + 1;
                    $group_name = $row['group_name'];
                    $group_desc = $row['group_desc'];
                    $holi_grp_id = $row['id'];
                    $sql2 = 'select * from branch where holi_group_id = ' . $holi_grp_id . '';
                    $rs2 = mysql_query($sql2);
                    $row_count = mysql_num_rows($rs2);
                    $sql3 = 'SELECT * FROM public_holiday';
                    $rs3 = mysql_query($sql3);
                    //$row1 = mysql_fetch_array($rs3);
                    $holi_name = $sql3['occasion_name'];

                    echo'<tr class="plugintr">
                        <td>' . $i . '</td>
                        <td>' . $group_name . '</td>
                        <td>' . $rs3 . '</td>
                        <td class="aligncenter">' . $holi_name . '</td>';
                    if ($igen_a_m == "a_m_edit") {
                        echo '<td class="aligncentertable"><a title="Edit" href="javascript:void()" onclick="edit(' . $holi_grp_id . ')"><i class="far fa-edit" style="color:#000;" ></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a title="Delete" href="javascript:void()" onclick="deleteholiday(' . $holi_grp_id . ',' . $row_count . ')"><i class="fas fa-trash-alt" style="color:#000;"></i></a></td>';
                    } elseif ($igen_a_m == "a_m_view") {
                        echo '<td class="aligncentertable"><a href="javascript:void()" onclick="view(' . $holi_grp_id . ')"><i class="far fa-eye" aria-hidden="true"></i></a></td>';
                    }
                    echo '</tr>';
                }
                ?>  
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    function view(id){
        window.location="?loc=holiday_race_edit&view_id=" + id;
    }

    function edit(id){
        window.location = "?loc=holiday_race_edit&holi_grp_id=" + id;
    }
    
    function clearNew(){
        window.location="?loc=holiday_group_management";
    }
    
    function e_save(id){
		
        var all_id = "";
        var grp_name = $('#e_grp_name').val();
        var grp_desc = $('#e_grp_desc').val();
		 
        jQuery("input[id]:checked").each(function(){all_id += jQuery(this).val()+",";});
		
        var newStr = all_id.substring(0, all_id.length-1);
        var holi_grp_id = id;
       
        var error1 = [];
        
        if(grp_name == "" || grp_name == " "){
            error1.push("Group Name");
        }
        if(grp_desc == "" || grp_desc == " "){
            error1.push("Description");
        }
            
        var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
                
        var data1 = "";
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1;
        }
		
                
        if(error1.length > 0){
            alert(data1);
        }else{
			
            $.ajax({
                type:'POST',
                url:"?widget=editholiday_grp",
                data:{
                    grp_name:grp_name,
                    grp_desc:grp_desc,
                    holi_grp_id:holi_grp_id,
                    newStr:newStr
                },
                success:function(data){
                    if(data==true){
                        alert("Holiday Group Updated");
                        window.location='?loc=holiday_group_management';
                    }else{
                        alert("Error While Processing");
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