
<?php
   if(isset($_POST['error']) & isset($_POST['status'])){
      $payment_errors ="Your registration and payment Failed";
   }
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

if(isset($payment_errors)){
   echo '
   <div class="message">
      <span  style="text-align:center;color:red">'.$payment_errors.'</span>
      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
   </div>
   ';
}
?>
   
<div class="form-container">

   <form action="register_pay.php" method="post">
      <h3>register now</h3>
      <input type="text" name="name" placeholder="Enter your name" required class="box">
      <input type="number" name="phone" placeholder="Enter your phone" required class="box">
      <input type="email" name="email" placeholder="Enter your email" required class="box">
      <input type="password" name="password" placeholder="Enter your password" required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input type="hidden" name="amount" value="100">
      <select name="user_type" class="box">
         <option value="user">user</option>
         <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="Register now with pay by SSL commerz" class="btn">
      <p style="color:green"><b>Payable Amount is <span style="color:red">100 TK</span></b></p>
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>