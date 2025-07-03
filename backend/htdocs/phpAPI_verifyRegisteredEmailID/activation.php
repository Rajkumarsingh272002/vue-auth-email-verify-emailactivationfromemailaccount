<?php
require_once('databaseconfig.php');
$status=1;
if(isset($_GET['token'])){
echo $token=$_GET['token'];
$sql="update emailregis set status=? where token=?";
$stmt=$databaseconfig->prepare($sql);
$stmt->bind_param('is',$status,$token);
$stmt->execute();
if ($stmt->affected_rows > 0) {
    
        $update = "updated";

        
 
 header("Location: http://localhost:5173/login?fresh=" . urlencode($update));

        exit;
}else{
    
        header("Location: http://localhost:5173/login?fresh=" . urlencode('alreadydone'));
}
}
?>
