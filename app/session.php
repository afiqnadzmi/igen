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
        oTable = $('#tablecolor1').dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers"
        });
        $("#img1").load(function(){
            $("#img1msg").text("");
        })
    } );
</script>

<div class="main_div">
   	<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Session Time Out</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		<p>
    <div class="header_text">
        <span>Set Session Time Out</span>
    </div>
    <div class="main_content">
        <div class="tablediv">
            <?php if ($igen_a_m == "a_m_edit") { ?>
                <?php
                if (isset($_GET['id']) == true) {
                    $company_id = $_GET['id'];

                    $sql = 'SELECT * FROM bank WHERE id=' . $company_id;
                    $rs = mysql_query($sql);
                    $row = mysql_fetch_array($rs);
                    
                    ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Save" onclick="savecompany(<?php echo $company_id ?>)" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                            <td><span></span></td>
                        </tr>   
                        <tr>
                            <td style="width: 200px;">Bank Code</td>
                            <td><input type="text" value="<?php echo $row['code'] ?>" id="company_code" style="width: 250px"/></td>
                           
                        </tr>

                        <tr>
						<td style="vertical-align: top;">Bank Name</td>
						<td> <select style="width:250px;" id="company_name">
                                        <option value="" >--Please Select--</option>
                                        <option value="Affin Bank">Affin Bank</option>
                                        <option value="AmBank">AmBank</option>
                                        <option value="Cimb Bank">Cimb Bank</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="Maybank">Maybank</option>
										<option value="Public Bank">Public Bank</option>
										<option value="RHB Bank">RHB Bank</option>
                                    </select></td>
                            
                               
                        </tr>

                       
                    </table>
                <?php } else { ?>
                    <table>
                        <tr>
                            <td colspan="2">
                                <input type="button" class="button" value="Add" onclick="addcompany()" style="width: 70px;" />
                                <input type="button" class="button" value="Clear" onclick="clearNew()" style="width: 70px;" />
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">Minutes</td>
                            <td><input type="text" id="company_code" style="width: 250px"/></td>
                        </tr>
                      <!--
                        <tr>
						<td style="vertical-align: top;">Bank Name</td>
						<td> <select style="width:250px;" id="company_name">
                                        <option value="" >--Please Select--</option>
                                        <option value="Affin Bank">Affin Bank</option>
                                        <option value="AmBank">AmBank</option>
                                        <option value="Cimb Bank">Cimb Bank</option>
                                        <option value="Hong Leong Bank">Hong Leong Bank</option>
                                        <option value="Maybank">Maybank</option>
										<option value="Public Bank">Public Bank</option>
										<option value="RHB Bank">RHB Bank</option>
                                    </select></td>
                            
                               
                        </tr>
                          -->
                        
                    </table>
                <?php } ?>
                <?php
            }
			?>
        </div>
    </div>
    <br/><br/>
  
</div></div></div>

<script type="text/javascript">

    
    function clearNew(){
        window.location='?loc=bank_management';
    }
    function addcompany()
    {
        var company_code = $('#company_code').val();
       
       
        var error1 = [];
      
        
        if(company_code == '' || company_code == ' '){
            error1.push("Minutes");
        }
        
            var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }   
        var data1 = "";
       
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
 
                
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                type:'POST',
                url:"?widget=addsession",
                data:{
                    
                    company_code:company_code
                   
                    
                },
                success:function(data){
	
				if(data!=1){
				if(data==2){
                        alert("successfully set");
						window.location='?loc=session';
				}else{
						alert("Error While Processing");
						
						}
						}else{
						alert("the bank name is already exist in the database")
						
						}
						
                }
            });
        }
    }
    
    function deletecompany(id){

        var result = confirm("Are you sure you want to delete this record?");
        
        if(result){
            
                $.ajax({
                    type:'POST',
                    url:'?widget=addbank',
                    data:{
                        action:"del",
                        id:id
                    },
                    success:function(data){
					alert(data);
                        if(data==1){
						
                            alert("Bank Deleted");
                            window.location='?loc=bank_management';
                        }else{
                            alert('Error While Processing');
                        }
                    }
                })
            }
        }
    function savecompany(id){
        var company_code = $('#company_code').val();
        var company_name = $('#company_name').val();
       var id=id;
	  
        var error1 = [];
        var error2 = [];
        
        if(company_code == '' || company_code == ' '){
            error1.push("Bank Code");
        }
        if(company_name == '' || company_name == ' '){
            error1.push("Bank Name");
        }
		var error_data1 = '';
        for(var i=0; i< error1.length; i++){
            error_data1 = error_data1 + error1[i] + "; "
        }
        var data1 = "";
        
        if(error1.length > 0){
            data1 = "Please Insert :\n"+error_data1+"\n\n";
        }
                
        if(error1.length > 0){
            alert(data1);
        }else{
            $.ajax({
                dataType:'json',
                type:'POST',
                url:"?widget=addbank",
                data:{
                    action:"edit",
                    company_code:company_code,
                    company_name:company_name,
					id:id
					
                    
                },
                success:function(data){
				
				 
                    if(data == 1){
                        alert("Bank Updated");
                        window.location='?loc=bank_management';
                    }else{
                        alert('Error While Processing');
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