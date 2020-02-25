<?php
/* Copyright (c) 2012 iGEN Technology (M) Sdn. Bhd.

  This Software Application is the copyrighted work of iGEN Technology (M) or its suppliers.
  iGEN Technology (M) grants a license agreement to iGEN Technology (M) Sdn Bhd for the use of this Software Application at their office premises.

  This Software Application may not be reproduced, published, distributed, displayed, performed, copied or stored for public or private use in any
  information retrieval system, or transmitted in any form by any mechanical, photographic or electronic process, including electronically or digitally
  on the Internet or World Wide Web, or over any network, or local area network, without written permission of iGEN Technology (M) Sdn. Bhd. */
?>

<style type="text/css">
    .record_div{
        -moz-border-radius: 10px;
        border-radius: 10px;
        border:solid;
        border-color:#E3E3E3;     
    }
</style>
<div id="r">
    <table id="titlebar" class="titleBarTo" style="width:98.5%;">
        <tr>
            <td style="font-size:large;font-weight: bold; ">
                &nbsp;&nbsp; Records
            </td>
        </tr>
    </table>
    <div style="overflow:auto;width:98.5%;min-height: 500px;">
        <div class="record_div">
            <table style="width: 100%;">
                <tr style="cursor:pointer;" onclick="loan(this)">
                    <td id="loan" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="loan_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Loan</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="loanDiv" style="display:none;" >
                            <?php include 'loanDiv.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="property(this)" style="cursor:pointer;">
                    <td id="property" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="property_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Company Asset</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="propertyDiv" style="display:none;" >
                            <?php include 'proDiv.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		<div class="record_div">
            <table style="width: 100%;">
                <tr onclick="benefits(this)" style="cursor:pointer;">
                    <td id="benefits" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="benefits_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Benefits Entitled</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="benefitsDiv" style="display:none;" >
						
                            <?php include 'benefitDiv.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="leave(this)" style="cursor:pointer;">
                    <td id="leave" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="leave_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Leave</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="leaveDiv" style="display:none;" >
                            <?php include 'leaveDiv.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		 <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="revoke(this)" style="cursor:pointer;">
                    <td id="revoke1" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="revoke1_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Revoke Leave</td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="revoke" style="display:none;" >
                            <?php include 'revoke.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		 <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="training(this)" style="cursor:pointer;">
                    <td id="training" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="training_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Training</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="trainingDiv" style="display:none;" >
                            <?php include 'div_training.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		
        <!-- <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="remark(this)" style="cursor:pointer;">
                    <td id="remark" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="remark_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Incident Management</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="remarkDiv" style="display:none;" >
                            <?php //include 'remark.php'; ?>
							 
                        </div>
                    </td>
                </tr>
            </table>
        </div> -->
        <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="claim(this)" style="cursor:pointer;">
                    <td id="l_claim" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="l_claim_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Claim</td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="claimDiv" style="display:none;" >
                            <?php include 'claim.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="advsal(this)" style="cursor:pointer;">
                    <td id="advsal" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="advsal_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Advance Salary</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="advsalDiv" style="display:none;" >
                            <?php include 'adv_salary.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
		<div class="record_div">
            <table style="width: 100%;">
                <tr onclick="commis(this)" style="cursor:pointer;">
                    <td id="advsal1" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="advsal1_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Commission</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="advsalDiv1" style="display:none;" >
                            <?php include 'comission.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="record_div">
            <table style="width: 100%;">
                <tr onclick="allowance(this)" style="cursor:pointer;">
                    <td id="allowance" name="lbltitle" style="font-size: 15px;font-weight: bold;padding-left: 10px;padding-top: 3px;">
                        <img id="allowance_img" src="images/But_DrillIn.png" /><span style="vertical-align: top;">&nbsp;Allowance</span></td>
                </tr>
                <tr>
                    <td style="padding-left:20px;">
                        <div id="allowanceDiv" style="display:none;" >
                            <?php include 'allowance_div.php'; ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
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
