<?php 
$db = mysql_connect("localhost", "root", "zaq1@WSX");
if(!mysql_select_db("igen", $db)){
    print mysql_error();
}
$input=$_REQUEST['input'];
$input= mysql_real_escape_string(trim($input));

$sql="SELECT DISTINCT email FROM   employee WHERE email LIKE 'justin@myigen.com%' AND emp_status !='Inactive'  ORDER BY email ";
$data=mysql_query($sql);
$arrent=-1;
$dataArray= array();
while($temp=mysql_fetch_assoc($data)){
foreach($temp as $key=>$value){
$temp[$key] = stripslashes($value);
$arrent++;

}
$dataArray[$arrent]= $temp;
}
$list="<ul class='unorganised'>";
foreach($dataArray as $val){

$list.="<li>".$val['email']."</li>";

}
$list.="</ul>";

echo $list;

?>


