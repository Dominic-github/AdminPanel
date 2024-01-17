<?php

class AdminUtils
{
    private  $conn;
    public function __construct()
    {
        $DB_NAME = "shop";
        $DB_USER = "root";
        $DB_PASS = "";
        $DB_HOST = "localhost";

        $this->conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        if (!$this->conn) {
            die("Error: failed to connect db" . mysqli_connect_error());
        }
    }


    function register($data)
    {

        $username = htmlspecialchars($data["username"]);
        $email = htmlspecialchars($data["email"]);
        $password = password_hash($data["password"], PASSWORD_BCRYPT);

        // Check if the user already exists
        $checker = "SELECT * FROM admin WHERE username='$username' OR email='$email'";
        $resultChecker = mysqli_query($this->conn, $checker);

        if (mysqli_num_rows($resultChecker) > 0) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "User already exists!";
        } else {

            $sql = "INSERT INTO admin(username,email,password) VALUES('$username','$email', '$password')";
            $result = mysqli_query($this->conn, $sql);

            if (!$result) {
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to insert data!";
            } else {

                $response["code"] = "200";
                $response["status"] = "true";
                $response["msg"] = "Registration successed";
            }
        }

        return $response;
    }

    function login($data)
    {
        $username = htmlspecialchars($data["username"]);
        $password = $data["password"];


        // Check if the input is an email
        $isEmail = filter_var($username, FILTER_VALIDATE_EMAIL);

        // Build the SQL query based on whether it's an email or username
        if ($isEmail) {
            $sql = "SELECT * FROM admin WHERE email='$username'";
        } else {
            $sql = "SELECT * FROM admin WHERE username='$username'";
        }

        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
           while ($row = mysqli_fetch_assoc($result)) {

                if(password_verify($password, $row["password"])) {
                    $response["code"] = "200";
                    $response["status"] = "true";
                    $response["msg"] = "Login successful";
                }else {

                    $response["code"] = "999";
                    $response["status"] = "false";
                    $response["msg"] = "Invalid credentials";

                }

           }
        } 
        return $response;
    }

    function addCategory($data){
        $catName = htmlspecialchars($data["catName"]);
        $catDesc = htmlspecialchars($data["catDesc"]);
        $catImg = $_FILES['catImg']['name'];
        $tmp_name = $_FILES['catImg']['tmp_name'];


        $sql = "INSERT INTO table_cat(catName, catDesc, catImg, catStatus) VALUES('$catName','$catDesc','$catImg', 'true')";



        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Failed to insert data!";
        } else {

            move_uploaded_file($tmp_name, __DIR__ . '/../category/uploads/' . $catImg);
            $response["code"] = "200";
            $response["status"] = "true";
            $response["msg"] = "Registration successed";

        }

        return $response;

    }

    function displayCatData(){
        $query = "SELECT * FROM table_cat";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "no data";
            return $response;
        }else {
            return $result;
        }
    }

    function deleteCat($id)
    {
        $catchImg = "SELECT * FROM table_cat WHERE id='$id'";
        $deleteResult = mysqli_query($this->conn, $catchImg);

        if (!$deleteResult) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Error querying the database: " . mysqli_error($this->conn);
            return $response;
        }

        if (mysqli_num_rows($deleteResult) > 0) {
            $catInfoDelete = mysqli_fetch_assoc($deleteResult);
            $deleteImgData = $catInfoDelete["catImg"];

            $sql = "DELETE FROM table_cat WHERE id=$id";
            $result = mysqli_query($this->conn, $sql);

            if (!$result) {
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to delete category: " . mysqli_error($this->conn);
            } else {
                $filePath = "uploads/" . $deleteImgData;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $response["code"] = "200";
                $response["status"] = "true";
                $response["msg"] = "Category deleted successfully";
            }
        } else {
            $response["code"] = "404";
            $response["status"] = "false";
            $response["msg"] = "Category not found in the database";
            header("Location: manage_cat.php");
        }

        return $response;
    }

    function updateCat($id, $data){

        $catName = htmlspecialchars($data["catName"]);
        $catDesc = htmlspecialchars($data["catDesc"]);
        $catImg = $_FILES['catImg']['name'];
        $tmp_name = $_FILES['catImg']['tmp_name'];


        $sql = "UPDATE table_cat SET catName='$catName' catDesc='$catDesc' catImg='$catImg' catStatus='True' WHERE id='$id'";


        $catchImg = "SELECT * FROM table_cat WHERE id='$id'";
        $deleteResult = mysqli_query($this->conn, $catchImg);
        $catInfoDelete = mysqli_fetch_assoc($deleteResult);
        $deleteImgData = $catInfoDelete["catImg"];

        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Failed to insert data!";
        } else {

    

            $filePath = "uploads/" . $deleteImgData;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            move_uploaded_file($tmp_name, 'uploads/' . $catImg);
            $response["code"] = "200";
            $response["status"] = "true";
            $response["msg"] = "Update successed";
        }

        return $response;
        
    }


    function addProduct($data)
    {
        $proCatId = htmlspecialchars($data["proCatId"]);
        $proName = htmlspecialchars($data["proName"]);
        $proDesc = htmlspecialchars($data["proDesc"]);
        $proPrice = htmlspecialchars($data["proPrice"]);
        $proImage = $_FILES['proImage']['name'];
        $tmp_name = $_FILES['proImage']['tmp_name'];


        $sql = "INSERT INTO table_product(cat_id, pName, pDesc, pImage, pPrice, pStatus) VALUES('$proCatId','$proName','$proDesc', '$proImage', '$proPrice', 'true')";



        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Failed to insert data!";
        } else {

            move_uploaded_file($tmp_name, __DIR__ . '/../product/uploads/' . $proImage);
            $response["code"] = "200";
            $response["status"] = "true";
            $response["msg"] = "Registration successed";
        }

        return $response;
    }


    function displayProductData()
    {
        $query = "SELECT * FROM table_product";
        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "no data";
            return $response;
        } else {
            return $result;
        }
    }

    function deleteProduct($id)
    {
        $catchImg = "SELECT * FROM table_product WHERE id='$id'";
        $deleteResult = mysqli_query($this->conn, $catchImg);

        if (!$deleteResult) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Error querying the database: " . mysqli_error($this->conn);
            return $response;
        }

        if (mysqli_num_rows($deleteResult) > 0) {
            $catInfoDelete = mysqli_fetch_assoc($deleteResult);
            $deleteImgData = $catInfoDelete["pImage"];

            $sql = "DELETE FROM table_product WHERE id=$id";
            $result = mysqli_query($this->conn, $sql);

            if (!$result) {
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to delete category: " . mysqli_error($this->conn);
            } else {
                
                $filePath =  __DIR__ . '/../product/uploads/' . $deleteImgData;

                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                $response["code"] = "200";
                $response["status"] = "true";
                $response["msg"] = "Category deleted successfully";
            }
        } else {
            $response["code"] = "404";
            $response["status"] = "false";
            $response["msg"] = "Category not found in the database";
            header("Location: manageProduct.php");
        }

        return $response;
    }


    function addOrder($data)
    {
        $userId = $data["userId"] ? $data["userId"] : 1;
        $amount = $data["amount"] ? $data["amount"] : 2831000;
        $quantity_list = $data["quantity"] ?  $data["quantity"] : [5,3,2,3,1];
        $order_status = "true";
        $productIdList = $data["productIdList"] ? $data["productIdList"] : '1,2,3,4,5';

        $orderImage = $_FILES['orderImg']['name'];
        $tmp_name = $_FILES['orderImg']['tmp_name'];

        $createOrder = "INSERT INTO `table_order`(userId, amount, orderImage, order_status) VALUES 
                        ('$userId', '$amount', '$orderImage' , '$order_status');         
        ";

        $last_id = 0;


        $result = mysqli_query($this->conn, $createOrder);
        
        
        if(!$result){
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Failed to insert data!";
            return $response;
            
        }else{
            if (!$result) {
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to insert data!";
                return $response;
            } else {

                $last_id =  $this->conn->insert_id;
            }
        }

        # Create Order_deltail   
        $getProduct= mysqli_query($this->conn,"SELECT *  FROM `table_product` where id in ($productIdList) ");
        $resultOrderDetail = "";

        $index = 0;
        while($row = mysqli_fetch_assoc($getProduct)){
            $product_id = $row['id'];
            $product_name = $row['pName'];
            $product_price = $row['pPrice'];
            $quantity = $quantity_list[$index];
            $subtotal = $quantity * $product_price;

        
            $createOrderDeltail = "INSERT INTO `table_order_detail` (order_id, product_id, pName, price_item, quantity, sub_total) VALUES 
            ('$last_id', '$product_id', '$product_name', '$product_price', '$quantity', '$subtotal')";
            
            if(!mysqli_query($this->conn, $createOrderDeltail)){
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to insert data!";
                return $response;
            }else {
                $response["code"] = "200";
                $response["status"] = "true";
                $response["msg"] = "Insert Order successed";
            }

            $index++;
          }


        move_uploaded_file($tmp_name, __DIR__ . '/../order/uploads/' . $orderImage);
        return $response;
    }


    function displayOrderData()
    {
        $query = "SELECT *  FROM  `table_order` 
                  ORDER BY 	`table_order` .created_at DESC";

        $result = mysqli_query($this->conn, $query);
        if (!$result) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "no data";
            return $response;
        } else {
            return $result;
        }
    }

    function deleteOrder($id)
    {
        $orderId = "SELECT * FROM table_order WHERE id='$id'";
        $resultGetId = mysqli_query($this->conn, $orderId);


        if (!$resultGetId) {
            $response["code"] = "999";
            $response["status"] = "false";
            $response["msg"] = "Error querying the database: " . mysqli_error($this->conn);
            return $response;
        }

        if (mysqli_num_rows($resultGetId) > 0) {

            $catInfoDelete = mysqli_fetch_assoc($resultGetId);
            $deleteImgData = $catInfoDelete["orderImage"];

            $deleteOder = "DELETE FROM table_order WHERE id = '$id' ";
            $deleteOderDetail = " DELETE FROM table_order_detail WHERE order_id = '$id' ";

            $resultDeleteOrder = mysqli_query($this->conn, $deleteOder);

            if (!$resultDeleteOrder) {
                $response["code"] = "999";
                $response["status"] = "false";
                $response["msg"] = "Failed to delete order: " . mysqli_error($this->conn);
                return $response;
                
                
            } else {
                $resultDeleteOrderDetail = mysqli_query($this->conn, $deleteOderDetail);

                if(!$resultDeleteOrderDetail){
                    $response["code"] = "999";
                    $response["status"] = "false";
                    $response["msg"] = "Failed to delete order: " . mysqli_error($this->conn);
                    return $response;
                }else{
                    $filePath =  __DIR__ . '/../order/uploads/' . $deleteImgData;

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                    $response["code"] = "200";
                    $response["status"] = "true";
                    $response["msg"] = "Order deleted successfully";
                    header("Location: managerOrder.php");
                }
            }
        } else {
            $response["code"] = "404";
            $response["status"] = "false";
            $response["msg"] = "Order not found in the database";
            header("Location: managerOrder.php");
        }

        return $response;
    }


}
