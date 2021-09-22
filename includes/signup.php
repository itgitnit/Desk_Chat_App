 <?php

$info = (object)[];

 $data = false;
    $data['userid'] = $DB->generate_id(11);
    $data['date'] = date("Y-m-d H:i:s");

    // Validate Username
    $data['username'] = $DATA_OBJ->username;
    if(empty($DATA_OBJ->username))
    {
        $Error .= "Please Enter A Valid Username . <br>";
    }else
    {
if(strlen($DATA_OBJ->username) < 3)
{
    $Error .= "Username must be at least 3 characters long. <br>";
}
if(!preg_match("/^[a-z A-Z]*$/",$DATA_OBJ->username))
{
    $Error .= "Please Enter A Valid Username . <br>";
}
    }

    $data['email'] = $DATA_OBJ->email;
 if(empty($DATA_OBJ->email))
    {
        $Error .= "Please Enter A Valid Email . <br>";
    }
    else
    {

if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$DATA_OBJ->email))
{
    $Error .= "Please Enter A Valid Email . <br>";
}
    }

    $data['password'] = $DATA_OBJ->password;
    $password = $DATA_OBJ->password2;

    if(empty($DATA_OBJ->password))
    {
        $Error .= "Please Enter A Valid Password . <br>";
    }else
    {
if($DATA_OBJ->password != $DATA_OBJ->password2)
{
    $Error .= "Password must match. <br>";
}
if(strlen($DATA_OBJ->password) < 8)
{
    $Error .= "Password must be at least 8 characters long. <br>";
}
   }

    if($Error == "")
    {
    $query = "insert into users (userid,username,email,password,date) values (:userid,:username,:email,:password,:date)";
    $result = $DB->write($query,$data);

    if($result)
    {
        $info->message = "Your profile was created";
        $info->data_type = "info";
        echo json_encode($info);
    }
    else
    {
        $info->message = "Your profile was NOT created due to an error";
        $info->data_type = "error";
        echo json_encode($info);

    }
}else{
    $info->message = $Error;
    $info->data_type = "error";
    echo json_encode($info);
}