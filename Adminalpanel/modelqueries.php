<?php
class queries{
    public $conn;
    public $arr;
    // constructor 
    public function __construct(){
        $this->conn=new mysqli ("localhost","root","","electronic");
    }
public function cartprice($email){
    $sql="select discounted_price from products,tmp_table where products.id=tmp_table.product_id";
    $res=$this->conn->query($sql);
    $total=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $total=$total+$row["discounted_price"];
                
        }
        
    }
    return $total;

}
public function TotalCartItems($email){
    $sql="select discounted_price from products,tmp_table where products.id=tmp_table.product_id";
    $res=$this->conn->query($sql);
    $total=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $total=$total+1;
                
        }
        
    }
    return $total;

}

    // add product funciton  to web
    public function addproduct(){
        $sql="select * from products order by id desc";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
        
    }
    // search the product 
    public function search($search){
        $sql="select * from products where LOWER(title) LIKE LOWER('%".$search."%')";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
    }

    public function AddProductToShop($category){
        $sql=$sql="select * from products where category= '".$category."' order by id desc";
            $res=$this->conn->query($sql);
            if($res){
                return $res;
            }

        }
    

    
    // add product funciton limit 6 to web 
    public function addproduct6(){
        $sql="select * from products order by id desc limit 6 ";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
        
    }

    // add the trending product 

    public function addtrendingproduct(){
        $sql="select * from products where tag ='Trending' order by id desc limit 8 ";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
        
    }
    
    // delete product
    public function deleteproduct($id){
        $sql="delete from products where id=".$id;
        $res=$this->conn->query($sql);
        if($res){
            return True;
        }
    
    }
    //add your messager
    public function addMessage($name,$email,$phone,$project,$subject,$message){
        $sql="insert into message(name,email,phone,project,subject,message) values('".$name."','".$email."','".$phone."','".$project."','".$subject."','".$message."')";
        $res=$this->conn->query($sql);
        if($res){
            return True;
        }

    


    }
            // add product sql
    public function addproductsql($name,$image,$price,$discounted_price,$tag,$category){
        $sql="insert into products(title,image,price,discounted_price,tag,category) values('".$name."','".$image."','".$price."','".$discounted_price."','".$tag."','".$category."')";
        $res=$this->conn->query($sql);
        if($res){
            return True;
        }
    }
     

    //select product from sql
    public function veiw(){
        $sql="select * from products order by id desc";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }

    }

    //select product from sql
    public function veiwOrder($email){
        $sql="select * from register where email ='".$email."'";
        $res=$this->conn->query($sql);
        if($res->num_rows>0){
            while($row=mysqli_fetch_assoc($res)){
                $status=$row["status"];
            }
        }


        if($status==1){
        $sql="select * from products,orders where orders.product_id = products.id order by orders.id desc";}
        else if ($status==0){
            $sql="select * from products,orders where orders.product_id = products.id and orders.email='".$email."' order by orders.id desc";
        }

        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }

    }

    //emailstatus
    public function emailStatus($email){
        $sql="select * from register where email ='".$email."'";
        $res=$this->conn->query($sql);
        if($res->num_rows>0){
            while($row=mysqli_fetch_assoc($res)){
                $status=$row["status"];
            }
        }
        return $status;
    }
    //edit product
    public function editproduct($id){
        $sql="select * from products where id =".$id;
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
    }

    // edit product sql
    public function editproductsql($id,$name,$price,$discounted_price,$tag,$category){
        $sql="update products set title='".$name."' , price='".$price."',discounted_price='".$discounted_price."',tag ='".$tag."' ,category='".$category."' where id =".$id." ";
        $res=$this->conn->query($sql);
        if($res){
            header("location:veiwproduct.php");
        }
    }

    //add user to the databases
    public function adduser($name,$email,$password,$image,$address){
        $sql="insert into register(name,email,password,image,address) values('".$name."','".$email."','".$password."','".$image."','".$address."')";
        $res=$this->conn->query($sql);
        if($res){
            return true;
        }
    }

    //log in the user
    public function loginUser($email,$password){
        $sql="select * from register where email='".$email."' and password ='".$password."'";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
            
        }
        else{
            return False;
            
        }
    }


    //logout

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header("location:../index.php");

    }


    //select user with email
    public function userbyEmail($email){
        $sql="select * from register where email ='".$email."'";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }

    }


    // add product to tmp cart

    public function tmp($productId,$name,$email){
        $sql="insert into tmp_table(product_id,title,email) values(".$productId.",'".$name."','".$email."')";
        $res=$this->conn->query($sql);
        if($res){
            return True;  
        }
    }

    // veiw cart in cart page
    public function veiwcart($email){
        $sql="select * from tmp_table,products where email='".$email."' and tmp_table.product_id=products.id";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
    }

    // remove item from cart

    public function removeItem($id,$email){
        $sql="delete from tmp_table where product_id=".$id." and email='".$email."'";
        $res=$this->conn->query($sql);
        if($res){
            return true;
        }
    }

    // veiw all user

    public function veiwUser(){
        $sql="select * from register order by id desc";
        $res=$this->conn->query($sql);
        if($res){
            return $res;
        }
    }

    //deactivate and activate the user
    public function statusUser($email){
        $sql="select * from register where email='".$email."'";
        $res=$this->conn->query($sql);
        if($res){
            if($res->num_rows>0){
                while($row=mysqli_fetch_assoc($res))
                    $active=$row["active"];
                if($active==1){
                    $sql="update register set active=0 where email='".$email."'";
                    $res=$this->conn->query($sql);
                    if($res){
                        return true;
                    }

                
                }
                if($active==0){
                    $sql="update register set active=1 where email='".$email."'";
                    $res=$this->conn->query($sql);
                    if($res){
                        return true;
                    }
                }
            }
        }
    }


    //check if login possible
    public function checkstatus($email){
        $sql="select * from register where email='".$email."'";
        $res=$this->conn->query($sql);
        if($res->num_rows>0){
            while($row=mysqli_fetch_assoc($res)){
                return $active=$row["active"];
               
                
            }
        }
    }

    // checkout

    public function checkout($email){
        $sql="select * from tmp_table where email='".$email."'";
        $result=$this->conn->query($sql);
        if($result->num_rows>0){
            while($row=mysqli_fetch_assoc($result)){
                $email=$row["email"];
                $title=$row["title"];
                $id=$row["id"];
                $product_id=$row["product_id"];
                $sql="insert into orders(product_id,title,email) values(".$product_id.",'".$title."','".$email."')";
                $res=$this->conn->query($sql);
                $sql="delete from tmp_table where title='".$title."' and email='".$email."' and  id=".$id;
                $res=$this->conn->query($sql);

            }
        }
        
    }
   // update order status
    public function orderStatusChange($id,$orderstatus){
        
        if($orderstatus==0){
            $new_status=1;
        }
        if($orderstatus==1){
            $new_status=2;
        }
        
        if($orderstatus==2){
            $new_status=2;
        }
        $sql="update orders set status = ".$new_status." where id = ".$id;
        $res=$this->conn->query($sql);
        if($res){
                return True;
        }
    }





public function getInfo(){
    $list=[];
    // product listed
    $sql="select * from products ";
    $res=$this->conn->query($sql);
    $product_num=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $product_num++;

        }
        
    }
    $list[]=$product_num;

    //Registered Customers
    $sql="select * from register ";
    $res=$this->conn->query($sql);

    $customer_num=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $customer_num++;

        }
        
    }
    $list[]=$customer_num;

    
    //total orders
    $sql="select * from orders ";
    $res=$this->conn->query($sql);

    $order_num=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $order_num++;

        }
        
    }
    $list[]=$order_num;


    
    //total pending
    $sql="select * from orders where status=0 ";
    $res=$this->conn->query($sql);

    $pending_num=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $pending_num++;

        }
        
    }
    $list[]=$pending_num;


    
    //processing orders
    $sql="select * from orders where status =1 ";
    $res=$this->conn->query($sql);

    $process_num=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $process_num++;

        }
        
    }
    $list[]=$process_num;


    
    //total orders received and revenue 
    $sql="select * from orders ,products where orders.status =2 and products.title=orders.title";
    $res=$this->conn->query($sql);

    $received_num=0;
    $revenue=0;
    if($res->num_rows>0){
        while($row=mysqli_fetch_assoc($res)){
            $received_num++;
            $revenue+=$row["discounted_price"];

        }
        
    }
    $list[]=$received_num;
    $list[]=$revenue;
    return $list;


    

}

// public function getInfo() {
//     $list = [];

//     // Product listed
//     $sql = "SELECT * FROM products";
//     $result = $this->conn->query($sql);
//     if ($result->num_rows > 0) {
//         $product_count = 0;
//         while ($row = mysqli_fetch_assoc($result)) {
//             $product_count++;
//         }
//         $list[] = $product_count;
//     }

//     // Registered Customers
//     $sql = "SELECT * FROM register";
//     $result = $this->conn->query($sql);
//     if ($result->num_rows > 0) {
//         $customer_count = 0;
//         while ($row = mysqli_fetch_assoc($result)) {
//             $customer_count++;
//         }
//         $list[] = $customer_count;
//     }

//     return $list;
// }




}
?>