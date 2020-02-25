<!-- Put the following code in your JS file or Head Tags ---->
<!--

function DisplayTime(){
if (!document.all && !document.getElementById)
return
timeElement=document.getElementById? document.getElementById("curTime"): document.all.tick2

var CurrentDate=new Date()
var hours=CurrentDate.getHours()
var minutes=CurrentDate.getMinutes()
var seconds=CurrentDate.getSeconds()
var DayNight="PM"
if (hours<12) DayNight="AM";
if (hours>12) hours=hours-12;
if (hours==0) hours=12;
if (minutes<=9) minutes="0"+minutes;
if (seconds<=9) seconds="0"+seconds;
var currentTime=hours+":"+minutes+":"+seconds+" "+DayNight;
timeElement.innerHTML=currentTime
setTimeout("DisplayTime()",1000)
}
window.onload=DisplayTime


// -->
