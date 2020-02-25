<!DOCTYPE html>
<html>

<head>
	<meta charset='UTF-8'>
	
	<title>Pure CSS Tabbed Areas</title>
	
	<link rel='stylesheet' href='css/style.css'>
	
	<style>
    .tabs {
      position: relative;   
      height: 600px; /* This part sucks */
      clear: both;
      margin: 0px 0;
	  font-size: 14px; 
    }
    .tab {
      float: left;
    }
    .tab label {
      background: #eee; 
      padding: 10px; 
      border: 1px solid #ccc; 
      margin-left: -1px; 
      position: relative;
      left: 1px; 
    }
    .tab [type=radio] {
      display: none;   
    }
    .content {
      position: absolute;
      top: 28px;
      left: 0;
      background: white;
      right: 0;
      bottom: 0;
      padding: 20px;
      border: 1px solid #ccc; 
    }
    [type=radio]:checked ~ label {
      background: white;
      border-bottom: 1px solid white;
      z-index: 2;
    }
    [type=radio]:checked ~ label ~ .content {
      z-index: 1;
    }
	</style>
</head>

<body>

	<div id="page-wrap">
		
    <div class="tabs">
        
       <div class="tab">
           <input type="radio" id="tab-1" name="tab-group-1" checked>
           <label for="tab-1">Incident Details</label>
           
           <div class="content">
               
			    <fieldset style="width:90%;padding-left: 50px;height:98%">
                        <legend style="font-size: 14px; ">&nbsp;&nbsp;Reported By &nbsp;&nbsp;</legend>
                        <table>
                            <tr>
                                <td style="padding-top:6px;width:100px">Type<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="Type" style="width:250px" type="Text" value="" /></td>
                            </tr>
							</table>
							
                            
							<fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Date Reported &nbsp;&nbsp;</legend>
							  <table>
							<tr>
                                <td style="padding-top:6px;"><input id="Type" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						   <table style="margin-top:20px;">
						    <tr>
                                <td style="padding-top:6px;width:100px">Name<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="name" style="width:250px" type="Text" value="" /></td>
                            </tr>
						   <tr>
                                <td style="padding-top:6px;width:100px">Added By<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="added" style="width:250px" type="Text" value="" /></td>
                            </tr>
						   </table>
						   <fieldset style="width:90%;padding-left: 15px; margin-top:20px;height:20%">
							   
							 <legend style="font-size: 14px; ">&nbsp;&nbsp;Date&nbsp;&nbsp;</legend>
							  <table>
							<tr>
							    <td style="padding-top:6px;width:85px">Date<span class="red"> *</span></td>
                                <td style="padding-top:6px;"><input id="date" style="width:250px" type="Text" value="" /></td></tr>
                               </table>	
                           </fieldset>
						   
							</fieldset>
                      
													
           </div> 
       </div>
        
       <div class="tab">
           <input type="radio" id="tab-2" name="tab-group-1">
           <label for="tab-2">Injury Details</label>
           
           <div class="content">
               <p>stuffslslslsssss</p>
               
              
           </div> 
       </div>
        
        <div class="tab">
           <input type="radio" id="tab-3" name="tab-group-1">
           <label for="tab-3">Injury Management</label>
         
           <div class="content">
               <p>Stuff for Tab Three</p>
               
               
           </div> 
       </div>
        
    </div>
    
</div>
	
</body>

</html>