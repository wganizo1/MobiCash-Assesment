<?php
mysql_connect('localhost','f4012065_ganizo','Pleasetryagain04!');
mysql_select_db('f4012065_alterbliss_edu'); 
$required_action =  $_POST['required_action'];
if($required_action=="Register"){
register();
}
else if($required_action=="Login"){
    login();
}
function register(){
      $password =  $_POST['password'];
      $name =  $_POST['name'];
      $mobile =  $_POST['mobile'];
      $email =  $_POST['email'];
      $return_arr = array();
      
      $sql_get_user = mysql_query("SELECT id FROM mobi_cash where email = '$email' AND password = '$password'");  
      $res = mysql_fetch_array($sql_get_user, MYSQL_ASSOC);
      $check_existance = mysql_num_rows($sql_get_user);
      
      if($check_existance>0){
          echo "Your email is already registered";
      }
      else{
      $sql_insert_user = "INSERT INTO mobi_cash (name, email, password,mobile)
                VALUES ('$name', '$email', '$password','$mobile')";
      mysql_query($sql_insert_user) or die("Error: ".mysql_error()); 
      $res_reg = mysql_fetch_array($sql_get_user, MYSQL_ASSOC);
      echo "Registration Successful";
}
}
function login(){
      $password =  $_POST['password'];
      $email =  $_POST['email'];
      $return_arr = array();
      $sql_get_user = mysql_query("SELECT DISTINCT name,email,id,password,mobile FROM mobi_cash where email = '$email' AND password = '$password'");  
      $res = mysql_fetch_array($sql_get_user, MYSQL_ASSOC);
      $row_array['id'] = $res['id'];
      $row_array['name'] = $res['name'];
      $row_array['email'] = $res['email'];
      $row_array['password'] = $res['password'];
      $row_array['mobile'] = $res['mobile'];
      array_push($return_arr,$row_array);
      echo json_encode(array("result"=>$return_arr));
      }      