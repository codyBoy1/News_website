<?php
include "config.php";
if($_SESSION['user_role']=='0'){
   echo("<script> location.href= '{$hostname}/admin/post.php';</script>");
}
$user_id=$_GET['id'];
$sql="DELETE FROM user WHERE user_id={$user_id}";
if(mysqli_query($conn,$sql)){
  /* header("Location: http://0.0.0.0:8080/admin/user.php");*/
  echo("<script> location.href= '{$hostname}/admin/users.php';</script>");
}else{
   echo "<p style='color:red; margin:10px 0; text-align:center;'>unable to delete record</p>";
}
mysql_close($conn);
?>