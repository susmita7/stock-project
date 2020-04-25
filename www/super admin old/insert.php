<?php

$connect =mysqli_connect("localhost" , "root" ,"" ,"project");

$sql ="INSERT INTO colleges (clg_name) VALUES ('".$_POST["clg_name"]."')";
if(mysqli_query($connect, $sql)){
    echo "new record";
}else{
    echo "error:" . $sql . "<br>" .
    
    mysqli_error($connect);
}

?>