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
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Import PCB</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body">
		<p>
    <div class="header_text">
        <span>Import PCB Data</span>
        <span style="float: right;">
            <table>
                <tr>
                    <td><input type="button" value="Back" class="button" onclick="back()" style="width: 70px;" /></td>
                </tr>
            </table>
        </span>
    </div>
    <div style="margin-top: 10px;" class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td style="font-weight: bold;">
                        Update PCB table via import excel file 
                        <?php
                        if (isset($_GET["m"]) && ($_GET["m"] == "done")) {
                            ?>
                            <span style='color:#D10202'>PCB Table Uploaded Successfully</span>
                            <?php
                        } else if (isset($_GET["m"]) && ($_GET["m"] == "error")) {
                            ?>
                            <span style='color:#D10202'>PCB Table Upload Failed</span>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding-top: 10px;">
                        <form action="?widget=importpcb" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td style="width: 100px;">Excel file</td>
                                    <td>
                                        <input type="file" name="excel_file" />
                                    </td>
                                    <td><input class="button" type="submit" value="Import" style="width: 70px; position: relative; top: -2px;" />&nbsp;</td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <br/>
    <div class="header_text">
        <span>Download Excel File Template</span>
    </div>
    <div style="margin-top:10px" class="main_content">
        <div class="tablediv">
            <table>
                <tr>
                    <td>
                        <form action="?widget=importpcb" method="post" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td style="width: 100px;">Excel file</td>
                                    <td>
                                        <a href="reporting/excel_writer.php?t=export_pcb">
                                            <img src='images/excel_icon.png' style="border:0" />
                                        </a>
                                    </td>
                                    <td>
                                        <a href="reporting/excel_writer.php?t=export_pcb">Download Here&nbsp;</a>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <br/>
</div></div></div>

<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>