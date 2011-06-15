// JavaScript Document
var gdCtrl = new Object();
var gcGray = "#808080";
var gcToggle = "highlight";
var gcBG = "threedface";
var gMonths = new Array("一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月");
var gdCurDate = new Date();
var giYear = gdCurDate.getFullYear();
var giMonth = gdCurDate.getMonth()+1;
var giDay = gdCurDate.getDate();
var sxYear = giYear;
var sxMonth = giMonth;
var sxDay = giDay;
var sxDatestr = gdCtrl.value;
if (sxDatestr != ""){
var sxDate = new Date(sxDatestr);
sxYear = sxDate.getFullYear();
}
var VicPopCal = new Object();
function mouseover(obj){
obj.style.borderTop = 'buttonshadow 1px solid';
obj.style.borderLeft = 'buttonshadow 1px solid';
obj.style.borderRight = 'buttonhighlight 1px solid';
obj.style.borderBottom = 'buttonhighlight 1px solid';
}
function mouseout(obj){
obj.style.borderTop = 'buttonhighlight 1px solid';
obj.style.borderLeft = 'buttonhighlight 1px solid';
obj.style.borderRight = 'buttonshadow 1px solid';
obj.style.borderBottom = 'buttonshadow 1px solid';
}
function mousedown(obj){
obj.style.borderTop = 'buttonshadow 1px solid';
obj.style.borderLeft = 'buttonshadow 1px solid';
obj.style.borderRight = 'buttonhighlight 1px solid';
obj.style.borderBottom = 'buttonhighlight 1px solid';
}
function mouseup(obj){
obj.style.borderTop = 'buttonhighlight 1px solid';
obj.style.borderLeft = 'buttonhighlight 1px solid';
obj.style.borderRight = 'buttonshadow 1px solid';
obj.style.borderBottom = 'buttonshadow 1px solid';
}
function fPopCalendar(popCtrl, dateCtrl, popCal){
VicPopCal = popCal;
gdCtrl = dateCtrl;
fSetYearMon(giYear, giMonth);
var point = fGetXY(popCtrl);
with (VicPopCal.style) {left = point.x;top  = point.y+popCtrl.offsetHeight+1;visibility = 'visible';}
VicPopCal.focus();
}
function fSetDate(iYear, iMonth, iDay){
if ((iYear == 0) && (iMonth == 0) && (iDay == 0)){
gdCtrl.value = "";
}
else{
if (iMonth < 10){iMonth = "0"+iMonth;}
if (iDay < 10){iDay = "0"+iDay;}
gdCtrl.value = iYear+"-"+iMonth+"-"+iDay;
}
VicPopCal.style.visibility = "hidden";
}
function fSetSelected(aCell){
var iOffset = 0;
var iYear = parseInt(document.all.tbSelYear.value);
var iMonth = parseInt(document.all.tbSelMonth.value);
aCell.bgColor = gcBG;
with (aCell.children["cellText"]){
var iDay = parseInt(innerText);
if (color==gcGray){iOffset = (Victor<10)?-1:1;}
iMonth += iOffset;
if (iMonth<1) {	iYear--; iMonth = 12;}else{if (iMonth>12){iYear++;iMonth = 1;}}
}
fSetDate(iYear, iMonth, iDay);
}
function Point(iX, iY){this.x = iX;this.y = iY;}
function fBuildCal(iYear, iMonth){
var aMonth=new Array();
for(i=1;i<7;i++){aMonth[i]=new Array(i);}
var dCalDate=new Date(iYear, iMonth-1, 1);
var iDayOfFirst=dCalDate.getDay();
var iDaysInMonth=new Date(iYear, iMonth, 0).getDate();
var iOffsetLast=new Date(iYear, iMonth-1, 0).getDate()-iDayOfFirst+1;
var iDate = 1;
var iNext = 1;
for (d = 0; d < 7; d++){aMonth[1][d] = (d<iDayOfFirst)?-(iOffsetLast+d):iDate++;}
for (w = 2; w < 7; w++){for (d = 0; d < 7; d++){aMonth[w][d] = (iDate<=iDaysInMonth)?iDate++:-(iNext++);}}
return aMonth;
}
function fDrawCal(iYear, iMonth, iDay, iCellWidth, iDateTextSize) {
var WeekDay = new Array("日","一","二","三","四","五","六");
var styleTD = " bgcolor='"+gcBG+"' width='"+iCellWidth+"' bordercolor='"+gcBG+"' valign='middle' align='center' style='font-size: 12px;background: buttonface;border-top: buttonhighlight 1px solid;border-left: buttonhighlight 1px solid;border-right: buttonshadow 1px solid;	border-bottom: buttonshadow 1px solid;";
with (document) {
write("<tr align='center'>");
for(i=0; i<7; i++){write("<td height='20' "+styleTD+"color:#990099' >" + WeekDay[i] + "</td>");}
write("</tr>");
for (w = 1; w < 7; w++) {
write("<tr align='center'>");
for (d = 0; d < 7; d++) {
write("<td width='10%' height='15' id=calCell "+styleTD+"cursor:hand;' onmouseover='mouseover(this)' onmouseout='mouseout(this)' onmousedown='mousedown(this)' onmouseup='mouseup(this)' onclick='fSetSelected(this)'>");
write("<font style='font-size: 13px;' id=cellText Victor='Liming Weng'> </font>");
write("</td>");
}
write("</tr>");
}
}
}
function fUpdateCal(iYear, iMonth) {
sxYear = iYear;
sxMonth = iMonth;
yeartd1.innerText = sxYear + "年";
monthtd1.innerText = gMonths[sxMonth-1];
myMonth = fBuildCal(iYear, iMonth);
var i = 0;
for (w = 0; w < 6; w++){
for (d = 0; d < 7; d++){
with (cellText[(7*w)+d]) {
Victor = i++;
if (myMonth[w+1][d]<0) {
color = gcGray;
innerText = -myMonth[w+1][d];
}else{
color = ((d==0)||(d==6))?"red":"black";
innerText = myMonth[w+1][d];
}
}
}
}
}
function fSetYearMon(iYear, iMon){
sxYear = iYear;
sxMonth = iMon;
yeartd1.innerText = sxYear + "年";
monthtd1.innerText = gMonths[sxMonth-1];
document.all.tbSelMonth.options[iMon-1].selected = true;
for (i = 0; i < document.all.tbSelYear.length; i++){
if (document.all.tbSelYear.options[i].value == iYear){
document.all.tbSelYear.options[i].selected = true;
}
}
fUpdateCal(iYear, iMon);
}
function fPrevMonth(){
var iMon = document.all.tbSelMonth.value;
var iYear = document.all.tbSelYear.value;
if (--iMon<1) {
iMon = 12;
iYear--;
}
fSetYearMon(iYear, iMon);
}
function fNextMonth(){
var iMon = document.all.tbSelMonth.value;
var iYear = document.all.tbSelYear.value;
if (++iMon>12) {
iMon = 1;
iYear++;
}
fSetYearMon(iYear, iMon);
}
function fGetXY(aTag){
var oTmp = aTag;
var pt = new Point(0,0);
do {
pt.x += oTmp.offsetLeft;
pt.y += oTmp.offsetTop;
oTmp = oTmp.offsetParent;
} while(oTmp.tagName!="BODY");
return pt;
}
with (document){
write("<Div id='PopCal' onclick='event.cancelBubble=true' style='POSITION:absolute; VISIBILITY: hidden; bordercolor:#000000;border:2px ridge;width:10;z-index:100;'>");
write("<iframe frameBorder=0 width=180 scrolling=no height=176></iframe>")
write("<table id='popTable' border='1' bgcolor='#eeede8' cellpadding='0' cellspacing='0' style='font-size:12px;Z-INDEX:202;position:absolute;top:0;left:0;'>");
write("<TR>");
write("<td valign='middle' align='center' style='cursor:default'>");
write("<table width='176' border='0' cellpadding='0' cellspacing='0'>");
write("<tr align='center'>");
write("<td height='22' width='20' name='PrevMonth' style='font-family:\"webdings\";font-size:15px' onClick='fPrevMonth()' onmouseover='this.style.color=\"#ff9900\"' onmouseout='this.style.color=\"\"'>3</td>");
write("<td width='64' id='yeartd1' style='font-size:12px' onmouseover='yeartd1.style.display=\"none\";yeartd2.style.display=\"\";' onmouseout='this.style.background=\"\"'>");
write(sxYear + "年");
write("</td>");
write("<td width='64' id='yeartd2' style='display:none' onmouseout='yeartd2.style.display=\"none\";yeartd1.style.display=\"\";'>");
write("<SELECT style='width:64px;font-size: 12px;font-family: 宋体;' id='tbSelYear' onChange='fUpdateCal(document.all.tbSelYear.value, document.all.tbSelMonth.value);yeartd2.style.display=\"none\";yeartd1.style.display=\"\";' Victor='Won'>");
for(i=1930;i<2015;i++){
write("<OPTION value='"+i+"'>"+i+"年</OPTION>");
}
write("</SELECT>");
write("</td>");
write("<td width='72' id='monthtd1' style='font-size:12px' onmouseover='monthtd1.style.display=\"none\";monthtd2.style.display=\"\";' onmouseout='this.style.background=\"\"'>");
write(gMonths[sxMonth-1]);
write("</td>");
write("<td width='72' id='monthtd2' style='display:none' onmouseout='monthtd2.style.display=\"none\";monthtd1.style.display=\"\";'>");
write("<select style='width:72px;font-size: 12px;font-family: 宋体;' id='tbSelMonth' onChange='fUpdateCal(document.all.tbSelYear.value, document.all.tbSelMonth.value);monthtd2.style.display=\"none\";monthtd1.style.display=\"\";' Victor='Won'>");
for (i=0; i<12; i++){
write("<option value='"+(i+1)+"'>"+gMonths[i]+"</option>");
}
write("</SELECT>");
write("</td>");
write("<td width='20' name='PrevMonth' style='font-family:\"webdings\";font-size:15px' onclick='fNextMonth()' onmouseover='this.style.color=\"#ff9900\"' onmouseout='this.style.color=\"\"'>4</td>");
write("</tr>");
write("</table>");
write("</td></TR><TR><td align='center'>");
write("<DIV style='background-color:teal;'><table width='100%' border='0' bgcolor='threedface' cellpadding='0' cellspacing='0'>");
fDrawCal(giYear, giMonth, giDay, 19, 14);
write("</table></DIV>");
write("</td></TR><TR><TD height='20' align='center' valign='bottom'>");
write("<font style='cursor:hand;font-size:12px' onclick='fSetDate(0,0,0)' onMouseOver='this.style.color=\"#0033FF\"' onMouseOut='this.style.color=0'>清空</font>");
write("&nbsp;&nbsp;&nbsp;&nbsp;");
write("<font style='cursor:hand;font-size:12px' onclick='fSetDate(giYear,giMonth,giDay)' onMouseOver='this.style.color=\"#0033FF\"' onMouseOut='this.style.color=0'>今天: "+giYear+"-"+giMonth+"-"+giDay+"</font>");
write("&nbsp;&nbsp;&nbsp;&nbsp;");
write("<font style='cursor:hand;font-size:12px' onclick='VicPopCal.style.visibility = \"hidden\"' onMouseOver='this.style.color=\"#0033FF\"' onMouseOut='this.style.color=0'>关闭</font>");
write("</TD></TR></TD></TR></TABLE>");
write("</Div>");
}