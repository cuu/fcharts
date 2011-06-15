<?php

/** dexter@l42.us
** php分页类
** 只需提供记录总数与每页显示数两个参数。
** 无需指定URL，链接由程序生成。方便用于检索结果分页。
** 采用GET方法提交
**/

class Pager{
//地址栏地址
var $url;
//记录总条数
var $countall; // mysql_num....get 
//总页数
var $page;
//分页数字链接
var $thestr;
//首页、上一页链接
var $backstr;
//尾页、下一页链接
var $nextstr;
//当前页码
var $pg;
//每页显示记录数量 // like 10
var $countlist;
//翻页样式
var $style;
//构造函数，实例化该类的时候自动执行该函数
function Pager($countall,$countlist,$style="page"){
    //记录数与每页显示数不能整队时，页数取余后加1
    $this->countall = $countall;
    $this->countlist = $countlist;
    $this->style=$style;
    if ($this->countall%$this->countlist!=0){
        $this->page=sprintf("%d",$this->countall/$this->countlist)+1;
    }else{
        $this->page=$this->countall/$this->countlist;
    }

    $this->pg=$_GET["pg"];    
    //保证pg在未指定的情况下为从第1页开始
    if (!ereg("^[1-9][0-9]*$",$this->pg) || empty($this->pg)){
        $this->pg=1;
    }
    //页码超出最大范围，取最大值
    if ($this->pg>$this->page){
        $this->pg=$this->page;
    }    
    //得到当前的URL。具体实现请看最底部的函数实体
    $this->url = Pager::getUrl();
    //替换错误格式的页码为正确页码    
    if(isset($_GET["pg"]) && $_GET["pg"]!=$this->pg){            
        $this->url=str_replace("?pg=".$_GET["pg"],"?pg=$this->pg",$this->url);
        $this->url=str_replace("&pg=".$_GET["pg"],"&pg=$this->pg",$this->url);
    }    
    //生成12345等数字形式的分页。
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
//生成上页下页等文字链接
$this->backstr = Pager::gotoback($this->pg);
$this->nextstr = Pager::gotonext($this->pg,$this->page);
//echo (" 共".$this->countall." 条,每页".$this->countlist."条，共".$this->page."页".$this->backstr.$this->thestr.$this->nextstr);
}
//生成数字分页的辅助函数
function makepg($i,$pg){
    if ($i==$pg){
        return " <font style='font-size:10px;' class='".$this->style."'>".$i."&nbsp;</font>";
    }else{
        return " <a style='TEXT-DECORATION: none;color:blue;' href=".Pager::replacepg($this->url,5,$i)." class='".$this->style."'>[".$i."]&nbsp;</a>";
    }
}
//生成上一页等信息的函数
function gotoback($pg){
    if ($pg-1>0){
        return $this->gotoback=" <a style='' href=".Pager::replacepg($this->url,3,0)." class='".$this->style."'>首页</a> <a style='color:blue;' href=".Pager::replacepg($this->url,2,0)." class='".$this->style."'>上一页</a>";
    }else{
        return $this->gotoback="<span class='".$this->style."'>首&nbsp;页 上一页</span> ";
    }
}
//生成下一页等信息的函数
function gotonext($pg,$page){
    if ($pg < $page){
        return " <a style='color:blue;' href=".Pager::replacepg($this->url,1,0)." class='".$this->style."'>下一页</a> <a href=".Pager::replacepg($this->url,4,0)." class='".$this->style."'>尾页</a>";
    }else{
        return " <span class='".$this->style."'>下一页 尾&nbsp;&nbsp;页</span>";
    }
}
//处理url中$pg的方法,用于自动生成pg=x
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
//获得当前URL的方法
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
    //在当前的URL里加入pg=x字样
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

