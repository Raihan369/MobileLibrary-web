<?php

include 'config.php';

    error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require_once(__DIR__ . "/lib/SslCommerzNotification.php");

	use SslCommerz\SslCommerzNotification;

	if(isset($_POST['submit'])){

		$post_data = array();

		$post_data['total_amount'] = $_POST['amount'];
		$post_data['currency'] = "BDT";
		$post_data['tran_id'] = "SSLCZ_TEST_" . uniqid();
	
		# CUSTOMER INFORMATION
		$post_data['cus_name'] = isset($_POST['name']) ? $_POST['name'] : "John Doe";
		$post_data['cus_email'] = isset($_POST['email']) ? $_POST['email'] : "john.doe@email.com";
		$post_data['cus_add1'] = "Dhaka";
		$post_data['cus_add2'] = "Dhaka";
		$post_data['cus_city'] = "Dhaka";
		$post_data['cus_state'] = "Dhaka";
		$post_data['cus_postcode'] = "1000";
		$post_data['cus_country'] = "Bangladesh";
		$post_data['cus_phone'] = isset($_POST['customer_mobile']) ? $_POST['customer_mobile'] : "01711111111";
		$post_data['cus_fax'] = "01711111111";
	
		# SHIPMENT INFORMATION
		$post_data["shipping_method"] = "YES";
		$post_data['ship_name'] = "Store Test";
		$post_data['ship_add1'] = "Dhaka";
		$post_data['ship_add2'] = "Dhaka";
		$post_data['ship_city'] = "Dhaka";
		$post_data['ship_state'] = "Dhaka";
		$post_data['ship_postcode'] = "1000";
		$post_data['ship_phone'] = "";
		$post_data['ship_country'] = "Bangladesh";
	
		$post_data['emi_option'] = "1";
		$post_data["product_category"] = "Electronic";
		$post_data["product_profile"] = "general";
		$post_data["product_name"] = "Computer";
		$post_data["num_of_item"] = "1";
        


        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
        $user_type = $_POST['user_type'];

    
        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND phone = '$phone'") or die('query failed');

        if(mysqli_num_rows($select_users) > 0){
            $message[] = 'user already exist!';
        }else{
            if($pass != $cpass){
                $message[] = 'confirm password not matched!';
            }else{

				$trans_ids = $post_data['tran_id'];
				$amount    = $_POST['amount'];
				
                mysqli_query($conn, "INSERT INTO `users`(name, phone, email, password, user_type, trans_id, amount) VALUES('$name', '$phone','$email', '$cpass', '$user_type','$trans_ids','$amount')") or die('query failed');

                if($user_type=='user'){

                    $_SESSION['success'] = 'Transaction successful. Thank you.';
                    $sslcomz = new SslCommerzNotification();
                    $sslcomz->makePayment($post_data, 'hosted');
                }

                $message[] = 'registered successfully!';
                header('location:login.php');
            }
        }
    }

?>