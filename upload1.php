<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
 require_once('connectdb.php');
 $qry_admin = "select * from tb_admin where s_id=1";
 $result_admin = mysqli_query($dbcon,$qry_admin);
 if($result_admin){
     $row_admin = mysqli_fetch_array($result_admin,MYSQLI_ASSOC);
     mysqli_free_result($result_admin);
 }
 if ($row_admin['g1_st'] == 1){
    if(isset($_POST['submit'])){
    $temp = explode('.',$_FILES['game1']['name']);
    $new_name  = ($_FILES['game1']['name']);
    $url = 'txt/game1/'.$new_name;    
    if(move_uploaded_file($_FILES['game1']['tmp_name'], $url)){
        $sql =  "UPDATE `tb_login` SET `game1` = '".$new_name."' WHERE `login_id` = '".$_SESSION['login_id']."' ";
        $result = $dbcon->query($sql) or die($dbcon->error);
        if($result){
            $_SESSION['game1'] = $new_name;
            header("Refresh:0; url='loading.php'");
        }
    }
 }else{
     echo 'No';
     header('location: main.php');
 }
}else{
    echo "<script>alert('ขณะนี้ Game 1 ถูกปิดไม่ให้อัพโหลด')</script>";
    header("Refresh:0, url=main.php");
}
?>