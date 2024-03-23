<?php 
include "config.php";
if(isset($_FILES['fileToUpload'])){
  $errors =array() ;
  $file_name =$_FILES['fileToUpload']['name'];
  $file_size =$_FILES['fileToUpload']['size'];
  $file_temp =$_FILES['fileToUpload']['tmp_name'];
  $file_type =$_FILES['fileToUpload']['type'];
  $file_ext = strtolower(end(explode('.',$file_name)));
  $extensions = array("jpeg","jpg","png");
  if(in_array($file_ext,$extensions)==false){
     $errors[]="Invalid file type , please choose jpeg , jpg or png ";
  }
  if($file_size>2097152){
     $errors[]="file size is too long to upload , choose file of maximum 2MB";
  }
  if(empty($errors)==true){
     move_uploaded_file($file_temp,"upload/".$file_name);
  }else{
     print_r($errors);
     die();
  }
  
}
session_start();
$title =mysqli_real_escape_string($conn,$_POST['post_title']);
$description =mysqli_real_escape_string($conn,$_POST['postdesc']);
$category =mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M, Y");
$author = $_SESSION['user_id'];
$sql ="INSERT INTO post(title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'{$file_name}');";
$sql .="UPDATE category SET post=post+1 WHERE category_id={$category}";
if(mysqli_multi_query($conn,$sql)){
   echo("<script> location.href= '{$hostname}/admin/post.php';</script>");
}else{
   echo "<div class ='alert alert-danger'>Query failed</div>";
}

?>