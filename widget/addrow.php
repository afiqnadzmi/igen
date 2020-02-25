<?php
 $query2 = "SELECT * FROM position ORDER BY position_name";
 $rs3 = mysql_query($query2);
while ($row3 = mysql_fetch_array($rs3)) {
 $position_name = $row3['position_name'];
 $pos_id = $row3['id'];
echo '<option  value="' . $pos_id . '">' . $position_name . '</option>';
                                    }
 ?>
                              