<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert customer
function customer_insert() {
    global $conn;
    if(isset($_POST['btnsave'])) {
        $code = $conn->real_escape_string($_POST['code']);
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $dateofbirth = $conn->real_escape_string($_POST['dateofbirth']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $email = $conn->real_escape_string($_POST['email']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $address = $conn->real_escape_string($_POST['address']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $currency = $conn->real_escape_string($_POST['currency']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        //$status = isset($_POST['status']) ? 1 : 0;
        $customerimage = $_FILES['customerimage']['name'];
        $customerimageTmp = $_FILES['customerimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $customernewimage = $currentdate . '_' . rand() . '_' . $customerimage;

        if(!empty($customerimage)) {
            $sqlcustomerinsert = "INSERT INTO `customer` (`Code`,`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Currency`, `CreateBy`, `Remark`, `Image`) 
                                VALUES ('$code','$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$email', '$telephone', '$address', 
                                '$branch', '$currency', '$createby', '$remark', '$customernewimage')";
                                move_uploaded_file($customerimageTmp, './ImageCustomer/' . $customernewimage);
        } else {
            $sqlcustomerinsert = "INSERT INTO `customer` (`Code`,`Firstname`, `Lastname`, `Gender`, `Dob`, `Nation`, `Email`, `Tel`, `Address`,
                                `OutletId`, `Currency`, `CreateBy`, `Remark`, `Image`) 
                                VALUES ('$code','$firstname', '$lastname', '$gender', '$dateofbirth', '$nationality', '$email', '$telephone', '$address', 
                                '$branch', '$currency', '$createby', '$remark', 'no_image.png')";
        }

        if ($conn->query($sqlcustomerinsert) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Customer added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "customer-add.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the customer. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "customer-add.php";
                        });
                    });
                  </script>';
        }
    }
}

//update customer
function customer_update() {
    global $conn;

    if (isset($_REQUEST['btnupdate'])) {
        $customerid = $conn->real_escape_string($_REQUEST['Id']);
        $code = $conn->real_escape_string($_POST['code']);
        $firstname = $conn->real_escape_string($_POST['firstname']);
        $lastname = $conn->real_escape_string($_POST['lastname']);
        $gender = $conn->real_escape_string($_POST['gender']);
        $dateofbirth = $conn->real_escape_string($_POST['dateofbirth']);
        $nationality = $conn->real_escape_string($_POST['nationality']);
        $email = $conn->real_escape_string($_POST['email']);
        $telephone = $conn->real_escape_string($_POST['telephone']);
        $address = $conn->real_escape_string($_POST['address']);
        $branch = $conn->real_escape_string($_POST['branch']);
        $currency = $conn->real_escape_string($_POST['currency']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $customerimage = $_FILES['customerimage']['name'];
        $customerimageTmp = $_FILES['customerimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = isset($_REQUEST['updateat']) ? $conn->real_escape_string($_REQUEST['updateat']) : '';
        $update = $updateat . $currentdate;
        $customernewimage = $currentdate . '_' . rand() . '_' . $customerimage;

        if (!empty($customerimage)) {
            $getImage = $conn->query("SELECT `Image` FROM `customer` WHERE `Id`='$customerid'")->fetch_assoc();
            if ($getImage) {
                $oldImage = 'ImageCustomer/' . $getImage['Image'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            move_uploaded_file($customerimageTmp, 'ImageCustomer/' . $customernewimage);
            $profileUpdate = "`Image`='$customernewimage',";
        } else {
            $profileUpdate = "";
        }

        $sqlcustomerupdate = "UPDATE `customer` SET `Code`='$code', `Firstname`='$firstname', `Lastname`='$lastname', `Gender`='$gender', `Dob`='$dateofbirth', `Nation`='$nationality', 
                                `Email`='$email', `Tel`='$telephone', `Address`='$address', `OutletId`='$branch', `Currency`='$currency', `CreateBy`='$createby', `UpdateAt`='$update',$profileUpdate `Remark`='$remark'  
                              WHERE `Id`='$customerid'";
        // Remove trailing comma if $profileUpdate is empty
        $sqlcustomerupdate = str_replace(", WHERE", " WHERE", $sqlcustomerupdate);

        if($conn->query($sqlcustomerupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "Customer updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "customer-list.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the Customer. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "customer-list.php";
                        });
                    });
                  </script>';
        }
    }
}


// delete customer
function customer_delete() {
    global $conn;
    if(isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);

        // List of tables and the corresponding foreign key column that reference the company ID
        $foreignTables = [
            'invoice' => 'CustomerId',
            // Add more tables and their foreign key columns here
        ];
        $canDelete = true;
        foreach ($foreignTables as $table => $column) {
            $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
            $resultForeignKey = $conn->query($checkForeignKey);
            $rowForeignKey = $resultForeignKey->fetch_assoc();

            if($rowForeignKey['count'] > 0) {
                $canDelete = false;
                break;
            }
        }
        if ($canDelete) {
            $sqlcustomerdelete = "UPDATE `customer` SET `del` = 0 WHERE `Id` = '$delId'";
            if($conn->query($sqlcustomerdelete) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        <strong>Delete Success.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            }else {
                echo "Error deleting record: " . $conn->error;
            }
        }else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    <strong>Cannot delete customer. It is being referenced in other records.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    }else {
        echo "";
    }
}
?>