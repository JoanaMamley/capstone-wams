<?php 

require('../model/dailyLog.php');

$db = new Database();

if(isset($_POST['action']) && $_POST['action']== "view"){
    $output = '';
    $data = $db->read();
   //  print_r($data);
    if($db->totalRowCount()>0){ 
        $output .= '<table class="table table-striped table-sm table-bordered ml-1 mr-1 h4">
        <thead>
            <tr class="text-center">
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Fingerprint ID</th>
            <th>Date</th>
            <th>Time In</th>
            <th>Time Out</th>
            </tr>
        </thead>
        <tbody>
        ';
        foreach($data as $row){
            $output .= '<tr class="text-center text-secondary">
            <td>'.$row['id'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['finger_id'].'</td>
            <td>'.$row['date'].'</td>
            <td>'.$row['time_in'].'</td>
            <td>'.$row['time_out'].'</td>
           </tr>';
        }
        $output .='</tbody></table>';
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary mt-5">:( no any user present in the database )</h3>';
    }
}

if(isset($_GET['export']) && $_GET['export'] == "excel"){
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=dailyLog.xls");
    header("pragma: no-cache");
    header("Expires: 0");

    $data = $db->read();
    echo '<table border="1">';
    echo '<tr><th>#</th><th>Name</th><th>Email</th><th>Fingerprint ID</th><th>Date</th><th>Time In</th><th>Time Out</th>';

    foreach($data as $row){
        echo '<tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['finger_id'].'</td>
        <td>'.$row['date'].'</td>
        <td>'.$row['time_in'].'</td>
        <td>'.$row['time_out'].'</td>
        </tr>';
    }
    echo '</table>';
}

?>