<?php

class AdminUtils
{
    private $conn;
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

    function displayOrderData()
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

    function deleteOrder($id)
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

    





}
