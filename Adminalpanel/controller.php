<?php
session_start();

include("modelqueries.php");
$obj=new queries();

$res=$obj->addproduct();

//add product to sql




//---------------------adminal panel products  ---------------//
// Add product 

if(isset($_POST["addproduct"])){
    $name=$_POST["title"];
    $image=$_FILES["image"]["name"];
    $price=$_POST["price"];
    $discounted_price=$_POST["discounted_price"];
    $tag=$_POST["tag"];
    echo $category=$_POST["category"];
    if(move_uploaded_file($_FILES["image"]["tmp_name"],"../img/".$image)){
        Echo "insertrd";

    }
    $res=$obj->addproductsql($name,$image,$price,$discounted_price,$tag,$category);
    if($res){
        echo "inserted";
        header("location:veiwproduct.php");
    }

}

//add product to shop 

// edit product
if(isset($_POST["editproduct"])){
    $id=$_POST["id"];
    $name=$_POST["title"];
    $price=$_POST["price"];
    $discounted_price=$_POST["discounted_price"];
    $tag=$_POST["tag"];
    $category=$_POST["category"];
    $res=$obj->editproductsql($id,$name,$price,$discounted_price,$tag,$category);
    if($res){
        header("location:veiwproduct.php");
    }   
}

// delete product 
if(isset($_GET["deleteproduct"])){
if($_GET["deleteproduct"]=="yes"){
    echo"dlet product";
    $id=$_GET["id"];
    $res=$obj->deleteproduct($id);
    if($res){
        header("location:veiwproduct.php");
    }
    
}
}


//register the user
if(isset($_POST["registerUser"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $address=$_POST["address"];
    $image=$_FILES["image"]["name"];
    if(move_uploaded_file($_FILES["image"]["tmp_name"],"../img/".$image)){
        echo"inserted";
        $res=$obj->adduser($name,$email,$password,$image,$address);
        if($res){
            session_start();
            echo $_SESSION["userEmail"]=$email;
            header("location:../shop.php");
        }

    }
}

//loging the user
if(isset($_POST["loginUser"])){
    $email=$_POST["email"];
    $password=$_POST["password"];
    
    $active=$obj->checkstatus($email);
    if($active==1){

        $res=$obj->loginUser($email,$password);
        if($res->num_rows>0){
       // header("location:../shop.php");
            echo"login";
            session_start();
            echo $_SESSION["userEmail"]=$email;
            header("location:../index.php");
       
    
       }

        if($res->num_rows==0){
            header("Location:../invalidLogin.php");

    }
    }
    else if($active==0){
        echo"u cant log in ";
        header("location:../banned.php");
    

    }

}

//logout 
if(isset($_GET["logout"])){
    if($_GET["logout"] =="yes"){
        $obj->logout();
    }
}


// activate and deactivate 
if(isset($_GET["statusUser"])){
    if($_GET["statusUser"]=="change"){
        echo $email=$_GET["email"];
        $res=$obj->statusUser($email);
        if($res){
            header("location:veiwuser.php");
        }
       
    }
}


///////////////   cart systerm   //////////////////

// add to tmp email
if(isset($_GET["tmp"])){
echo $_GET["tmp"];
if($_GET["tmp"]=="yes"){
    echo $productId=$_GET["id"];
    echo $email=$_SESSION["userEmail"];
    echo $name=$_GET["product-name"];
    if($_SESSION["userEmail"]){
    $res=$obj->tmp($productId,$name,$email);
    if($res){
        header("location:../index.php");
            }

        }
    if(!$_SESSION["userEmail"]){
        header("location:../login.php");
    }  
    }
}



// add to checkout page
if(isset($_GET["removeItem"])){
    if($_GET["removeItem"]=="yes"){
        echo $email=$_GET["email"];
        echo $product_id=$_GET["id"];
        $res=$obj->removeItem($product_id,$email);
        if($res){
            header("location:../cart.php");
        }
    }
}

// procceed to check out 
if(isset($_GET["checkout"])){
    if($_GET["checkout"]=="yes"){
        $total=$_GET["total"];
        $email=$_GET["email"];
        $res=$obj->checkout($email);        
        header("location:../index.php");
        
     }
}


// order status process
if(isset($_GET["orderstatus"])){
    echo  $id= $_GET["id"];
    echo $orderstatus= $_GET["orderstatus"];
    $res=$obj->orderStatusChange($id,$orderstatus);
    if($res){
        header("location:veiworder.php");
    }
}


//add message
if(isset($_POST["addMessage"])){
    echo $name = $_POST["name"];
    echo $email = $_POST["email"];
    echo $phone = $_POST["phone"];
    echo $project = $_POST["project"];
    echo $subject = $_POST["subject"];
    echo $message = $_POST["message"];
    $res=$obj->addMessage($name,$email,$phone,$project,$subject,$message);
    if($res){
        header("location:../index.php");    
}
}














?>
