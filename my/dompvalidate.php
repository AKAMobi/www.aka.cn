<?
require_once( "header.inc.php" );

if ( (!isset($HTTP_POST_VARS['Name'])) || 
	(!isset($HTTP_POST_VARS['Password'])) ||
	(!isset($HTTP_POST_VARS['validateCode'])) ){
?>
<br>
<br>
<br>
<br>
<br>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
  <td align="center" >
	<p>�û�������֤�����<A HREF="mpvalidate.php">�ֻ���֤ҳ��</a>��</p>
	<br>
	<br>
	<br>
	<br>
<?
	require_once( "footer.inc.php" );
	exit(0);
}
?>
<table width="760" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="550" height="224" valign="top"> 
      <center>
      <table width="500" cellspacing="0" cellpadding="0">
        <tr>
            <td> 
              <p><b><font color="#3366CC"><br>
                ��ǰλ�ã�</font> </b><a href="/" class="a5">������ҳ</a> <font color="#458DE4">&gt; 
                </font><a href="/my" class="a5">�ҵİ���</a><font color="#458DE4">&gt;
                </font><a href="mpvalidate.php" class="a5">�ֻ���֤</a>
                <br>
            </td>
        </tr>
      </table>
<?

$result=mysql_query("select A.ID, A.Password, B.* from User_TB as A, UserValidate_TB as B where B.UserAutoID=A.AutoID and A.ID='{$HTTP_POST_VARS['Name']}' and B.validated='N'");

if (!($row=mysql_fetch_array($result))){//��ID������

?>
	<br>
	<br>
	<br>
	<br>
	<br>
��ID�����ڻ�δ�򿪶���ע�Ṧ�ܣ�<BR>
<input type="button" value="����" onclick="history.back();">
	<br>
	<br>
<?
}
else{
if (strcmp($HTTP_POST_VARS['Password'],$row["Password"])){//�������
?>
	<br>
	<br>
	<br>
	<br>
	<br>
�������<BR>
<input type="button" value="����" onclick="history.back();">
	<br>
	<br>
<?

} else {
if (strcmp($HTTP_POST_VARS['validateCode'],$row["ValidationCode"])){//��֤�����
?>
        <br>
        <br>
        <br>
        <br>
        <br>
��֤�����<BR>
<input type="button" value="����" onclick="history.back();">
        <br>
        <br>
<?
} else {
	$query=array();
	$query[]="begin";
	$query[]="update User_TB set Status='Normal' where ID='{$_REQUEST['Name']}'";
	$query[]="update UserValidate_TB set validated='Y' where UserAutoID='{$row['UserAutoID']}'";
	$query[]="insert into UserAccount_TB(UserAutoID, UserAccount,UserAccountUSD,AccountEnable) values ({$row['UserAutoID']},0,0,'N')";
	$query[]="insert into UserActive_TB(UserAutoID,LastActiveTime) values ({$row['UserAutoID']},now())";
	$query[]="commit";
	$success=true;
for ($i=0;$i<count($query);++$i){
	if (!mysql_query($query[$i])){
		$success=false;
		mysql_query('rollback');
		break;
	}
}
if (!$success){
?>
	<br>
	<br>
	<br>
	<br>
	<br>
���Ŀ�����֤�����ύʧ�ܡ�<BR>
�뷵�����³����ύ��
����������ɣ���ֱ����������ϵ��<br>
<input type="button" value="����" onclick="history.back();">
	<br>
	<br>
<?
} else {
?>
<br>
<br>
������֤�ɹ�<BR>
�����ڿ�������<a class="a6" href="/my">��½</a>ʹ��AKA�ĸ������    <br>
	<br>
<?
}
}
}
}
?>
</center>
    </td>
    <td width="210" height="224" bgcolor="F0FAFF" valign="top">&nbsp;
      <table width="210" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="120">&nbsp;</td>
        </tr>
        <tr> 
          <td>
            <table width="210" cellspacing="8" cellpadding="3">
              <tr> 
                <td bgcolor="C3D4F4" colspan="2"><b><font face="Arial, Helvetica, sans-serif" color="032B7A">�������</font></b></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../serv_prod/index.shtml" class="a6">��Ʒ�����</a></td>
              </tr>
              <tr> 
                <td width="27"> 
                  <div align="right"><img src="../image/leadarrow.gif" width="5" height="10"></div>
                </td>
                <td><a href="../customer/index.shtml" class="a6">�ͻ�����</a></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
</table>
<?
require_once( "footer.inc.php" ) ;
?>