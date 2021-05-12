<?php 
ini_set('memory_limit', '-1');
require_once('db_connect.php');
require_once('constants.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class DbQueries{
 public function __construct(){
       //$this->connection = mysqli_connect('localhost', 'f42v5vy0h3bw_app2_farmkonnect', 'f42v5vy0h3bw_app2_farmkonnect', 'f42v5vy0h3bw_app2_farmkonnect');
  $this->connection = mysqli_connect('localhost', 'root', '', 'sac_db');
    if(mysqli_connect_error()){
      die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
    }
  }

////other functions
function secure_database($value){
  $value = mysqli_real_escape_string($this->connection, $value);
  return $value;
}


function format_date($date, $format){
    $date = $this->secure_database($date);
    $new_date_format = date($format, strtotime($date));
    return $new_date_format;
}
////end other functions

////db functions starts
function check_row_exists_by_one_param($table,$param,$value){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    return true;
  }else{
    return false;
  }
}

function check_row_exists_by_two_params($table,$param,$value,$param2,$value2){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2' ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    return true;
  }else{
    return false;
  }
}

///create function
function insert_into_db($table,$data,$param,$validate_value){
  $validate_value = $this->secure_database($validate_value);
  $param = $this->secure_database($param);
  $table = $this->secure_database($table);
  $unique_id = $this->unique_id_generator(md5(uniqid()));
  $emptyfound = 0;
  $check = $this->check_row_exists_by_one_param($table,$param,$validate_value);
  if($check === true){
    return  json_encode(["status"=>"0", "msg"=>"Record Exists"]);
  }else{

      if( is_array($data) && !empty($data) ){
     $sql = "INSERT INTO `$table` SET  `unique_id` = '$unique_id',";
     $sql .= "`date_created` = now(), ";
     //$sql .= "`privilege` = '1', ";
        for($i = 0; $i < count($data); $i++){
            $each_data = $data[$i];
            
            if($_POST[$each_data] == ""  ){
              $emptyfound++;
            }


            if($i ==  (count($data) - 1)  ){
                 $sql .= " $data[$i] = '$_POST[$each_data]' ";
              }else{
                if($data[$i] === "password"){
                $enc_password = md5($_POST[$data[$i]]); 
                $sql .= " $data[$i] = '$enc_password' ,";
                }else{
                $sql .= " $data[$i] = '$_POST[$each_data]' ,";
                } 
            }

        }
    
      
      if($emptyfound > 0){
          return json_encode(["status"=>"0", "msg"=>"Empty Field(s)"]);
      } 
       else{
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        if($query){
          return json_encode(["status"=>"1", "msg"=>"success"]);
        }else{
          return json_encode(["status"=>"0", "msg"=>"Please try again"]);
        }

      }  


    }
    else{
      return json_encode(["status"=>"0", "msg"=>"Please try again"]);
    }

  } 

}

public function returnResponse($code, $data, $response=null){
  //header("content-type: application/json");
  $response = json_encode(['response'=>["status"=>$code, "message"=>$data, "data"=>$response]]);
  return $response;
}


function unique_id_generator($data){
     $data = $this->secure_database($data);
     $newid = md5(uniqid().time().rand(11111, 99999).rand(11111,99999).$data);
     return $newid;
}



////end create


///email function start
 function email_function2($email, $subject, $content){
//   $headers = "MIME-Version: 1.0" . "\r\n";
//   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//   $headers .= 'From: FarmKonnect <admin@farmkonnect.com>' . "\r\n";
//   $headers .= 'Cc: support@loyalty.com' . "\r\n";
$headers = "From: SAC HAIRS <admin@sac.com>"."\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $mail = mail($email, $subject, $content, $headers);
  return $mail;
}


public function email_function($email, $subject, $content){
      
  //Load Composer's autoloader
  require '../vendor/autoload.php';

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->Mailer = "smtp";
      $mail->SMTPDebug = SMTP::DEBUG_SERVER;                
      $mail->isSMTP();
      $mail->Host       = 'smtp.mailtrap.io';
      $mail->SMTPAuth   = true;
      $mail->Username   = '6af0f58274b405';
      $mail->Password   = '001bebe7e4a468';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 465;
      $mail->SMTPDebug = 0;

      //Recipients
      $mail->setFrom('info@sac-hairs.com', 'SAC Hairs');
      $mail->addAddress($email, 'User');
      // $mail->addReplyTo('info@example.com', 'Information');
      // $mail->addCC('cc@example.com');
      // $mail->addBCC('bcc@example.com');

      //Attachments
      // $mail->addAttachment('../'.$attachment);
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');

      //Content
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $content;
      //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      if($mail->send()){
        return true;
      }else{
        return false;
      }
  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

///update function
function update_data($table, $data,$conditional_param,$conditional_value){
  
  $conditional_value = $this->secure_database($conditional_value);

  if( is_array($data) && !empty($data) ){
   $sql = "UPDATE `$table` SET ";
      for($i = 0; $i < count($data); $i++){
          $each_data = $data[$i];
          if($i ==  (count($data) - 1)  ){
            $sql .= " $data[$i] = '$_POST[$each_data]' ";
          }else{
            $sql .= " $data[$i] = '$_POST[$each_data]' ,";
          }

      }

      $sql .= "WHERE `$conditional_param` = '$conditional_value'";
  
    $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
    if($query){
       return json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
      return json_encode(["status"=>"0", "msg"=>"Please try again"]);
    }
  }
  else{
    return json_encode(["status"=>"0", "msg"=>"Please try again"]);
  }
}
////end update data   
         
function get_rows_from_one_table($table){
    
    $table = $this->secure_database($table);
    // if($this->secure_database($order_param) != "" ){
    //   $sql = "SELECT * FROM `$table` ORDER BY `$order_param` ASC ";
    // }
    // else{
      $sql = "SELECT * FROM `$table` ORDER BY `date_created` DESC";
    //}
    $query = mysqli_query($this->connection, $sql);
    $num = mysqli_num_rows($query);
   if($num > 0){
        while($row = mysqli_fetch_array($query)){
            $row_display[] = $row;
            }
        return $row_display;
      }
      else{
         return null;
      }
}


function get_rows_from_one_table_by_id($table,$theid,$idvalue){
  $table = $this->secure_database($table);
  $theid = $this->secure_database($theid);
  $idvalue = $this->secure_database($idvalue);
  $sql = "SELECT * FROM `$table` WHERE `$theid`='$idvalue'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}


function get_rows_from_one_table_by_two_params_with_limit($table,$param1,$value1,$param2,$value2, $limit){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2' ORDER BY date_created DESC LIMIT $limit";
  $query = mysqli_query($this->connection, $sql);
  //var_dump($sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}

function get_rows_from_one_table_by_one_param_with_limit($table,$param1,$value1, $limit){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' ORDER BY date_created DESC LIMIT $limit";
  $query = mysqli_query($this->connection, $sql);
  //var_dump($sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}

function get_rows_from_one_table_by_two_params($table,$param1,$value1,$param2,$value2){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2' ORDER BY date_created DESC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}


function get_rows_from_one_table_by_three_params($table,$param1,$value1,$param2,$value2,$param3,$value3){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $param3 = $this->secure_database($param3);
  $value3 = $this->secure_database($value3);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2' AND `$param3`='$value3' ORDER BY date_created DESC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}



function get_data_within_a_range($table,$param,$datefrom,$dateto){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $datefrom = $this->secure_database($datefrom);
  $dateto = $this->secure_database($dateto);
  $sql = "SELECT * FROM `$table` WHERE `$param` >= '$datefrom' AND `$param` <= '$dateto' ORDER BY date_created DESC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}

function get_rows_for_non_workers($table,$param1,$param2,$value2){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param1` IS NULL AND `$param2`='$value2' ORDER BY date_created DESC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}

function get_rows_from_one_table_by_one_param($table,$param1,$value1){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' ORDER BY date_created DESC";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
 if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
    else{
       return null;
    }
}


function get_rows_from_one_table_group_by($table,$group_by){
  $table = $this->secure_database($table);
  $group_by = $this->secure_database($group_by);
  $sql = "SELECT * FROM `$table` GROUP BY `$group_by` ASC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);

   if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }

else{
       return null;
    }


}

function get_number_of_rows($table){
        $table = $this->secure_database($table);
        $sql= "SELECT id FROM `$table`";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
        return $count;  
}

function get_number_of_rows_one_param($table,$param,$value){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $sql= "SELECT id FROM `$table` WHERE `$param`='$value'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
        return $count;   
}


function get_number_of_rows_two_params($table,$param1,$value1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $value1 = $this->secure_database($value1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql= "SELECT id FROM `$table` WHERE `$param1`='$value1' AND `$param2`='$value2'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
      return $count;     
}


function get_number_of_rows_for_non_workers($table,$param1,$param2,$value2){
        $table = $this->secure_database($table);
        $param1 = $this->secure_database($param1);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql= "SELECT id FROM `$table` WHERE `$param1` IS NULL AND `$param2`='$value2'";
        $query = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($query);
      return $count;     
}


function get_one_row_from_one_table($table,$param,$value){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_two_params($table,$param,$value,$param2,$value2){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}

function get_one_row_from_one_table_by_three_params($table,$param,$value,$param2,$value2,$param3,$value3){
        $table = $this->secure_database($table);
        $param = $this->secure_database($param);
        $value = $this->secure_database($value);
        $param2 = $this->secure_database($param2);
        $value2 = $this->secure_database($value2);
         $param3 = $this->secure_database($param3);
        $value3 = $this->secure_database($value3);
        $sql = "SELECT * FROM `$table` WHERE `$param` = '$value' AND `$param2` = '$value2' AND `$param3` = '$value3'";
        $query = mysqli_query($this->connection, $sql);
        $num = mysqli_num_rows($query);
       if($num > 0){
            $row = mysqli_fetch_array($query);
            return $row;
          }
          else{
             return null;
          }
}


////delete a row
function delete_a_row($table,$param,$value){
    $value = $this->secure_database($value);
    $sql = "DELETE FROM `$table` WHERE `$param` = '$value' ";
    $res = mysqli_query($this->connection, $sql);
    if($res){
      return true;
    }else{
      return false;
    }
  } 

///end delete a row

//get current admin info
function get_current_user_info($table,$uid){
  $uid = $this->secure_database($uid);
  $table = $this->secure_database($table);
  $sql = "SELECT * FROM `$table` WHERE unique_id = '$uid'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
      $row = mysqli_fetch_assoc($query);
          return $row;
  }else{
      return null;
  }
}


function check_password_match($password,$cpassword){
  $password = $this->secure_database($password);
  $cpassword = $this->secure_database($cpassword);
    if($password == $cpassword){
        return 1;
    }else{
       return 0;
    }
}

function check_user_login($username_or_email,$password){
  $username_or_email= $this->secure_database($username_or_email);
  $password = $this->secure_database($password);
  $enc_password = md5($password);
   if($username_or_email == "" || $password == ""){
    return "empty_fields";
  }
  $sql = "SELECT * FROM users WHERE (email = '$username_or_email' OR `username` = '$username_or_email') AND password = '$enc_password'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    $row = mysqli_fetch_array($query);
    return $row;
  }else{
    return null;
  }
}

function check_admin_login($email,$password){
  $email = $this->secure_database($email);
  $password = $this->secure_database($password);
  $enc_password = md5($password);
  $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$enc_password' AND access_level=1";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0 ){
    $row = mysqli_fetch_array($query);
    return $row;
  }else{
    return null;
  }
}


function user_reset_password_link($unique_id, $email){
  $actual_link = "https://$_SERVER[HTTP_HOST]"."/reset_password.php?id=".$unique_id;
  $toEmail = $email;
  $subject = "User Password reset link";
  $content = "Click <a href='".$actual_link."'> here </a> to reset your password or copy the link below and paste it on your browser<br> 
  <a href='".$actual_link."'>".$actual_link. "</a>";
  $mailHeaders = "From: FarmKonnect <admin@farmkonnectng.com>"."\r\n";
  $mailHeaders .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  mail($toEmail, $subject, $content, $mailHeaders);
}

////Tosin's functions

function reset_password($table, $unique_id, $password, $confirm_password){
  $table = $this->secure_database($table);
  $unique_id = $this->secure_database($unique_id);
  $password = $this->secure_database($password);
  $confirm_password = $this->secure_database($confirm_password);
  if($unique_id == "" || $password == "" || $confirm_password == ""){
    return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
  }
  else if (strlen($password) < 8) {
    return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Your Password Must Contain At Least 8 Characters!");
  }
  else{
    if ($password != $confirm_password){
      return $this->returnResponse(PASSWORD_MISMATCH, "Passwords do not match");
    }
    else{
      $enc_password = md5($password);
      $sql = "UPDATE `$table` SET `active_status` = 1, `password` = '$enc_password' WHERE `unique_id` = '$unique_id'";
      $query = mysqli_query($this->connection, $sql);
      if(mysqli_affected_rows($this->connection)){
        return $this->returnResponse(SUCCESS_RESPONSE, "Password has been reset successfully");
      }
      else{
        return $this->returnResponse(DB_ERROR, "Database Error");
      }
    } 
}
}

function insert_into_notifications_tbl($notification_type, $user_id, $notification_heading, $notification){
  $user_id = $this->secure_database($user_id);
  $notification_type = $this->secure_database($notification_type);
  $notification_heading = $this->secure_database($notification_heading);
  $notification = $this->secure_database($notification);
  $data = md5($user_id.$notification_type);
  $unique_id = $this->unique_id_generator($data);
  //$check = $this->check_row_exists_by_one_param('access_card_tbl','user_id',$user_id);
  if($user_id == "" || $notification_type == "" || $notification == "" || $notification_heading == ""){
    return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
  }else{
    $sql = "INSERT INTO `notifications_tbl` SET `unique_id` = '$unique_id',`user_id` = '$user_id', `notification_type` = '$notification_type', `notification` = '$notification', `notification_heading` = '$notification_heading', `date_created` = now()";
    $query = mysqli_query($this->connection, $sql);
    if($query){
      return json_encode(["status"=>"1", "msg"=>"success"]);
    }else{
      return json_encode(["status"=>"0", "msg"=>"db_error"]);
    }
  }
}

function image_upload($filename, $size, $tmpName, $type){


  //$currentDir = getcwd();
  //$dir =  dirname(__DIR__);
  
  //$uploadPath = $dir.'/uploads';
  //$uploadPath = "https://".$_SERVER['HTTP_HOST']."/uploads";
  $uploadPath= "uploads/".$filename;
  //$uploadPath = "https://$_SERVER[HTTP_HOST]"."/uploads/".$filename;
  $fileExtensions = ['jpeg','jpg','png', 'pdf','xlsx','csv','docx','doc'];
  $fileExtension = substr($filename, strpos($filename, '.') + 1);

  @$fileExtension = strtolower(end(explode('.',$filename)));
 // $uploadPath = $currentDir . $file_path . basename($filename);
  if (!in_array($fileExtension,$fileExtensions)) {
   return json_encode(["status"=>"0", "msg"=>"This file extension is not allowed. Please upload a JPEG or PNG file"]);
  }
  else{
     if ($size > 2000000) {
      return json_encode(["status"=>"0", "msg"=>"File size is more than 2MB"]);
    }
    else{
      $didUpload = move_uploaded_file($tmpName, $uploadPath);
      if ($didUpload) {
        return json_encode(["status"=>"1", "msg"=>$uploadPath]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"Server Error"]);
      }
    }
  }
}


function image_upload2($filename, $size, $tmpName, $type){


  //$currentDir = getcwd();
  //$dir =  dirname(__DIR__);
  
  //$uploadPath = $dir.'/uploads';
  //$uploadPath = "https://".$_SERVER['HTTP_HOST']."/uploads";
  $uploadPath= "../uploads/".$filename;
  //$uploadPath = "https://$_SERVER[HTTP_HOST]"."/uploads/".$filename;
  $fileExtensions = ['jpeg','jpg','png', 'pdf','xlsx','csv','docx','doc'];
  $fileExtension = substr($filename, strpos($filename, '.') + 1);

  @$fileExtension = strtolower(end(explode('.',$filename)));
 // $uploadPath = $currentDir . $file_path . basename($filename);
  if (!in_array($fileExtension,$fileExtensions)) {
   return json_encode(["status"=>"0", "msg"=>"This file extension is not allowed. Please upload a JPEG or PNG file"]);
  }
  else{
     if ($size > 2000000) {
      return json_encode(["status"=>"0", "msg"=>"File size is more than 2MB"]);
    }
    else{
      $didUpload = move_uploaded_file($tmpName, $uploadPath);
      if ($didUpload) {
        return json_encode(["status"=>"1", "msg"=>$uploadPath]);
      }
      else{
        return json_encode(["status"=>"0", "msg"=>"Server Error"]);
      }
    }
  }
}


function check_row_exists_by_one_param_edit($table,$param,$value){
  $table = $this->secure_database($table);
  $param = $this->secure_database($param);
  $value = $this->secure_database($value);
  $sql = "SELECT * FROM `$table` WHERE `$param` = '$value'";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num === 1 ){
    return true;
  }else{
    return false;
  }
}

function update_with_one_param($table,$param,$value,$new_value_param,$new_value){
      $table = $this->secure_database($table);
      $value = $this->secure_database($value);
      $param = $this->secure_database($param);
      $new_value_param = $this->secure_database($new_value_param);
      $new_value = $this->secure_database($new_value);

        $sql = "UPDATE `$table` SET `$new_value_param`='$new_value' WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
        
        if($query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
            
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }


}

function update_with_two_params($table,$param,$value,$new_value_param1,$new_value1, $new_value_param2,$new_value2){
      $table = $this->secure_database($table);
      $value = $this->secure_database($value);
      $param = $this->secure_database($param);
      $new_value_param1 = $this->secure_database($new_value_param1);
      $new_value1 = $this->secure_database($new_value1);
      $new_value_param2 = $this->secure_database($new_value_param2);
      $new_value2 = $this->secure_database($new_value2);

        $sql = "UPDATE `$table` SET `$new_value_param1`='$new_value1' AND `$new_value_param2`='$new_value2' WHERE `$param` = '$value'";
        $query = mysqli_query($this->connection, $sql)or die(mysqli_error($this->connection));
        
        if($query){
            return json_encode(["status"=>"1", "msg"=>"success"]);
            
        }
        else{
            return json_encode(["status"=>"0", "msg"=>"db_error"]);
        }


}

function insert_users_logs($user_id, $description){
  $user_id = $this->secure_database($user_id);
  $description = $this->secure_database($description);
  $data = $user_id.$description;
  $unique_id = $this->unique_id_generator($data);

  if($user_id == '' || $description == ''){
            return  json_encode(["status"=>"0", "msg"=>"empty_fields"]);
          }
  else{
    $insert_log_sql = "INSERT INTO `users_logs` SET `unique_id` = '$unique_id',`description` = '$description', `user_id`='$user_id', `date_created` = now()";
         $insert_log_query = mysqli_query($this->connection, $insert_log_sql) or die(mysqli_error($this->connection));
         if($insert_log_query){
            return  json_encode(["status"=>"1", "msg"=>"success"]);
         }else{
            return  json_encode(["status"=>"0", "msg"=>"insertion_error"]);

         } 
  }

}

  public function register_user($table, $email){
    session_start();
    $table = $this->secure_database($table);
    $email = $this->secure_database($email);
    $unique_id = $this->unique_id_generator($email);
    $check = $this->check_row_exists_by_one_param('users','email',$email);
    $str = 'ABDCEDGH';
    $rand = str_shuffle($str).rand(1000, 9999);
    $enc_password = md5($rand);
    if($email == ""){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Invalid Email format");
    }
    else if($check === true){
      return $this->returnResponse(USER_EXISTS, "User already exists");
    }

    else{
      $sql = "INSERT INTO `users` SET `unique_id` = '$unique_id', `email` = '$email', `password` = '$enc_password', `date_created` = now()";
      $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
      if($query){
        $subject = "User Registration";
        $link = "https://$_SERVER[HTTP_HOST]"."/sac/login";
        $content = "<b>Thank you for registering on SAC hairs</b><br>Your password is ".$rand.".<br>Please be sure to keep this password safe as it will be used to login to our website.<br><br>Login <a class='btn' href='".$link."'>here</a>";
        $send_email = $this->email_function($email, $subject, $content);
        //$send_sms = send_sms("IMPORTANT", $phone, $content, $developer_id, $cloud_sms_password);
        if( $send_email ){//&& $send_sms
          return $this->returnResponse(SUCCESS_RESPONSE, "Registration was successful");
        }
        else {
          return $this->returnResponse(DB_ERROR, "Registration failed");
        }
      }
      else{
        return $this->returnResponse(DB_ERROR, "Registration failed");
      }
    }
  }

  public function add_product(array $product_array){
    $name = $product_array['name'];
    $description = $product_array['description'];
    $category = $product_array['category'];
    $price = $product_array['price'];
    $colors = $product_array['colors'];
    $sku = $product_array['sku'];
    $sub_category = $product_array['sub_category'];
    $weight = $product_array['weight'];
    $dimensions = $product_array['dimensions'];
    $image_url = $product_array['image_url'];
    $product_image = $product_array['product_image'];
    $available_no = $product_array['available_no'];
    $price_before_discount = $product_array['price_before_discount'];
    $unique_id = $this->unique_id_generator($name.$category);
    $check = $this->check_row_exists_by_one_param('products','name',$name);
    if($name == "" || $description == "" || $category == "" || $price == "" || $colors == "" || $image_url == "" || $available_no == "" || $sub_category == "" || $product_image == ""){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else if($check === true){
      return $this->returnResponse(USER_EXISTS, "Product already exists");
    }
    else{
      $sql = "INSERT INTO `products` SET `unique_id` = '$unique_id', `name` = '$name', `description` = '$description', `category` = '$category', `price` = '$price', `colours` = '$colors', `sku` = '$sku', `image_url` = '$image_url', `product_image` = '$product_image', `sub_category` = '$sub_category', `available_no` = '$available_no', `weight` = '$weight', `dimensions` = '$dimensions', `price_before_discount` = '$price_before_discount', `date_created` = now()";
      $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
      if( $query ){//&& $send_sms
        return $this->returnResponse(SUCCESS_RESPONSE, "Product Added successfully");
      }
      else {
        return $this->returnResponse(DB_ERROR, "Error Adding Product");
      }
    }
  }

  public function edit_product(array $product_array){
    $name = $product_array['name'];
    $description = $product_array['description'];
    $category = $product_array['category'];
    $price = $product_array['price'];
    $colors = $product_array['colors'];
    $sku = $product_array['sku'];
    $sub_category = $product_array['sub_category'];
    $weight = $product_array['weight'];
    $dimensions = $product_array['dimensions'];
    $image_url = $product_array['image_url'];
    $product_image = $product_array['product_image'];
    $available_no = $product_array['available_no'];
    $price_before_discount = $product_array['price_before_discount'];
    $product_id = $product_array['product_id'];
    $check = $this->check_row_exists_by_one_param('products','unique_id',$product_id);
    if($name == "" || $description == "" || $category == "" || $price == "" || $colors == "" || $image_url == "" || $available_no == "" || $sub_category == "" || $product_image == ""){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else if($check === false){
      return $this->returnResponse(USER_EXISTS, "Product does not exist");
    }
    else{
      $sql = "UPDATE `products` SET `name` = '$name', `description` = '$description', `category` = '$category', `price` = '$price', `colours` = '$colors', `sku` = '$sku', `image_url` = '$image_url', `product_image` = '$product_image', `sub_category` = '$sub_category', `available_no` = '$available_no', `price_before_discount` = '$price_before_discount' WHERE `unique_id` = '$product_id'";
      $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
      if( $query ){//&& $send_sms
        return $this->returnResponse(SUCCESS_RESPONSE, "Product Edited successfully");
      }
      else {
        return $this->returnResponse(DB_ERROR, "Error editing Product");
      }
    }
  }

  public function paystack_checkout($email, $amount, $callback_url){
    $curl = curl_init();
    $data = array(
      "email"=> $email, 
      "amount" => $amount * 100,
      "callback_url"=>$callback_url
    );
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS =>json_encode($data),
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer sk_test_8d7f0ad794cf2720189772d34c8298d181bacd19",
        "Content-Type: application/json"
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response_decode = json_decode($response, true);
    if($response_decode['status'] == 'success'){
      return json_encode(["status"=> "1", "msg"=>$response_decode['data']['authorization_url']]);
    }
    else{
      return json_encode(["status"=> "0", "msg"=>"Please try again"]);
    }
  }

  function flutterwave_checkout($email, $fullname, $amount, $redirect_url){
    $transaction_ref = md5(uniqid().rand(1000, 9999));
    $curl = curl_init();
    $data = [
      "tx_ref"=>$transaction_ref,
      "amount"=>$amount,
      "currency"=>"NGN",
      "redirect_url"=> $redirect_url,
      "payment_options"=>"card",
      "customer"=>[
        "email"=>$email,
        "name"=>$fullname
      ]
    ];

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.flutterwave.com/v3/payments",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS =>json_encode($data),
    CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer FLWSECK_TEST-0c1450bff1fe587e3164a42ef28e90be-X",
    "Content-Type: application/json"
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    $response_decode = json_decode($response, true);
    if($response_decode['status'] == 'success'){
      return json_encode(["status"=> "1", "msg"=>$response_decode['data']['link']]);
    }
    else{
      return json_encode(["status"=> "0", "msg"=>"Please try again"]);
    }
  }

  public function save_order($user_id, $order_json, $payment_method, $order_total, $order_location, $fullname, $country, $address, $postcode, $email, $phone){
    $user_id = $this->secure_database($user_id);
    // $order_json = json_encode($order_json);
    $payment_method = $this->secure_database($payment_method);
    $order_total = $this->secure_database($order_total);
    $order_location = $this->secure_database($order_location);
    $fullname = $this->secure_database($fullname);
    $country = $this->secure_database($country);
    $address = $this->secure_database($address);
    $postcode = $this->secure_database($postcode);
    $email = $this->secure_database($email);
    $phone = $this->secure_database($phone);
    $callback_url = "http://$_SERVER[HTTP_HOST]"."/sac/order_complete";
    $order_id = "SAC_ORDER".rand(1111, 9999);
    if($user_id == "" || $order_json == "" || $payment_method == "" || $order_total == "" || $order_location == "" || $fullname == "" || $country == "" || $address == "" || $postcode == "" || $email == "" || $phone == ''){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }

    else if (ctype_alpha(str_replace(' ', '', $fullname)) === false) {
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Invalid Name format");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Invalid Email format");
    }
    else{
      foreach ($order_json as $value) {
        $unique_id = $this->unique_id_generator($user_id.$order_total);
        $product_id = $value['product_id'];
        $quantity = $value['counter_value'];
        $color = $value['color'];
        $subtotal = $value['price'];
        $get_product = $this->get_one_row_from_one_table('products', 'unique_id', $product_id);
        $available_no = $get_product['available_no'];
        $remaining_no = $available_no - $quantity;
        $sql = "INSERT INTO `orders` SET 
        `unique_id` = '$unique_id', 
        `user_id` = '$user_id', 
        `product_id` = '$product_id',
        `quantity` = '$quantity', 
        `color` = '$color', 
        `subtotal` = '$subtotal',  
        `payment_method` = '$payment_method',  
        `order_location` = '$order_location', 
        `order_id` = '$order_id',
        `date_created` = now()";
        $query = mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $update_quantity = $this->update_with_one_param('products','unique_id',$product_id,'available_no',$remaining_no);
        $update_quantity_decode = json_decode($update_quantity, true);
      }
      $sql1 = "UPDATE `users` SET `fullname` = '$fullname', `address` = '$address', `phone` = '$phone', `email` = '$email', `country` = '$country', `postcode` = '$postcode' WHERE `unique_id` = '$user_id'";
      $query1 = mysqli_query($this->connection, $sql1) or die(mysqli_error($this->connection));
      if( $query AND $query1 AND $update_quantity_decode['status'] == 1){//&& $send_sms
        if($payment_method == "stripe"){
          $paystack_checkout = $this->paystack_checkout($email, $order_total, $callback_url);
          $paystack_checkout_decode = json_decode($paystack_checkout, true);
          if($paystack_checkout_decode['status'] == "1"){
            return $this->returnResponse(SUCCESS_RESPONSE, 'redirect', $paystack_checkout_decode['msg']);
          }
          else{
            return $this->returnResponse(DB_ERROR, "Error placing order");
          }
        }
        else if($payment_method == "flutter"){
          $flutter_checkout = $this->flutterwave_checkout($email, $fullname, $order_total, $callback_url);
          $flutter_checkout_decode = json_decode($flutter_checkout, true);
          if($flutter_checkout_decode['status'] == "1"){
            return $this->returnResponse(SUCCESS_RESPONSE, 'redirect', $flutter_checkout_decode['msg']);
          }
          else{
            return $this->returnResponse(DB_ERROR, "Error placing order");
          }
        }
        else{
          return $this->returnResponse(SUCCESS_RESPONSE, "Order saved successfully");
        }
      }
      else {
        return $this->returnResponse(DB_ERROR, "Error placing order");
      }
    }
  }

  public function add_user_payment_method($user_id, $payment_method){
    $user_id = $this->secure_database($user_id);
    $payment_method = $this->secure_database($payment_method);
    $data = $user_id.$payment_method;
    $unique_id = $this->unique_id_generator($data);
    if($user_id == '' || $payment_method == ''){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else{
      $insert_sql = "INSERT INTO `payment_method` SET `unique_id` = '$unique_id',`payment_method` = '$payment_method', `user_id`='$user_id', `date_created` = now()";
      $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
      if($insert_query){
         return $this->returnResponse(SUCCESS_RESPONSE, 'Payment method added successfully');
      }else{
         return $this->returnResponse(DB_ERROR, "Please try again");
      } 
    }
  }

  public function save_address($user_id, $fullname, $country, $address, $postcode, $email, $phone){
    $user_id = $this->secure_database($user_id);
    $fullname = $this->secure_database($fullname);
    $country = $this->secure_database($country);
    $address = $this->secure_database($address);
    $postcode = $this->secure_database($postcode);
    $email = $this->secure_database($email);
    $phone = $this->secure_database($phone);
    $data = $user_id.$postcode;
    $unique_id = $this->unique_id_generator($data);
    if($user_id == '' || $fullname == '' || $country == '' || $address == '' || $postcode == '' || $email == '' || $phone == ''){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else{
      $insert_sql = "UPDATE `users` SET `fullname` = '$fullname', `country` = '$country', `address` = '$address', `postcode` = '$postcode', `email` = '$email', `phone` = '$phone' WHERE `unique_id`='$user_id'";
      $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
      if($insert_query){
         return $this->returnResponse(SUCCESS_RESPONSE, 'Address saved successfully');
      }else{
         return $this->returnResponse(DB_ERROR, "Please try again");
      } 
    }

  }

  public function edit_profile($user_id, $first_name, $last_name, $username, $old_password, $new_password, $email, $confirm_password, $instagram_handle){
    $user_id = $this->secure_database($user_id);
    $first_name = $this->secure_database($first_name);
    $last_name = $this->secure_database($last_name);
    $username = $this->secure_database($username);
    $old_password = $this->secure_database($old_password);
    $new_password = $this->secure_database($new_password);
    $confirm_password = $this->secure_database($confirm_password);
    $instagram_handle = $this->secure_database($instagram_handle);
    $fullname = $first_name.' '.$last_name;
    $email = $this->secure_database($email);
    $data = $user_id.$username;
    $unique_id = $this->unique_id_generator($data);
    $get_user = $this->get_one_row_from_one_table('users', 'unique_id', $user_id);
    $hash_old_password = md5($old_password);
    if($user_id == '' || $first_name == '' || $last_name == '' || $username == '' || $old_password == '' || $email == '' || $confirm_password == ''){
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Invalid Email format");
    }
    else if($get_user['password'] != $hash_old_password){
      return $this->returnResponse(INVALID_USER_PASS, "Old Password is not correct");
    }
    else if ($new_password != $confirm_password){
      return $this->returnResponse(PASSWORD_MISMATCH, "Passwords do not match");
    }
    else{
      $hash_new_password = md5($new_password);
      $insert_sql = "UPDATE `users` SET `fullname` = '$fullname', `username` = '$username', `email` = '$email', `password` = '$hash_new_password', `instagram_handle` = '$instagram_handle' WHERE `unique_id`='$user_id'";
      $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
      if($insert_query){
         return $this->returnResponse(SUCCESS_RESPONSE, 'Profile edited successfully');
      }else{
         return $this->returnResponse(DB_ERROR, "Please try again");
      } 
    }

  }

  function get_pending_orders($table,$param1,$value1,$param2,$value2){
  $table = $this->secure_database($table);
  $param1 = $this->secure_database($param1);
  $value1 = $this->secure_database($value1);
  $param2 = $this->secure_database($param2);
  $value2 = $this->secure_database($value2);
  $sql = "SELECT * FROM `$table` WHERE `$param1`='$value1' OR `$param2`='$value2' ORDER BY date_created DESC ";
  $query = mysqli_query($this->connection, $sql);
  $num = mysqli_num_rows($query);
  if($num > 0){
      while($row = mysqli_fetch_array($query)){
          $row_display[] = $row;
          }
      return $row_display;
    }
  else{
    return null;
  }
}

function add_new_admin($fullname, $email, $admin_id){
  $fullname = $this->secure_database($fullname);
  $email = $this->secure_database($email);
  $admin_id = $this->secure_database($admin_id);
  $check = $this->check_row_exists_by_one_param('admin','email',$email);
  $password = str_shuffle("abcdef123456");
  $hash_password = md5($password);
  $unique_id = $this->unique_id_generator($email.$admin_id);
  if($fullname == "" || $email == ""){
    return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
  }
  else if($check == true){
    return $this->returnResponse(USER_EXISTS, "Email already exists");
  }
  else{
    $insert_sql = "INSERT INTO `admin` SET `unique_id` = '$unique_id', `fullname` = '$fullname', `email` = '$email', `password` = '$hash_password', `role` = 1, `added_by` = '$admin_id', `date_created` = now()";
    $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
    if($insert_query){
      $subject = "Admin Login";
      $link = "https://$_SERVER[HTTP_HOST]"."/sac/admin/login";
      $content = "<b>You have been added as an admin for SAC HAIRS</b><br>Your password is ".$password.".<br>Please be sure to keep this password safe as it will be used to login to your portaal.<br><br>Login <a class='btn' href='".$link."'>here</a>";
      @$send_email = $this->email_function2($email, $subject, $content);
      //if($send_email){
        return $this->returnResponse(SUCCESS_RESPONSE, 'Admin added successfully');
      //}else{
        //return $this->returnResponse(DB_ERROR, "Please try again");
      //}
    }
    else{
      return $this->returnResponse(DB_ERROR, "Please try again");
    }
  }
}

function add_best_selling_products($product_id){
  if($product_id == null){
    return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
  }
  else{
    foreach ($product_id as $product) {
      $unique_id = $this->unique_id_generator(md5(rand(0000, 9999)));
      $insert_sql = "INSERT INTO `best_selling_products` SET `unique_id` = '$unique_id', `product_id` ='$product', `date_created` = now()";
      $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
    }
    if($insert_query){
      return $this->returnResponse(SUCCESS_RESPONSE, 'Best Selling added successfully');
    }
    else{
      return $this->returnResponse(DB_ERROR, "Please try again");
    }
  }
}

function add_hot_now_products($product_id){
  if($product_id == null){
    return $this->returnResponse(VALIDATE_PARAMETER_REQUIRED, "Empty field(s) found");
  }
  else{
    foreach ($product_id as $product) {
      $unique_id = $this->unique_id_generator(md5(rand(0000, 9999)));
      $insert_sql = "INSERT INTO `hot_now_products` SET `unique_id` = '$unique_id', `product_id` ='$product', `date_created` = now()";
      $insert_query = mysqli_query($this->connection, $insert_sql) or die(mysqli_error($this->connection));
    }
    if($insert_query){
      return $this->returnResponse(SUCCESS_RESPONSE, 'Hot now added successfully');
    }
    else{
      return $this->returnResponse(DB_ERROR, "Please try again");
    }
  }
}

function get_average_rating($product_id){
  $product_id = $this->secure_database($product_id);
  $sql = "SELECT AVG(rating) as average_rating FROM ratings WHERE product_id = '$product_id'";
  $query = mysqli_query($this->connection, $sql);
  $row = mysqli_fetch_array($query);
  $average_rating = $row['average_rating'];
  return $average_rating;
}
//Tosin's functions end


}//ends class



  


?>