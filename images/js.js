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
 
 
 
 
//intFlag: 1 ---- ����û����  2 ---- ����û���պ��� 0 ---- �����ձ�����ȫ
//����ֵ��true ---- ���ںϷ� false ---- ���ڲ��Ϸ�
function fnCheckDate(strDate,intFlag)
{
 var strCheckDate = strDate + "";     //��һ��ȷ�������жϵĿ϶���һ���ַ���
 
 if(strCheckDate == "")        //���ַ���,���ǺϷ��������ַ���������false
 {
  return false;
 } 
 
 //�жϴ����������������ָ�ʽд������
 var intIndex = -1;         //����������ʽ�������ַ������Ƿ����ĳ���ַ���û�ҵ�Ϊ-1,����Ϊ ��0 - String.length - 1��
 var arrDate;          //�ֱ�洢������
 var regExpInfo = /\./;        //������ʽ��ƥ���һ������ "."��λ��
 
 //�������֮���Բ�ʹ��replace���������е�"."��"/"����"-",Ȼ��ֱ�洢�����գ�����Ϊ�û��п������� 2001/3-2,���жϲ������ǲ��Ϸ�������
 intIndex = strCheckDate.search(regExpInfo);   //�����Ƿ��� "."
 if(intIndex == - 1)         //������  
 {
  regExpInfo = /-/;
  intIndex = strCheckDate.search(regExpInfo);
  
  if(intIndex == -1)
  {
   regExpInfo = /\//;       //�����Ƿ��� "/"
   intIndex = strCheckDate.search(regExpInfo); 
   
   if(intIndex == -1)
   {
    arrDate = new Array(strCheckDate);  //ֻ������
   }
   else
   {
    arrDate = strCheckDate.split("/");  //2001/3/7 ��
   }
  }
  else
  {
   arrDate = strCheckDate.split("-");   //2001-3-7 ��
  }
 }
 else
 {
  arrDate = strCheckDate.split(".");    //2001.3.7 ��
 }
 
 if(arrDate.length > 3)        //���������������3�����������ջ��������ģ����Ϸ����ڣ�����false
 {
  return false;
 }
 else if(arrDate.length > 0) 
 {
  //�ж����Ƿ�Ϸ�
  if(fnIsIntNum(arrDate[0]))   //��������
  {
   if(parseInt(arrDate[0]) < 1 || parseInt(arrDate[0]) > 9999)  //�귶ΧΪ1 - 9999
   {
    return false;
   } 
  }
  else
  {
   return false;     //�겻��������������
  }
   
  //�ж����Ƿ�Ϸ�
  if(arrDate.length > 1)
  {
   if(fnIsIntNum(arrDate[1]))  //��������
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
  else //û����
  {
   if(intFlag != 2)    //���������
   {
    return false;
   }
  }
   
  //�ж����Ƿ�Ϸ�
  if(arrDate.length > 2)
  {
   if(fnIsIntNum(arrDate[2]))  //��������
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
   if(intFlag == 0)    //���������
   {
    return false;
   }
  }
 }
 return true;
}

//�ж�һ�����Ƿ�Ϊ������
//������strNum ---- ��Ҫ�жϵ��ַ���
//����ֵ��true ---- ���� false ---- ������
function fnIsIntNum(strNum)
{
 var strCheckNum = strNum + "";
 if(strCheckNum.length < 1)         //���ַ���
  return false;
 else if(isNaN(strCheckNum))         //������ֵ
  return false;
 else if(parseInt(strCheckNum) < 1)       //��������
  return false; 
 else if(parseFloat(strCheckNum) > parseInt(strCheckNum)) //�������� 
  return false;
 
 return true;
}

//**********************************************************************************************************
//���ܣ��ж�intYear��intMonth�µ�����
//����ֵ��intYear��intMonth�µ�����
function fnComputerDay(intYear,intMonth)
{
    var dtmDate = new Date(intYear,intMonth,-1);
    var intDay = dtmDate.getDate() + 1;
    
    return intDay;    
}

//*********************************** //���ܣ�ȥ���ַ���ǰ��ո�
//����ֵ��ȥ���ո����ַ���
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