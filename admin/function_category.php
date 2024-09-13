<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert company
function cate_insert() {
    global $conn;
    if (isset($_POST['btnsave'])) {
        $categoryname = $conn->real_escape_string($_POST['categoryname']);
        $description = $conn->real_escape_string($_POST['description']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $categoryimage = $_FILES['categoryimage']['name'];
        $categoryimageTmp = $_FILES['categoryimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $categorynewimage = $currentdate . '_' . rand() . '_' . $categoryimage;

        if (!empty($categoryimage)) {
            $sqlcategoryinsert = "INSERT INTO `category` ( `Name`, `Description`, `CreateBy`,  `Image`)
                                 VALUES ( '$categoryname', '$description', '$createby', '$categorynewimage')";
            move_uploaded_file($categoryimageTmp, './ImageCategory/' . $categorynewimage);
        } else {
            $sqlcategoryinsert = "INSERT INTO `category` ( `Name`, `Description`, `CreateBy`,  `Image`)
                                 VALUES ( '$categoryname', '$description', '$createby', 'no_image.png')";
        }

        if ($conn->query($sqlcategoryinsert) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "category added successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "cate-add.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error adding the category. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "cate-add.php";
                        });
                    });
                  </script>';
        }
    }
}

// update category
function category_update() {
    global $conn;

    if (isset($_REQUEST['btnupdate'])) {
        $categoryid = $conn->real_escape_string($_REQUEST['Id']);
        $categorycode = $conn->real_escape_string($_POST['categorycode']);
        $categoryname = $conn->real_escape_string($_POST['categoryname']);
        $description = $conn->real_escape_string($_POST['description']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $categoryimage = $_FILES['categoryimage']['name'];
        $categoryimageTmp = $_FILES['categoryimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $updateat = $conn->real_escape_string($_REQUEST['updateat']);
        $update = $updateat . $currentdate;
        $categorynewimage = $currentdate . '_' . rand() . '_' . $categoryimage;

        if (!empty($categoryimage)) {
            $getImage = $conn->query("SELECT `Image` FROM `category` WHERE `Id`='$categoryid'")->fetch_assoc();
            if ($getImage) {
                $oldImage = 'Imagecategory/' . $getImage['Image'];
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            move_uploaded_file($categoryimageTmp, 'Imagecategory/' . $categorynewimage);
            $ImageUpdate = "`Image`='$categorynewimage',";
        } else {
            $ImageUpdate = "";
        }

        $sqlcategoryupdate = "UPDATE `category` SET 
                        `Name`='$categoryname', `Code`= `description`='$description', $ImageUpdate `CreateBy`='$createby', `UpdateAt`='$update', `Remark`='$remark' WHERE `Id`='$categoryid'";

        // Remove trailing comma if $ImageUpdate is empty
        $sqlcategoryupdate = str_replace(", WHERE", " WHERE", $sqlcategoryupdate);

        if ($conn->query($sqlcategoryupdate) === TRUE) {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Success",
                            text: "category updated successfully",
                            icon: "success"
                        }).then(function() {
                            window.location = "category-list.php";
                        });
                    });
                  </script>';
        } else {
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error updating the category. Please try again. Error: ' . $conn->error . '",
                            icon: "error"
                        }).then(function() {
                            window.location = "category-list.php";
                        });
                    });
                  </script>';
        }
    }
}

// function category_delete(){
//     global $conn;
//     if (isset($_GET['delId'])) {
//         $delId = mysqli_real_escape_string($conn, $_GET['delId']);
//         $sqlcategorydelete = "UPDATE `category` SET `del` =0 WHERE `Id` = '$delId'";
//         if($conn->query($sqlcategorydelete) === TRUE) {
//             echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
//                         <strong>Delete Success.</strong>
//                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//                             <span aria-hidden="true">&times;</span>
//                         </button>
//                     </div>';
//         }else {
//             echo "Error deleting record: " .$conn->error;
//         }
//     }else {
//         echo "";
//     }
// }

function category_delete(){
    global $conn;
    if (isset($_GET['delId'])) {
        $delId = mysqli_real_escape_string($conn, $_GET['delId']);
        
        // List of tables and the corresponding foreign key column that reference the category ID
        $foreignTables = [
            'user' => 'categoryId',
            'employee' => 'categoryId',
            'invoice' => 'categoryId',
            'customer' => 'categoryId',
            // Add more tables and their foreign key columns here
        ];
        
        $canDelete = true;
        foreach ($foreignTables as $table => $column) {
            $checkForeignKey = "SELECT COUNT(*) as count FROM `$table` WHERE `$column` = '$delId'";
            $resultForeignKey = $conn->query($checkForeignKey);
            $rowForeignKey = $resultForeignKey->fetch_assoc();
            
            if ($rowForeignKey['count'] > 0) {
                $canDelete = false;
                break;
            }
        }
        
        if ($canDelete) {
            $sqlcategorydelete = "UPDATE `category` SET `del` = 0 WHERE `Id` = '$delId'";
            if ($conn->query($sqlcategorydelete) === TRUE) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
                        <strong>Delete Success.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-danger">
                    <strong>Cannot delete category. It is being referenced in other records.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
        }
    } else {
        echo "";
    }
}


?>

