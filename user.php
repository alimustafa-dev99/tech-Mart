<?php
session_start();
//echo $_SESSION["userEmail"];
if(!$_SESSION["userEmail"]){
    echo"we are logged out";
}
else{
    echo "you are logged in ";
}

?>