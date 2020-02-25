<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<link rel='stylesheet' href='css/style.css'>
	<style>
	textarea {
    resize: none;
}
    .tabs {
      position: relative;   
    
      clear: both;
      margin: 0px 0;
	  font-size: 14px;
 
    }
    .tab {
      float: left;
    }
    .tab label {
	 
		padding: 10px;
		margin-left: -1px;
		position: relative;
		left: 1px;
		padding: 10px 30px;
		background-color: #2b2a2ad1;
		width: 1130px;
		font-weight: bold;
		color: #fff;
		font-family: "Arial",sans-serif;
		font-size: 14px;
		cursor: pointer;
    }
    .tab [type=radio] {
      display: none;   
    }
    .content {
      position: absolute;
      top: 28px;
      left: 0;
      background: #000;
      right: 0;
      bottom: 0;
      padding: 20px;
      border: 1px solid #ccc; 
    }
	
	<?php  
	if(isset($_GET['m'])){
	
	
	?>
    [type=radio]:checked ~ label {
      z-index: 2;
    }
	
	#tab2{
	
	   background: #fff;
	  color:#000;
     
      z-index: 2;
	
	}
	
	
	<?php
	}else{
	?>
	
	  [type=radio]:checked ~ label {
      background: #fff;
	  color:#000;
     
      z-index: 2;
    }
	
	<?php
	}
	?>
   
	</style>
     	 
<body>
<div class="main_div">
		<div class="panel-group" id="accordion">
		<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
						<a href="#collapseone" data-toggle="collapse" data-parent="accordion">Leave & Movement Calendar</a>
					</h4>
				</div>
		</div>
	</div>

    <div id="collapseone" class="panel-collapse collapse in" >
		<div class="panel-body"> 
		
		 <div class="tabs" style=" margin-left:1.8%; margin-top:-3px; padding:0px 0px 50px 0px">
        
       <div class="tab tab1">
           <input type="radio" id="tab-1" name="tab-group-1" checked>
		
           <label for="tab-1" onclick="change(0)">Leave Calendar</label>
           
           </div>
       <div class="tab tab2" >
           <input type="radio" id="tab-2" name="tab-group-1">
           <label for="tab-2" id="tab2" onclick="change(1)">Movement Calendar</label>
           
          
           </div> 
       </div>
		
		
<?php
if(isset($_GET["m"])){

	include("employee_move_clander.php");

}else{

	include("employee_leave_clander.php");
}
?>


</div></div></div>
</body>
         
		</head>
		</html>
<script language="JavaScript" type="text/JavaScript">
	function change(id){
		if(id==1){
		   
         window.open('?loc=leave_calendar&m', '_parent')
		 }else{
		 
		 window.open('?loc=leave_calendar', '_parent')
		 }
		
		
		}
		
		
		</script>