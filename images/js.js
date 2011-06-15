// Guu 
// l42.us 
// JavaScript Document
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


  function openScript(url,urlTitle,width, height,iScrollbars){
  var iTop=(window.screen.height-height)/2;
  var iLeft=(window.screen.width-width)/2;
  var Win = window.open(url,urlTitle,'left='+iLeft+',top='+iTop+',width=' + width + ',height=' + height + ',resizable=no,scrollbars='+iScrollbars+',location=no,menubar=no,status=no' );
 }
 
 
 
 
//intFlag: 1 ---- 可以没有日  2 ---- 可以没有日和月 0 ---- 年月日必须齐全
//返回值：true ---- 日期合法 false ---- 日期不合法
function fnCheckDate(strDate,intFlag)
{
 var strCheckDate = strDate + "";     //进一步确认哪来判断的肯定是一串字符串
 
 if(strCheckDate == "")        //空字符串,不是合法的日期字符串，返回false
 {
  return false;
 } 
 
 //判断传进来的数据是那种格式写成日期
 var intIndex = -1;         //利用正则表达式，查找字符串中是否包含某个字符，没找到为-1,否则为 （0 - String.length - 1）
 var arrDate;          //分别存储年月日
 var regExpInfo = /\./;        //正则表达式，匹配第一个出现 "."的位置
 
 //在这里，我之所以不使用replace函数把所有的"."和"/"换成"-",然后分别存储年月日，是因为用户有可能输入 2001/3-2,就判断不出它是不合法日期了
 intIndex = strCheckDate.search(regExpInfo);   //查找是否含有 "."
 if(intIndex == - 1)         //不包含  
 {
  regExpInfo = /-/;
  intIndex = strCheckDate.search(regExpInfo);
  
  if(intIndex == -1)
  {
   regExpInfo = /\//;       //查找是否含有 "/"
   intIndex = strCheckDate.search(regExpInfo); 
   
   if(intIndex == -1)
   {
    arrDate = new Array(strCheckDate);  //只包含年
   }
   else
   {
    arrDate = strCheckDate.split("/");  //2001/3/7 型
   }
  }
  else
  {
   arrDate = strCheckDate.split("-");   //2001-3-7 型
  }
 }
 else
 {
  arrDate = strCheckDate.split(".");    //2001.3.7 型
 }
 
 if(arrDate.length > 3)        //如果分离出来的项超过3，除了年月日还有其它的，不合法日期，返回false
 {
  return false;
 }
 else if(arrDate.length > 0) 
 {
  //判断年是否合法
  if(fnIsIntNum(arrDate[0]))   //是正整数
  {
   if(parseInt(arrDate[0]) < 1 || parseInt(arrDate[0]) > 9999)  //年范围为1 - 9999
   {
    return false;
   } 
  }
  else
  {
   return false;     //年不是正整数，错误
  }
   
  //判断月是否合法
  if(arrDate.length > 1)
  {
   if(fnIsIntNum(arrDate[1]))  //是正整数
   {
    if(parseInt(arrDate[1]) < 1 || parseInt(arrDate[1]) > 12)
    {
     return false;
    } 
   }
   else
   {
    return false;
   }
  }
  else //没有月
  {
   if(intFlag != 2)    //必须得有月
   {
    return false;
   }
  }
   
  //判断日是否合法
  if(arrDate.length > 2)
  {
   if(fnIsIntNum(arrDate[2]))  //是正整数
   {
    var intDayCount = fnComputerDay(parseInt(arrDate[0]),parseInt(arrDate[1]));
    if(intDayCount < parseInt(arrDate[2]))
    {
     return false;
    }   
   }
   else
   {
    return false;
   }
  }
  else
  {
   if(intFlag == 0)    //必须得有日
   {
    return false;
   }
  }
 }
 return true;
}

//判断一个数是否为正整数
//参数：strNum ---- 需要判断的字符串
//返回值：true ---- 整数 false ---- 非整数
function fnIsIntNum(strNum)
{
 var strCheckNum = strNum + "";
 if(strCheckNum.length < 1)         //空字符串
  return false;
 else if(isNaN(strCheckNum))         //不是数值
  return false;
 else if(parseInt(strCheckNum) < 1)       //不是正数
  return false; 
 else if(parseFloat(strCheckNum) > parseInt(strCheckNum)) //不是整数 
  return false;
 
 return true;
}

//**********************************************************************************************************
//功能：判断intYear年intMonth月的天数
//返回值：intYear年intMonth月的天数
function fnComputerDay(intYear,intMonth)
{
    var dtmDate = new Date(intYear,intMonth,-1);
    var intDay = dtmDate.getDate() + 1;
    
    return intDay;    
}

//*********************************** //功能：去掉字符串前后空格
//返回值：去掉空格后的字符串
function fnRemoveBrank(strSource)
{
 return strSource.replace(/^\s*/,').replace(/\s*$/,');
}
//////////////////////////////////////////////////////////////////////////////////

function isNumberString (InString,RefString)
{
  if(InString.length==0) return (false);
  for (Count=0; Count < InString.length; Count++)
  {
	TempChar= InString.substring (Count, Count+1);
	if (RefString.indexOf (TempChar, 0)==-1)  
	  return (false);
  }
  return (true);
}


function changeUrl(f_url)
{
  window.location.href=f_url;
}


function strcmp ( str1, str2 ) {

    return ( ( str1 == str2 ) ? 0 : ( ( str1 > str2 ) ? 1 : -1 ) );
}

function strlen (string) {
   
    var str = string+'';
    var i = 0, chr = '', lgth = 0;
 
    if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] ||
            this.php_js.ini['unicode.semantics'].local_value.toLowerCase() !== 'on') {
        return string.length;
    }
 
    var getWholeChar = function (str, i) {
        var code = str.charCodeAt(i);
        var next = '', prev = '';
        if (0xD800 <= code && code <= 0xDBFF) { // High surrogate (could change last hex to 0xDB7F to treat high private surrogates as single characters)
            if (str.length <= (i+1))  {
                throw 'High surrogate without following low surrogate';
            }
            next = str.charCodeAt(i+1);
            if (0xDC00 > next || next > 0xDFFF) {
                throw 'High surrogate without following low surrogate';
            }
            return str.charAt(i)+str.charAt(i+1);
        } else if (0xDC00 <= code && code <= 0xDFFF) { // Low surrogate
            if (i === 0) {
                throw 'Low surrogate without preceding high surrogate';
            }
            prev = str.charCodeAt(i-1);
            if (0xD800 > prev || prev > 0xDBFF) { //(could change last hex to 0xDB7F to treat high private surrogates as single characters)
                throw 'Low surrogate without preceding high surrogate';
            }
            return false; // We can pass over low surrogates now as the second component in a pair which we have already processed
        }
        return str.charAt(i);
    };
 
    for (i=0, lgth=0; i < str.length; i++) {
        if ((chr = getWholeChar(str, i)) === false) {
            continue;
        } // Adapt this line at the top of any loop, passing in the whole string and the current iteration and returning a variable to represent the individual character; purpose is to treat the first part of a surrogate pair as the whole character and then ignore the second part
        lgth++;
    }
    return lgth;
}