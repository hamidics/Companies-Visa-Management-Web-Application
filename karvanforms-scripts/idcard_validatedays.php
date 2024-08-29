<?PHP
require_once("../library/db.php");
session_start();
include("check_login.php");
 login();
 $karvan=$_GET['karvanid'];
 $appid=$_GET['resid'];
 $mosquename=$_GET['mosque'];


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<div align='left' style="width:400px; padding-right:10px;padding-top:10px;padding-bottom:10px; background-color:#bffffd"  dir='rtl'>
<div width="10%" align="right">
<?php echo "<form action='idcard_validatedays.php?karvanid=$karvan&resid=$appid&mosque=$mosquename' method='POST'>";?>

مدت اعتبار کارت <input type="radio" name="validdays" value="15" id="validdays" required/>15 روز 
<input type="radio" name="validdays" checked value="30" id="validdays" required/>30 روز 
<input type="radio" name="validdays" value="45" id="validdays" required/>45 روز
</br></br>لطفا طرح کارت را انتخاب کنید:<input type="radio" checked value="idcard2.png" name="cardback" id="cardback"/> آبی
<input type="radio" value="idcard3.png" name="cardback" id="cardback"/> سبز
<input type="radio" value="idcard1.png" name="cardback" id="cardback"/> زرد
</br></br>
 <input type='submit' name='printcard' value='تهیه کارت شناسایی کاروان'/>

</form>
<?php
if(isset($_POST['printcard'])){
header("location:idcard.php?karvanid=$karvan&resid=$appid&mosque=$mosquename&validatedays=$_POST[validdays]&card=$_POST[cardback]");
die();
}
?>
</span>
</div>
</body>