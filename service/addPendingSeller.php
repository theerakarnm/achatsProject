<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

require_once "../config/dbcon.php";

$name = $_POST['name'];
$sername = $_POST['sername'];
$shopname = $_POST['shopname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$citizenId = $_POST['citizenId'];
$profile = $_FILES['profile']['name'];
$profile2 = $_FILES['profile2']['name'];

// echo $profile;

$tmp_name = $_FILES["profile"]["tmp_name"];
$t = explode('.', $profile); // split name and type ( image.jpg => Array( [0]->image, [1]->jpg ))
$type = end($t); //stored late array of $t
$data = file_get_contents($tmp_name);
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
// echo $base64;


$tmp_name2 = $_FILES["profile2"]["tmp_name"];
$t2 = explode('.', $profile2); // split name and type ( image.jpg => Array( [0]->image, [1]->jpg ))
$type2 = end($t2); //stored late array of $t
$data2 = file_get_contents($tmp_name2);
$base64_2 = 'data:image/' . $type2 . ';base64,' . base64_encode($data2);
// echo $base64;


// Get all the submitted data from the form
$sql = "INSERT INTO tmp_seller (tmp_seller_name,tmp_seller_sername,tmp_seller_shopname,tmp_seller_username,tmp_seller_email,tmp_seller_password,tmp_seller_address,tmp_seller_phone,tmp_seller_photo,tmp_seller_citizenid,tmp_seller_withcitizen)
VALUES('$name','$sername','$shopname','$username','$email','$password','$address','$phone','$base64','$citizenId','$base64_2')";


// Execute query
// $isDone = true;
$isDone = mysqli_query($con, $sql);

if ($isDone) {
  echo "<script>
          console.log('test');
          $(document).ready(function() {
              Swal.fire({
                  title: 'success',
                  text: 'Data inserted successfully!',
                  icon: 'success',
                  timer: 5000,
                  showConfirmButton: false
              });
          })
      </script>";

  header("refresh:2; url=../page/seller/signin.php");
} else {
  echo "fail";
}


// if ($result) {
//   echo "SAVE DONE";
// } else {
//   mysqli_error($connect);
// }
