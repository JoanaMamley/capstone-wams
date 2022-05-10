<?php

require 'connect.php';

// if(isset($_GET['insert']))
// {
//     $data = $_GET['data'];
//     $value = $_GET['value'];

//     $query = "INSERT INTO `sensordata` (`data`,`value`) VALUES ('$data','$value')";
//     $result = mysqli_query($con,$query);

//     if($result){
//         echo "success";
//     }
//     else{
//         echo "error".mysqli_error($con);
//     }
// }
// else{
//     echo "Error";
// }

if (isset($_POST['get_id'])){
    echo "welcome";
}

?>