<!DOCTYPE html>
<?php
session_start();

  if (isset($_COOKIE["igen_id"]) == true || $igen_userpermission == "1") {
  
    $is_admin = "1";
    $upload_id = $_COOKIE['igen_id'];
} else {
    $is_admin = "0";
    $upload_id = $_COOKIE['igen_user_id']; 
}


?>
<html>

<head>

	<meta charset='UTF-8'>
	
	<title>Pure CSS Tabbed Areas</title>
	
	<link rel='stylesheet' href='css/style.css'>
	
	<style>
	textarea {
    resize: none;
}
    .tabs {
      position: relative;   
      height: 1350px; /* This part sucks */
      clear: both;
      margin: 0px 0;
	  font-size: 14px;
 
    }
    .tab {
      float: left;
    }
    .tab label {
	 border-left:1px solid #000;
      padding: 10px;  
      margin-left: -1px; 
      position: relative;
      left: 1px; 
	   padding:10px 30px; 
    background-color: #4b4a4a;
    width:1130px;
    
    font-weight: bold;
    color: #f9f7f7;
    font-family:"Arial",sans-serif;
    font-size: 14px;
    }
    .tab [type=radio] {
      display: none;   
    }
    .content {
      position: absolute;
      top: 28px;
      left: 0;
      background: #eee;
      right: 0;
      bottom: 0;
      padding: 20px;
      border: 1px solid #ccc; 
    }
    [type=radio]:checked ~ label {
      background: #eee;
	  color:#000;
      border-bottom: 1px solid white;
      z-index: 2;
    }
    [type=radio]:checked ~ label ~ .content {
      z-index: 1;
    }
	</style>
	
	<script src="js/uploadify/jquery.uploadify.v2.1.4.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="js/uploadify/uploadify.css">
  
  
	<script type="text/javascript">
	
			$(document).ready(function(){

			 $("#date_report").datepicker({
           
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
		$("#date").datepicker({
           
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd-mm-yy'
        });
		
		 $("#datetime").datetimepicker({
 
   dateFormat: "dd-mm-yy",
    timeFormat:  "HH:mm:ss"
});	
$("#date_time").datetimepicker({
 
   dateFormat: "dd-mm-yy",
    timeFormat:  "HH:mm:ss"
});	

 $("#file_upload").uploadify({
            'width'    : 120,
            'auto'     : true,
            'uploader'  : 'js/uploadify/uploadify.swf',
            'script'    : 'js/uploadify/uploadify.php',
            'cancelImg' : 'js/uploadify/cancel.png',
            'folder'    : 'uploads/leave',
			'fileType'     : 'image/*',
           'fileExt' : '*.jpg;*.gif;*.png;*.jpeg', 
            'fileDesc'    : 'Image Files',
            'scriptData'  : {'pid': '<?php echo $upload_id . "_" . date('mdyhms'); ?>'},
            'multi'          :false,
            'onComplete': function(event, queueID, fileObj, reponse, data){
                $("#uploaded_img").show();
                $("#uploaded_img").val('<?php echo $upload_id . "_" . date("mdyhms"); ?>'+fileObj.name);			
            }
        }); 
		
	$(".radio").click(function() {
    if ($(this).is(":checked")) {
        var group = "input:checkbox[name='" + $(this).attr("name") + "']";
        $(group).prop("checked", true);
        $(this).prop("checked", true);
    } else {
        $(this).prop("checked", false);
    }
});


	})
	
	 function message() {
	 
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Continue": function() {
           $( this ).dialog( "close" );
		    window.location = '?loc=incident_record&emp_id=<?php echo $_GET["emp_id"];  ?>';
        },
        Done: function() {
      window.location = '?loc=incident_management&viewId=<?php echo $_GET["emp_id"];  ?>';
        }
      }
    });
  };
	
	function insertData(){
	 

	  var incident_happen = "";
	if ($('#n').is(":checked")) {
      incident_happen=$('#n').val();

    }
	if ($('#yes').is(":checked")) {
      incident_happen=$('#yes').val();

    }
	if ($('#no').is(":checked")) {
      incident_happen=$('#no').val();

    }
	
	 var type = $('#type').val();
        var date_report = $('#date_report').val();
        var name = $('#name').val();
        var added = $('#added').val();
        var emp_id=$("#emp_id").val();
		var date=$("#date").val();
        var datetime=$("#datetime").val();
      
		
        var location = $('#location').val();
		var date_time= $('#date_time ').val();
		var inc_desc=$('#inc_desc').val();
		var dangerous=$('#dangerous').val();
		var uploaded_img = $('#uploaded_img').val();
		
		var error1 = [];
        var error2 = [];
        var error3 = [];
		
		if(type==""){
		error1.push("Type");
		
		}
		if(date_report==""){
		error1.push("Date Report");
		
		}
		if(added==""){
		error1.push("Added By ");
		
		}
		if(date_report==""){
		error1.push("date report");
		
		}
		if(date==""){
		error1.push("Date");
		
		}
		if(location==""){
		error2.push("location");
		
		} 
		if(incident_happen==""){
		error3.push("Incident Happen off site");
		
		}
		if(date_time==""){
		error1.push("Incident Date and Time");
		
		}
		if(datetime==""){
		error1.push("Time Start Work");
		
		}
		if(inc_desc==""){
		error1.push("Incident Description");
		
		}
		if(dangerous==""){
		error2.push("dangerous");
		
		}
		var error_data1 = '';
                for(var i=0; i< error1.length; i++){
                    error_data1 = error_data1 + error1[i] + "; "
                }
                var error_data2 = '';
                for(var i=0; i< error2.length; i++){
                    error_data2 = error_data2 + error2[i] + "; "
                }
                var error_data3 = '';
                for(var i=0; i< error3.length; i++){
                    error_data3 = error_data3 + error3[i] + "; "
                }
              
                var data1 = "";
                var data2 = "";
                var data3 = "";
                if(error1.length > 0){
                    data1 = "Please Insert :\n"+error_data1+"\n\n";
                }
                if(error3.length > 0){
                    data3 = "Please Check :\n"+error_data3+"\n\n";
                }
                if(error2.length > 0){
                    data2 = "Please Select :\n"+error_data2;
                }
               
                if(error1.length > 0 || error2.length > 0 || error3.length > 0){
				 alert(data1 + data2 + data3);
                    
                }else{
				
				
				$.ajax({
                        type:'POST',
                        url:'?widget=addin_detail',
                        data:{
						type :type,
						date_report:date_report,
						name:name,
						added:added,
						date:date,
						datetime:datetime,
						incident_happen:incident_happen,
						location:location,
                        date_time:date_time,
                        inc_desc:inc_desc,
 						dangerous:dangerous,
						uploaded_img:uploaded_img,
						emp_id:emp_id
						
                        },
                        success:function(data){
						if(data==true){
						$( "#dialog-confirm" ).text("Incident detail has been recorded.");
	                      message();
                     }else{
					 alert("Error while processing");
					 }
						
						}
						})
						
				
				
				}
		
	}
	
	function insertData1(){
	 var m_location = $('#m_location').val();
        var G_injuries = $('#G_injuries').val();
        var head = $('#head').val();
        var Neck = $('#Neck').val();
        var emp_id=$("#emp_id").val();
		var upper_limb=$("#upper_limb").val();
        var trunk=$("#trunk").val();
        var lower_limb = $('#lower_limb').val();
        var accident1 = $('#accident1').val();
		var accident2= $('#accident2').val();
		var t_injury=$('#t_injury').val();
		var a_c_injury=$('#a_c_injury').val();
		var a_c_injury1 = $('#a_c_injury1').val();
		var i_desc = $('#i_desc').val();
		
		var error1 = [];
        var error2 = [];
        var error3 = [];
		
		if(m_location==""){
		error2.push("Multiple Location");
		
		}
		if(G_injuries==""){
		error2.push("General Injuries/Poisonings/Diseases");
		
		}
		if(head==""){
		error2.push("Head ");
		
		}
		if(Neck ==""){
		error2.push("Neck");
		
		}
		if(upper_limb==""){
		error2.push("Upper Limb");
		
		}
		if(trunk==""){
		error2.push("Trunk");
		
		} 
		if(lower_limb==""){
		error2.push("Lower Limb");
		
		}
		if(accident1==""){
		error2.push("Type of Accident 1");
		
		}
		if(accident2==""){
		error2.push("Type of Accident 2");
		
		}
		if(t_injury==""){
		error2.push("Type of Injury");
		
		}
		if(a_c_injury==""){
		error2.push("Agent Causing Injury 1");
		
		}
		if(a_c_injury1==""){
		error2.push("Agent Causing Injury 2");
		
		}
		if(i_desc==""){
		error2.push("Injury Description");
		
		}
		
		var error_data1 = '';
                for(var i=0; i< error1.length; i++){
                    error_data1 = error_data1 + error1[i] + "; "
                }
                var error_data2 = '';
                for(var i=0; i< error2.length; i++){
                    error_data2 = error_data2 + error2[i] + "; "
                }
                var error_data3 = '';
                for(var i=0; i< error3.length; i++){
                    error_data3 = error_data3 + error3[i] + "; "
                }
              
                var data1 = "";
                var data2 = "";
                var data3 = "";
                if(error1.length > 0){
                    data1 = "Please Insert :\n"+error_data1+"\n\n";
                }
                if(error3.length > 0){
                    data3 = "Please Check :\n"+error_data3+"\n\n";
                }
                if(error2.length > 0){
                    data2 = "Please Select :\n"+error_data2;
                }
               
                if(error1.length > 0 || error2.length > 0 || error3.length > 0){
				 alert(data1 + data2 + data3);
                    
                }else{
				
				
				$.ajax({
                        type:'POST',
                        url:'?widget=addinjury_detail',
                        data:{
						m_location :m_location,
						G_injuries :G_injuries,
						head:head,
						Neck:Neck,
						upper_limb:upper_limb,
						trunk:trunk,
						lower_limb:lower_limb,
						accident1:accident1,
                        accident2:accident2,
                        t_injury:t_injury,
 						a_c_injury:a_c_injury,
						a_c_injury1:a_c_injury1,
						i_desc:i_desc,
						emp_id:emp_id
						
                        },
                        success:function(data){
							if(data==true){
						$( "#dialog-confirm" ).text("Incident detail has been recorded.");
	                      message();
                     }else{
					 alert("Error while processing");
					 }	if(data==true){
						$( "#dialog-confirm" ).text("Incident detail has been recorded.");
	                      message();
                     }else{
					 alert("Error while processing");
					 }
		
        
						
						}
						})
						
				
				
				}
		
	}
	
	function insertData2(){
	var TreatmentRequired="";
	var OutcomeAccident ="";
	var MedicalCondition ="";
	
	  if ($('#tr').is(":checked")) {
        var tr = $('#tr').val();
		TreatmentRequired+=tr + ", ";
    }
	
	 if ($('#md').is(":checked")) {
        var mt = $('#md').val();
		TreatmentRequired+=mt + ", " ;
    }
	
	 if ($('#h').is(":checked")) {
         var h = $('#h').val();
		 TreatmentRequired+=h + " ," ;
    }
      if ($('#fa').is(":checked")) {
          var fa= $('#fa').val();
		  TreatmentRequired+=fa + "" ;
    }
	
         if ($('#npd').is(":checked")) {
          var npd = $('#npd').val();
		  OutcomeAccident+=npd + ",";
    }
           if ($('#np').is(":checked")) {
          var np=$("#np").val();
		  OutcomeAccident+=np + ",";
    }
        if ($('#d').is(":checked")) {
            var d=$("#d").val();
			OutcomeAccident+=d + "";
    }
	 if ($('#ff').is(":checked")) {
          var ff = $('#ff').val();
		  MedicalCondition+=ff + ",";
    }
	
	if ($('#rd').is(":checked")) {
           var rd = $('#rd').val();
		   MedicalCondition+=rd + ",";
    }
	
	if ($('#md1').is(":checked")) {
         var md1= $('#md1').val();
		 MedicalCondition+=md1 + ",";
    }
	
	if ($('#afw').is(":checked")) {
          var afw= $('#afw').val();
		  MedicalCondition+=afw + "";
    }
	emp_id=$("#emp_id").val();
		
    
        
       
		
	 
		
		
		var error1 = [];
        var error2 = [];
        var error3 = [];
		
	if(TreatmentRequired==""){
		error3.push("Treatment Required");
		
		}	
		
	if(OutcomeAccident==""){
		error3.push(" Outcome Accident ");
		
		}
		if(MedicalCondition==""){
		error3.push("Medical Condition");
		
		}
		
		
		
		var error_data1 = '';
                for(var i=0; i< error1.length; i++){
                    error_data1 = error_data1 + error1[i] + "; "
                }
                var error_data2 = '';
                for(var i=0; i< error2.length; i++){
                    error_data2 = error_data2 + error2[i] + "; "
                }
                var error_data3 = '';
                for(var i=0; i< error3.length; i++){
                    error_data3 = error_data3 + error3[i] + "; "
                }
              
                var data1 = "";
                var data2 = "";
                var data3 = "";
                if(error1.length > 0){
                    data1 = "Please Insert :\n"+error_data1+"\n\n";
                }
                if(error3.length > 0){
                    data3 = "Please Check :\n"+error_data3+"\n\n";
                }
                if(error2.length > 0){
                    data2 = "Please Select :\n"+error_data2;
                }
               
                if(error1.length > 0 || error2.length > 0 || error3.length > 0){
				 alert(data1 + data2 + data3);
                    
                }else{
				
				$.ajax({
                        type:'POST',
                        url:'?widget=injury_management',
                        data:{
						TreatmentRequired:TreatmentRequired,
						OutcomeAccident : OutcomeAccident,
						MedicalCondition:MedicalCondition,
						emp_id:emp_id
                        },
                        success:function(data){
							if(data==true){
						$( "#dialog-confirm" ).text("Incident detail has been recorded.");
	                      message();
                     }else{
					 alert("Error while processing");
					 }
		
        
						
						}
						})
						
				
				
				}
		
	}
	
	/*
    function insertData(){
	alert("h");
	
        var type1 = $('#type1').val();
        var date_report = $('#date_report').val();
        var name = $('#name').val();
        var added = $('#added').val();
        
		var date=$("#date").val();

        var incident_happen = $('.radio').val();
        var location = $('#location').val();
		var date_time= $('#date_time ').val();
		var inc_desc=$('#inc_desc').val();
		var dangerous=$('#dangerous').val();
        alert(type1);
               
        var error1 = [];
        var error2 = [];
        var error3 = [];
		
        
        
       
    }
	*/
	

	</script>
	
</head> 

<body>
<div id="dialog-confirm" style="width:500px" title="">

  
</div>

	<div id="page-wrap">
		<input type="hidden" id="emp_id" value="<?php echo $_GET['emp_id'];?>">
    <div class="tabs">
        <input Style="width:70px; margin-left:550px" onclick="history.back(-1)" type="button" value="Back">
       <div class="tab">
           <input type="radio" id="tab-1" name="tab-group-1" checked>
		
           <label for="tab-1">Incident Details</label> 
           
           <div class="content">
           
			    <fieldset style="width:95%;padding-left: 50px;height:400px; border:1px solid silver">
                        <legend style="font-size: 14px; ">&nbsp;&nbsp;Reported By &nbsp;&nbsp;</legend>
						 <table style="margin-top:5px;">
						    <tr>
                                <td style="padding-top:6px;width:100px">Name<span class="red"> *</span></td></tr><tr>
                                <td style="padding-top:6px;"><input id="name" style="width:250px" type="Text" value="<?php echo $_GET['n']  ?>" /></td>
                            </tr>
						   
                                <tr><td style="padding-top:6px;width:100px">Added By<span class="red"> *</span></td></tr>
                               <tr> <td style="padding-top:6px;"><input id="added" style="width:250px" readonly=true type="Text" value="<?php echo $_SESSION['full_name'];?>" /></td>
                            </tr>
						   </table>
                        <table>
                            <tr>
                                <td style="padding-top:6px;width:100px">Type<span class="red"> *</span></td></tr><tr>
                                <td style="padding-top:6px;">
								<select id='type' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="Unconsciousness">Unconsciousness</option>
                               <option value="Cuts/Bruises">Cuts/Bruises</option>
							    <option value="Rashes">Rashes</option>
                             <option value="Sprains">Sprains</option> 
                             <option value="Burns">Burns</option>
							 <option value="Electrocution">Electrocution</option>
							 
							 
                             </select>
								
                            </tr>
							</table>
							
                            
							<fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Date Reported &nbsp;&nbsp;</legend>
							  <table>
							<tr>
                                <td style="padding-top:6px;"><input id="date_report" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						  
						   <fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Date&nbsp;&nbsp;</legend>
							  <table>
							<tr>
							    <td style="padding-top:6px;width:85px">Date<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="date" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						   
							</fieldset>
							 <fieldset style="width:95%;padding-left: 50px; margin-top:30px; height:500px; border:1px solid silver">
                        <legend style="font-size: 14px; ">&nbsp;&nbsp;Location and Time of incident &nbsp;&nbsp;</legend>
                        <table>
                            <tr>
                                <td style="padding-top:6px;width:200px">Incident Happen off site<span class="red"> *</span></td></tr>
                               <tr> 
							  <td>
							  <input type="checkbox" id="n" class="radio" value="N/A" name="fooby[1][]" /> N/A </td></tr>
                              <tr><td><input type="checkbox" id="yes" class="radio" value="Yes" name="fooby[1][]" /> Yes</td></tr>
                             <tr><td><input type="checkbox" class="radio" id="no" value="No" name="fooby[1][]" /> No
								</td></tr>
								<tr><td style="padding-top:6px;width:100px">Location<span class="red"> *</span></td></tr>
								<tr><td>
								<select id='location' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="Canteen">Canteen</option>
                               <option value="Storeroom">Storeroom</option>
                             <option value="Field">Field</option>
                             < option value="Roof">Roof</option> 
                              <option value="Washroom">Washroom</option></select>
								</td></tr>
                             
							</table>
						
                            
							<fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp; Incident Date and Time &nbsp;&nbsp;</legend>
							  <table>
							  <tr>
                                <td style="padding-top:6px;">Date and Time<span class="red"> *</span></td></tr>
							<tr>
                                <td style="padding-top:6px;"><input id="date_time" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						   <fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Time Start Work&nbsp;&nbsp;</legend>
							  <table>
							<tr>
							    <td style="padding-top:6px;width:85px">Date and Time<span class="red"> *</span></td></tr><tr>
                                <td style="padding-top:6px;"><input id="datetime" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						   <table>
						   <tr>
                    <td style="vertical-align: top;">Add Photo</td></tr><tr>
                    <td>
                        <input id="file_upload" name="file_upload" type="file" multiple="true" style="width:200px" />
                        <input type="text" id="uploaded_img" style="width:250px; display: none;" readonly />
                    </td>
                </tr> 
				<tr><td style="font-size:12px; font-family:Times New Roman Italic">
               Allowed file types: png,gif,jpg,jpeg <td>
				</tr>
				</table>
				
						   
							</fieldset>
							<fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Incident Description&nbsp;&nbsp;</legend>
							  <table>
							
                                <tr><td style="padding-top:0px;"><textarea id="inc_desc"rows="4" cols="50" resize="disabled">
 
                                     </textarea></td></tr>
                               </table>	
                           </fieldset>
                      
					  <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Dangerous Occurrence&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Dangerous Occurrence<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='dangerous' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="Notifiable wherever they occur">Notifiable wherever they occur</option>
                               <option value="Notifiable in relation to mines">Notifiable in relation to mines</option>
							    <option value="Notifiable in relation to mines">Notifiable in relation to mines</option>
                             <option value="Notifiable in relation to quarries">Notifiable in relation to quarries</option>
                             < option value="Notifiable in relation to forestry or agriculture">Notifiable in relation to forestry or agriculture</option>
                             </select></td>
								</tr>
								
                               </table>	
                           </fieldset>
						      <span style="float: left; margin-top:10px">
            <table> 
                <tr>
                    <td><input type="button" value="Save" class="button" onclick="insertData()" style="width: 70px;" /></td>
                    
                </tr>
            </table>
        </span> 					
           </div> 
       </div>
        
       <div class="tab">
           <input type="radio" id="tab-2" name="tab-group-1">
           <label for="tab-2">Injury Details</label>
           
           <div class="content">
               
					  <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:auto; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Body Location of Injury&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Multiple Location<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='m_location' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="[601] Head and Trunk">[601] Head and Trunk</option>
                               <option value="[602] Head and one or more limbs">[602] Head and one or more limbs</option>
							    <option value="[603] Trunk and one of limbs">[603] Trunk and one of limbs</option>
                             <option value="[604] One upper limbs and one lower limb">[604] One upper limbs and one lower limb</option>
                             <option value="[605] More than two limbs">[605] More than two limbs</option>
                             </select></td>
								</tr>
								 <tr>
							    <td style="padding-top:6px;width:85px">General Injuries/Poisonings/Diseases<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='G_injuries' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="[701] Circulatory system in general">[701] Circulatory system in general</option>
                               <option value="[702] Cardiovascular system in general">[702] Cardiovascular system in general</option>
							    <option value="[703] Nervous system in general">[703] Nervous system in general</option>
                             <option value="704] Respiratory system in general">[704] Respiratory system in general</option>
                             <option value="[705] Gastrointestinal system in general">[705] Gastrointestinal system in general</option>
							 
                             </select></td>
								</tr>
								<tr>
							    <td style="padding-top:6px;width:85px">Head<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='head' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[101] Cranium region (including skull, brain, cerebrospinal fluid etc)">[101] Cranium region (including skull, brain, cerebrospinal fluid etc)</option>
                               <option value="[102] Central Nervous System">[102] Central Nervous System</option>
							    <option value="[103] Peripheral Nervous System">[103] Peripheral Nervous System</option>
                             <option value="[104] Scalp and hair">[104] Scalp and hair</option>
                             <option value="[105] Eye (including lens, orbit, optic, nerves etc)">[105] Eye (including lens, orbit, optic, nerves etc)</option>
							 
                             </select></td>
								</tr>
								<tr> 
							    <td style="padding-top:6px;width:85px">Neck<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='Neck' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[201] Neck region (including adjoining muscles, tendon, ligament, synovium, bursa etc)">[201] Neck region (including adjoining muscles, tendon, ligament, synovium, bursa etc)</option>
                               <option value="[202] Throat (including thyriod gland, tonsil, glottis, epiglottis etc)">[202] Throat (including thyriod gland, tonsil, glottis, epiglottis etc)</option>
							    <option value="[203] Cervical vertebra and cervical column">[203] Cervical vertebra and cervical column</option>
                             <option value="[204] Inter vertebral disc of cervical vertebra">[204] Inter vertebral disc of cervical vertebra</option>
                             <option value="[205] Skin and subcutaneous tissues of the neck region">[205] Skin and subcutaneous tissues of the neck region</option>
							 
                             </select></td>
								</tr>
								<tr> 
							    <td style="padding-top:6px;width:85px">Upper Limb<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='upper_limb' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="[401] Shoulder (including shoulder joint)">[401] Shoulder (including shoulder joint)</option>
                               <option value="[402] Clavicle">[402] Clavicle</option>
							    <option value="[403] Scapular">[403] Scapular</option>
                             <option value="[404] Upper arm">[404] Upper arm</option>
                             <option value="[405] Elbow (including elbow joint)">[405] Elbow (including elbow joint)</option>
							 
                             </select></td>
								</tr>
								<tr> 
							    <td style="padding-top:6px;width:85px">Trunk<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='trunk' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[301] Back (including adjoining muscles, tendon, ligament, synovium, bursa etc)">[301] Back (including adjoining muscles, tendon, ligament, synovium, bursa etc)</option>
                               <option value="[302] Spinal bone including spinal column">[302] Spinal bone including spinal column</option>
							    <option value="[303] Inter vertebral disc">[303] Inter vertebral disc</option>
                             <option value="[304] Esophagus">[304] Esophagus</option>
                             <option value="[305] Chest (including ribs, sternum, breast, adjoining muscles, tendon, ligament, synovium, bursa etc)">[305] Chest (including ribs, sternum, breast, adjoining muscles, tendon, ligament, synovium, bursa etc)</option>
							 
                             </select></td>
								</tr>
								<tr> 
							    <td style="padding-top:6px;width:85px">Lower Limb<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='lower_limb' style="width:254px">

                               <option value="" selected="selected">-None-</option>
                               <option value="[501] Hip (including hip joint)">[501] Hip (including hip joint)</option>
                               <option value="[502] Thigh (upper leg)">[502] Thigh (upper leg)</option>
							    <option value="[503] Knee (including knee joint)">[503] Knee (including knee joint)</option>
                             <option value="[504] Leg (lower leg)">[504] Leg (lower leg)</option>
                             <option value="[505] Ankle (including ankle joint)">[505] Ankle (including ankle joint)</option>
							 
                             </select></td>
								</tr>
                               </table>	
                           </fieldset>
						    <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Type of Accident&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Type of Accident 1<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='accident1' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[100] Falls of persons">[100] Falls of persons</option>
                               <option value="[200] Struck by falling objects">[200] Struck by falling objects</option>
							    <option value="[300] Stepping on, striking against or struck by objects including">[300] Stepping on, striking against or struck by objects including</option>
                             <option value="[400] Caught in or between objects">[400] Caught in or between objects</option>
                             <option value="[500] Overexertion or strenuous movements">[500] Overexertion or strenuous movements</option>
                             </select></td>
								</tr>
								 <tr>
							    <td style="padding-top:6px;width:85px">Type of Accident 2<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='accident2' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[210] Slides and caves-ins (earth, rocks, stones, snow)">[210] Slides and caves-ins (earth, rocks, stones, snow)</option>
                               <option value="[220] Collapse (building, walls, scaffolds, ladders)">[220] Collapse (building, walls, scaffolds, ladders)</option>
							    <option value="[230] Struck by falling objects during handling">[230] Struck by falling objects during handling</option>
                             <option value="[240] Struck by falling objects, not elsewhere classified">[240] Struck by falling objects, not elsewhere classified</option>
                             <option value="[500] Overexertion or strenuous movements">[500] Overexertion or strenuous movements</option>
                             </select></td>
								</tr>
                               </table>	
                           </fieldset>
						    <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Type of Injury&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Type of Injury<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='t_injury' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[10] Fractures. Includes simple fractures; Fractures with injuries.">[10] Fractures. Includes simple fractures; Fractures with injuries.</option>
                               <option value="[20] Dislocations. Includes sublaxations and displacements.">[20] Dislocations. Includes sublaxations and displacements.</option>
							    <option value="[25] Sprains and strains.">[25] Sprains and strains.</option>
                             <option value="[30] Concussions and other internal injuries.">[30] Concussions and other internal injuries.</option>
                             <option value="[40] Amputations and enucleations.">[40] Amputations and enucleations.</option>
                             </select></td>
								</tr>
								
                               </table>	
                           </fieldset>
						     <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Agent Causing Injury&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Agent Causing Injury 1<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='a_c_injury' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[100] Machines">[100] Machines</option>
                               <option value="[200] Means of transport and lifting equipment">[200] Means of transport and lifting equipment</option>
							    <option value="[300] Other Equipment">[300] Other Equipment</option>
                             <option value="[320] Furnaces, ovens, kilns">[320] Furnaces, ovens, kilns</option>
							 <option value="[330] Refrigerating plants">[330] Refrigerating plants</option>
							 <option value="[360] Tool, implements and appliances, except electric hand tool">[360] Tool, implements and appliances, except electric hand tool</option>
                             </select></td>
								</tr>
								<tr>
							    <td style="padding-top:6px;width:85px">Agent Causing Injury 2<span class="red"> *</span></td></tr>
                               <tr> <td>
								<select id='a_c_injury1' style="width:auto">

                               <option value="" selected="selected">-None-</option>
                               <option value="[362] Hand tools, not power driven">[362] Hand tools, not power driven</option>
                               <option value="[369] Others">[369] Others</option>
							    <option value="[370] Ladders; mobile ramps">[370] Ladders; mobile ramps</option>
                             <option value="[380] Scaffolding">[380] Scaffolding</option>
							 <option value="[390] Other Equipment, not elsewhere classified">[390] Other Equipment, not elsewhere classified</option>
							 
                             </select></td>
								</tr>
								
                               </table>	
                           </fieldset>
						   <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:auto; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Injury Description&nbsp;&nbsp;</legend>
							  <table>
							   <tr>
							    <td style="padding-top:6px;width:85px">Injury Description<span class="red"> *</span></td></tr>
                              <tr><td style="padding-top:6px;"><textarea id="i_desc"rows="4" cols="50" resize="disabled">
 
                                     </textarea></td></tr>
								
                               </table>	 
                           </fieldset>
               
                   <span style="float: left; margin-top:10px">
            <table> 
                <tr>
                    <td><input type="button" value="Save" class="button" onclick="insertData1()" style="width: 70px;" /></td>
                    
                </tr>
            </table>
        </span> 
           </div> 
       </div>
        
        <div class="tab">
           <input type="radio" id="tab-3" name="tab-group-1">
           <label for="tab-3">Injury Management</label>
         
           <div class="content">
              <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Treatment Required&nbsp;&nbsp;</legend>
							  <table>
							
                                <tr>
                                <td style="padding-top:6px;width:200px">Treatment Required<span class="red"> *</span></td></tr>
                               <tr> 
							  <td>
							  <input type="checkbox" id='tr' value="No Treatmen" name="tr" />No Treatment</td></tr>
                              <tr><td><input type="checkbox" id='fa' value="First Aid" name="fa" /> First Aid</td></tr>
                             <tr><td><input type="checkbox"  id='md'value="Medical Treatment" name="md" /> Medical Treatment
								</td></tr>
								<tr><td><input type="checkbox"  id='h' value="Hospitalization" name="h" /> Hospitalization
								</td></tr>
								
								</td></tr>
                               </table>	
                           </fieldset>
						    <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   <legend style="font-size: 14px; ">&nbsp;&nbsp; Outcome Accident&nbsp;&nbsp;</legend>
							  <table>
							
                                <tr>
                                <td style="padding-top:6px;width:200px">Outcome Accident<span class="red"> *</span></td></tr>
                               <tr> 
							  <td>
							  <input type="checkbox" id='npd' value="Non Permanent Disability" name="npd" /> Non Permanent Disability</td></tr>
                              <tr><td><input type="checkbox" id='np' value="Permanent Disability" name="np" /> Permanent Disability</td></tr>
                             <tr><td><input type="checkbox"  id='d'value="Death" name="d" /> Death
								</td></tr>
								
								
								
                               </table>	
                           </fieldset>
						    <fieldset style="width:98%;padding-left: 15px; margin-top:20px;height:10%; border:1px solid silver">
							   <legend style="font-size: 14px; ">&nbsp;&nbsp; Medical Condition&nbsp;&nbsp;</legend>
							  <table>
							
                                <tr>
                                <td style="padding-top:6px;width:200px">Medical Condition<span class="red"> *</span></td></tr>
                               <tr> 
							  <td>
							  <input type="checkbox" id='ff' value="Fully Fit" name="ff" /> Fully Fit</td></tr>
                              <tr><td><input type="checkbox" id='rd' value="Restricted Duties" name="rd" />  Restricted Duties</td></tr>
                             <tr><td><input type="checkbox"  id='md1'value="Medical Restriction" name="md1" /> Medical Restriction
								</td></tr>
								<tr><td><input type="checkbox"  id='afw'value="Absent From Work" name="afw" />Absent From Work
								</td></tr>
								
								
								
                               </table>	
                           </fieldset>
               
                      <span style="float: left; margin-top:10px">
            <table> 
                <tr>
                    <td><input type="button" value="Save" class="button" onclick="insertData2()" style="width: 70px;" /></td>
                    
                </tr>
            </table>
        </span>
           </div> 
       </div>
    </div>
    

</div>
</body>

</html>