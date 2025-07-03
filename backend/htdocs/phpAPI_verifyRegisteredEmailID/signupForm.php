<?php
require_once 'databaseconfig.php';
 
?>

<?php
session_start(); // Sabse pehle likhna zaroori hai
require_once 'databaseconfig.php';  // File ko ek hi baar include karega, agar pehle se included ho toh nahi karega.
?>
<?php 
//this is used for (cros) access permission
header("Access-Control-Allow-Origin: *");
header("Access-control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-type: application/json");
?>

<?php
//here we used prflied option we  used 
if($_SERVER['REQUEST_METHOD']==='OPTIONS'){
    http_response_code(200);
    exit;
}
?>


<?php
// सिर्फ POST requests allow करें
if($_SERVER['REQUEST_METHOD'] !=='POST'){
    if($_SERVER['REQUEST_METHOD'] ==='GET'){
        echo "this endpoint is for post request ";
        echo "<h3>This API only accepts POST requests. Please use a REST client or frontend form.</h3>";
        exit;
    }
    http_response_code(405);
    echo json_encode(['error'=>'Method is not Allowed']);//convert to json_object
    exit;
}
?>

<?php
// JSON data पढ़ें
$jsonData=file_get_contents('php://input');
$data=json_decode($jsonData,true);
if($data==null){
    http_response_code(400);
    echo json_encode(['error'=>"invalid json"]);
    exit;
}else{
    http_response_code(200);
}
?>



<?php
//for mail so we used at top 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

const bigError=[];
const response=[];
//$username='rajkumar'?? '';
$username=$data['username'] ?? '';
if (empty($username)) {
    $bigError[] = 'username empty so can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;
}else{
    //echo "email is not missing";
    $response[]="username is not missing";
}

//$email='rks701754@gmail.com';
$email=$data['email'] ?? '';
if (empty($email)) {
    $bigError[] = 'email empty so can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;
}else{
    $response[]="email is not missing";
}

//$mobile='9878987678';
$mobile=$data['mobile'] ?? '';//agar key(mobil) sahi nahi he to '' jayega $mobile aur empty-method check kareg kya yah empty he to exit ho jayega
if (empty($mobile)) {
    $bigError[] = 'mobile empty so can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;    
}else{
    //echo "mobile is not missing";
    $response[]="mobile is not missing";
}


//$password="Raj@123";
$password=$data['password'] ?? '';
if (empty($password)) {
    //echo 'password is missing. Cannot send email.';
    $bigError[] = 'password empty so can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;      
}else{
    //echo "password is not missing";
   $response[] ="password is not missing";
}
//$cpassword="Raj@123";
$cpassword=$data['cpassword'] ?? '';
 if (empty($cpassword)) {
        $bigError[] = 'cpassword empty so can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;  
}else{
    //echo "cpassword is not missing";
    $response[]="cpassword is not missing";
}


 
 $tokenrandom = bin2hex(random_bytes(16)); // 32 char hex token
 if (!$tokenrandom) {
   // echo 'tokenrandom is missing. Cannot send email.';
   $bigError[] = 'tokenrandom  can not insert data  in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;  
}else{
    //echo "tokenrandom is not missing";
    $response[]="tokenrandom is not missing";
}

$status = 0; // Or 1 depending on requirement (e.g. 0 = inactive, 1 = verified)




if($password !==$cpassword){
http_response_code(400);
exit;


}else{

$phashPassword=password_hash($password,PASSWORD_DEFAULT);
$chashPassword=password_hash($cpassword,PASSWORD_DEFAULT);

$response[]='create-password and repeat-password did  match';
}

if($databaseconfig->connect_error){
$bigError[]='database connection failed';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
exit;
}else {
    
    $sql='SELECT * FROM emailregis WHERE email=?';
    $stmt=$databaseconfig->prepare($sql);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $result =$stmt->get_result();
      $response[]='database connection successful';
    }

    
if($result->num_rows>0){
$bigError[] = 'email already available in database';
    echo json_encode([
        'success' => false,
        'errors' => $bigError
    ]);
    exit;
    
}else{
   
    $sqlInsert="INSERT INTO `emailregis`( `username`, `email`, `mobile`, `password`, `cpassword`, `token`,`status`) values(?,?,?,?,?,?,?)";
    $stmt=$databaseconfig->prepare($sqlInsert);
     $stmt->bind_param('ssisssi',$username,$email,$mobile,$phashPassword,$chashPassword,$tokenrandom,$status);
     $stmt->execute();
  
      $response[]= 'signup successful';
      $response[]= $email;



require 'emailproject/PHPMailer/PHPMailer.php';
require 'emailproject/PHPMailer/SMTP.php';
require 'emailproject/PHPMailer/Exception.php';



$mail = new PHPMailer(true);




$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yourmail@gmail.com'; // <-- Aapka Gmail ID
    $mail->Password   = 'your-app-password';   // यहां Gmail का "App Password" देना होता है
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // ✅ Required!
    $mail->Port       = 587;

    $mail->setFrom('yourmail@gmail.com', 'OTP System');
    $mail->addAddress($email);
    $mail->addReplyTo('yourmail@gmail.com', 'OTP System');

    $mail->isHTML(true);
    $mail->Subject = "Email Activation";
    $mail->Body    = "Hi,$username.click here to activate your account .http://localhost/phpAPI_verifyRegisteredEmailID/activation.php?token=$tokenrandom";

    $mail->send();


} catch (Exception $e) {
    echo "email could not be sent problem into try()method-> Error are:- {$mail->ErrorInfo}";
}

if(count(bigError)==0){
     echo  json_encode(['response'=>$response]);
     
}else{
 echo json_encode(['sorryForResponse'=>'sorryforResponse']);
}


}
?>







