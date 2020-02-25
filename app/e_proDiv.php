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
        <table id="eprotable" class="TFtable" style="border-collapse: collapse; width: 100%;">
            <?php
			
            $sqlGetProperty = mysql_query('SELECT DISTINCT p.id,p.property_name, p.specification, p.serial_no
                                        FROM employee_property AS ep
                                        INNER JOIN
                                        property AS p
                                        ON ep.property_id = p.id
                                        WHERE ep.emp_id ='.$getID);
            ?>
            <thead>
                <tr class="pluginth">
                    <th style="width: 30px;">No.</th>
                    <th>Name </th>
					
					<th>Serial No</th>
                </tr>
            </thead>
            <?php
            while ($rowGetProperty = mysql_fetch_array($sqlGetProperty)) {
                $i = $i + 1;
                echo '<tr class="plugintr">
                <td>' . $i . '</td>
                <td>' . $rowGetProperty['property_name'] . '</td>
				<td>' . $rowGetProperty['serial_no'] . '</td>
                </tr>';
            }
            ?>
        </table>
    </div>
</div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>