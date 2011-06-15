// JavaScript Document
function showsubmenu(sid)
{
  whichEl = eval("submenu" + sid);
  if (whichEl.style.display == "none")
  {
    eval("submenu" + sid + ".style.display=\"\";");
  }
  else
  {
    eval("submenu" + sid + ".style.display=\"none\";");
  }
}

var jjj="none";
function allzk(m)
{
  for(var j=0;j<m;j++)
  {
    eval("submenu" + j + ".style.display=\""+jjj+"\";");
  }
  if(jjj=="none")
  {
    jjj="";
    kkk.src="images/00.gif";
  }
  else
  {
    jjj="none";
    kkk.src="images/11.gif";
  }
}
