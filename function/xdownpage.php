<?php

/** dexter@l42.us
** php��ҳ��
** ֻ���ṩ��¼������ÿҳ��ʾ������������
** ����ָ��URL�������ɳ������ɡ��������ڼ��������ҳ��
** ����GET�����ύ
**/

class Pager{
//��ַ����ַ
var $url;
//��¼������
var $countall; // mysql_num....get 
//��ҳ��
var $page;
//��ҳ��������
var $thestr;
//��ҳ����һҳ����
var $backstr;
//βҳ����һҳ����
var $nextstr;
//��ǰҳ��
var $pg;
//ÿҳ��ʾ��¼���� // like 10
var $countlist;
//��ҳ��ʽ
var $style;
//���캯����ʵ���������ʱ���Զ�ִ�иú���
function Pager($countall,$countlist,$style="page"){
    //��¼����ÿҳ��ʾ����������ʱ��ҳ��ȡ����1
    $this->countall = $countall;
    $this->countlist = $countlist;
    $this->style=$style;
    if ($this->countall%$this->countlist!=0){
        $this->page=sprintf("%d",$this->countall/$this->countlist)+1;
    }else{
        $this->page=$this->countall/$this->countlist;
    }

    $this->pg=$_GET["pg"];    
    //��֤pg��δָ���������Ϊ�ӵ�1ҳ��ʼ
    if (!ereg("^[1-9][0-9]*$",$this->pg) || empty($this->pg)){
        $this->pg=1;
    }
    //ҳ�볬�����Χ��ȡ���ֵ
    if ($this->pg>$this->page){
        $this->pg=$this->page;
    }    
    //�õ���ǰ��URL������ʵ���뿴��ײ��ĺ���ʵ��
    $this->url = Pager::getUrl();
    //�滻�����ʽ��ҳ��Ϊ��ȷҳ��    
    if(isset($_GET["pg"]) && $_GET["pg"]!=$this->pg){            
        $this->url=str_replace("?pg=".$_GET["pg"],"?pg=$this->pg",$this->url);
        $this->url=str_replace("&pg=".$_GET["pg"],"&pg=$this->pg",$this->url);
    }    
    //����12345��������ʽ�ķ�ҳ��
    if ($this->page<=10){
        for ($i=1;$i<$this->page+1;$i++){
            $this->thestr=$this->thestr.Pager::makepg($i,$this->pg);
        }
    }else{
        if ($this->pg<=5){
            for ($i=1;$i<10;$i++){
                $this->thestr=$this->thestr.Pager::makepg($i,$this->pg);
            }
        }else{
        if (6+$this->pg<=$this->page){
            for ($i=$this->pg-4;$i<$this->pg+6;$i++){
                $this->thestr=$this->thestr.Pager::makepg($i,$this->pg); 
            }
        }else{
            for ($i=$this->pg-4;$i<$this->page+1;$i++){
                $this->thestr=$this->thestr.Pager::makepg($i,$this->pg);
            }

        }
    }
}
//������ҳ��ҳ����������
$this->backstr = Pager::gotoback($this->pg);
$this->nextstr = Pager::gotonext($this->pg,$this->page);
//echo (" ��".$this->countall." ��,ÿҳ".$this->countlist."������".$this->page."ҳ".$this->backstr.$this->thestr.$this->nextstr);
}
//�������ַ�ҳ�ĸ�������
function makepg($i,$pg){
    if ($i==$pg){
        return " <font style='font-size:10px;' class='".$this->style."'>".$i."&nbsp;</font>";
    }else{
        return " <a style='TEXT-DECORATION: none;color:blue;' href=".Pager::replacepg($this->url,5,$i)." class='".$this->style."'>[".$i."]&nbsp;</a>";
    }
}
//������һҳ����Ϣ�ĺ���
function gotoback($pg){
    if ($pg-1>0){
        return $this->gotoback=" <a style='' href=".Pager::replacepg($this->url,3,0)." class='".$this->style."'>��ҳ</a> <a style='color:blue;' href=".Pager::replacepg($this->url,2,0)." class='".$this->style."'>��һҳ</a>";
    }else{
        return $this->gotoback="<span class='".$this->style."'>��&nbsp;ҳ ��һҳ</span> ";
    }
}
//������һҳ����Ϣ�ĺ���
function gotonext($pg,$page){
    if ($pg < $page){
        return " <a style='color:blue;' href=".Pager::replacepg($this->url,1,0)." class='".$this->style."'>��һҳ</a> <a href=".Pager::replacepg($this->url,4,0)." class='".$this->style."'>βҳ</a>";
    }else{
        return " <span class='".$this->style."'>��һҳ β&nbsp;&nbsp;ҳ</span>";
    }
}
//����url��$pg�ķ���,�����Զ�����pg=x
function replacepg($url,$flag,$i){
    if ($flag == 1){ 
        $temp_pg = $this->pg;
        return str_replace("pg=".$temp_pg,"pg=".($this->pg+1),$url);
    }else if($flag == 2) {
        $temp_pg = $this->pg;
        return str_replace("pg=".$temp_pg,"pg=".($this->pg-1),$url);
    }else if($flag == 3) {
        $temp_pg = $this->pg;
        return str_replace("pg=".$temp_pg,"pg=1",$url);
    }else if($flag == 4){
        $temp_pg = $this->pg;
        return str_replace("pg=".$temp_pg,"pg=".$this->page,$url);
    }else if($flag == 5){
        $temp_pg = $this->pg;
        return str_replace("pg=".$temp_pg,"pg=".$i,$url);
    }else{
        return $url;
    }
}
//��õ�ǰURL�ķ���
function getUrl(){ 
    $url="http://".$_SERVER["HTTP_HOST"]; 
    if(isset($_SERVER["REQUEST_URI"])){ 
        $url.=$_SERVER["REQUEST_URI"]; 
    }else{ 
        $url.=$_SERVER["PHP_SELF"]; 
        if(!empty($_SERVER["QUERY_STRING"])){ 
            $url.="?".$_SERVER["QUERY_STRING"]; 
        } 
    } 
    //�ڵ�ǰ��URL�����pg=x����
    if (!ereg("(pg=|PG=|pG=|Pg=)", $url)){
        if (!strpos($url,"?")){
        $url = $url."?pg=1";
        }else{
            $url = $url."&pg=1";
        }
    } 
    return $url; 
    } 
}
?>

