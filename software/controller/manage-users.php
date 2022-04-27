<?php 

require('../model/manage-users.php');

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
            <th>Gender</th>
            <th>Serial Number</th>
            <th>Fingerprint ID</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        ';
        foreach($data as $row){
            $output .= '<tr class="text-center text-secondary">
            <td>'.$row['id'].'</td>
            <td>'.$row['name'].'</td>
            <td>'.$row['email'].'</td>
            <td>'.$row['gender'].'</td>
            <td>'.$row['phone_number'].'</td>
            <td>'.$row['fingerprint_id'].'</td>
            <td>
                <a href="#" title="View Details" class="text-light infoBtn" id="'.$row['id'].'">
                <i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;


                <a href="#" title="Edit" class="text-light editBtn" data-toggle="modal" data-target="#editModal" id="'.$row['id'].'">
                <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;


                <a href="#" title="Delete" class="text-light delBtn" id="'.$row['id'].'">
                <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;

            </td></tr>';
        }
        $output .='</tbody></table>';
        echo $output;
    }else{
        echo '<h3 class="text-center text-secondary mt-5">:( no any user present in the database )</h3>';
    }
}

// insert a customer
if(isset($_POST['action']) && $_POST['action'] == "insert"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $fingerprint_id = $_POST['fingerprint_id'];

    $db->insert($name, $email, $gender, $phone_number, $fingerprint_id); 
}


// update a user
if(isset($_POST['edit_id'])){
    $id = $_POST['edit_id'];

    $row = $db->getUserBiId($id);
    echo json_encode($row);
}

if(isset($_POST['action']) && $_POST['action'] == 'update'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];

    $db->update($id,$name, $email,  $gender, $phone_number);
}

if(isset($_POST['del_id'])){
    $id = $_POST['del_id'];

    $db->delete($id);
}

if(isset($_POST['info_id'])){
    $id = $_POST['info_id'];
    $row = $db->getUserBiId($id);
    echo json_encode($row);
}

?>