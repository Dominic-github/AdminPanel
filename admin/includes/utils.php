<?php

    class Utils {
        private $conn;
        public function __construct(){
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
            $fname = htmlspecialchars($data["fname"]);
            $username = htmlspecialchars($data["username"]);
            $email = htmlspecialchars($data["email"]);
            $password = htmlspecialchars($data["password"]);
            $phone = htmlspecialchars($data["phone"]);
            $address = htmlspecialchars($data["address"]);

            // Check if the user already exists
            $checker = "SELECT * FROM table_user WHERE username='$username' OR email='$email'";
            $resultChecker = mysqli_query($this->conn, $checker);

            if (mysqli_num_rows($resultChecker) > 0) {
                $response["code"] = "999";
                $response["msg"] = "User already exists!";

            } else {

                $sql = "INSERT INTO table_user(name,username,email,password,phone,address) VALUES('$fname','$username','$email', '$password', '$phone', '$address')";
                $result = mysqli_query($this->conn, $sql);

                if(!$result){
                    $response["code"] = "999";
                    $response["msg"] = "Failed to insert data!";
                }else {

                    $response["code"] = "200";
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
            $sql = "SELECT * FROM table_user WHERE email='$username' AND password='$password'";
        } else {
            $sql = "SELECT * FROM table_user WHERE username='$username' AND password='$password'";
        }

        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $response["code"] = "200";
            $response["msg"] = "Login successful";


        } else {    
            $response["code"] = "999";
            $response["msg"] = "Invalid credentials";
        }

        return $response;
    }


    function addOrder($data){
        $username = htmlspecialchars($data["username"]);

        $userId = 1;
        $amount = $data["amount"];
        $order_status = true;
    }


    function fetchCategories(){

        $sql = "SELECT * FROM table_cat";

        $result = mysqli_query($this->conn, $sql);

        $catInfo = array();

        if(mysqli_num_rows($result)>0){

            $catInfo = array();
            while($row = $result->fetch_assoc()){
                $catInfo [] = $row;
            }

            $json_data = json_encode($catInfo, JSON_PRETTY_PRINT);
            header("Content-type: application/json");
            return $json_data;

        }else{
            return "no data found";
        }

    }

    function fetchProducts()
    {

        $sql = "SELECT * FROM table_product";

        $result = mysqli_query($this->conn, $sql);

        $proInfo = array();

        if (mysqli_num_rows($result) > 0) {

            $proInfo = array();
            while ($row = $result->fetch_assoc()) {
                $proInfo[] = $row;
            }

            $json_data = json_encode($proInfo, JSON_PRETTY_PRINT);
            header("Content-type: application/json");
            return $json_data;
        } else {
            return "no data found";
        }
    }

    function fetchOrders(){

        $sql = "SELECT * FROM table_order INNER JOIN table_order_detail ON table_order_detail.order_id = table_order.id WHERE table_order.userId=1";

        $result = mysqli_query($this->conn, $sql);

        $Order = array();

        if (mysqli_num_rows($result) > 0) {

            $orderInfo= array();
            while ($row = $result->fetch_assoc()) {
                $orderInfo[] = $row;
            }

            $json_data = json_encode($proInfo, JSON_PRETTY_PRINT);
            header("Content-type: application/json");
            return $json_data;
        } else {
            return "no data found";
        }
    }


}

?>