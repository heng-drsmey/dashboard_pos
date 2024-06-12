<!-- link sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php
include('cn.php');

//insert compaany condition table don't have column image.
// function company_insert() {
//     global $conn;

//     if (isset($_POST['btnsave'])) {
//         $companycode = $conn->real_escape_string($_POST['companycode']);
//         $companyname = $conn->real_escape_string($_POST['companyname']);
//         $address = $conn->real_escape_string($_POST['address']);
//         $createBy = $conn->real_escape_string($_POST['createBy']);
//         $status = isset($_POST['status']) ? 1 : 0;

//         // Prepare the SQL statement with placeholders
//         $sqlInsert = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`, `Status`) VALUES (?, ?, ?, ?, ?)";

//         // Prepare and bind
//         if ($stmt = $conn->prepare($sqlInsert)) {
//             // Bind the parameters to the placeholders in the SQL statement
//             $stmt->bind_param("sssii", $companycode, $companyname, $address, $createBy, $status);

//             // Execute the statement
//             if ($stmt->execute()) {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                     // SweetAlert code
//                     swal({
//                         title: "Success",
//                         text: "Company added successfully",
//                         icon: "success"
//                     }).then(function() {
//                         window.location = "company-add.php";
//                     });
//                     });
//                       </script>';
//             } else {
//                 // Display a detailed error message
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "There was an error adding the company. Please try again. Error: ' . $stmt->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php";
//                         });
//                     });
//                       </script>';
//             }
//             // Close the statement
//             $stmt->close();
//         } else {
//             // Display a detailed error message
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "There was an error preparing the statement. Please try again. Error: ' . $conn->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-add.php";
//                     });
//                 });
//                   </script>';
//         }
//     }
// }

//insert compaany have image
// function company_insert() {
//     global $conn;

//     if (isset($_POST['btnsave'])) {
//         $companycode = $conn->real_escape_string($_POST['companycode']);
//         $companyname = $conn->real_escape_string($_POST['companyname']);
//         $address = $conn->real_escape_string($_POST['address']);
//         $createBy = $conn->real_escape_string($_POST['createBy']);
//         $remark = $conn->real_escape_string($_POST['remark']);
//         $status = isset($_POST['status']) ? 1 : 0;

//         // Handle file upload
//         if (isset($_FILES['companyimage']) && $_FILES['companyimage']['error'] == 0) {
//             $target_dir = "ImageCompany/";
//             $originalFilename = $_FILES['companyimage']['name'];
//             $imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
//             $target_file = $target_dir . $originalFilename;

//             // Check if image file is a actual image or fake image
//             $check = getimagesize($_FILES['companyimage']['tmp_name']);
//             if ($check !== false) {
//                 // Check file size (5MB limit)
//                 if ($_FILES['companyimage']['size'] > 5000000) {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, your file is too large.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }

//                 // Allow certain file formats
//                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, only JPG, JPEG, PNG & GIF files are allowed.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }

//                 if (move_uploaded_file($_FILES['companyimage']['tmp_name'], $target_file)) {
//                     $imagePath = basename($target_file);
//                 } else {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, there was an error uploading your file.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }
//             } else {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "File is not an image.",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php";
//                         });
//                     });
//                 </script>';
//                 return;
//             }
//         } else {
//             $imagePath = null;
//         }

//         // Prepare the SQL statement with placeholders
//         $sqlInsert = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`,`Remark`, `Status`, `Logo`) VALUES (?, ?, ?, ?, ?, ?, ?)";

//         // Prepare and bind
//         if ($stmt = $conn->prepare($sqlInsert)) {
//             // Bind the parameters to the placeholders in the SQL statement
//             $stmt->bind_param("sssisss", $companycode, $companyname, $address, $createBy, $remark, $status, $imagePath);

//             // Execute the statement
//             if ($stmt->execute()) {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                     // SweetAlert code
//                     swal({
//                         title: "Success",
//                         text: "Company added successfully",
//                         icon: "success"
//                     }).then(function() {
//                         window.location = "company-add.php";
//                     });
//                     });
//                 </script>';
//             } else {
//                 // Display a detailed error message
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "There was an error adding the company. Please try again. Error: ' . $stmt->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php";
//                         });
//                     });
//                 </script>';
//             }
//             // Close the statement
//             $stmt->close();
//         } else {
//             // Display a detailed error message
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "There was an error preparing the statement. Please try again. Error: ' . $conn->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-add.php";
//                     });
//                 });
//             </script>';
//         }
//     }
// }

//insert company
function company_insert() {
    global $conn;
        if (isset($_POST['btnsave'])) {
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $status = isset($_POST['status']) ? 1 : 0;
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $currentdate = date("Y_m_d_H_i_s");
        $companynewimage = $currentdate.'_'.rand().'_'.$companyimage;

        if(!empty($companyimage)){
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`,`Remark`, `Status`, `Logo`)
            VALUES ('$companycode','$companyname','$address','$createby','$remark',1,'$companynewimage')";
            move_uploaded_file($companyimageTmp, './ImageCompany/' .$companynewimage);
        }else {
            $sqlInsertcompany = "INSERT INTO `outlet` (`Code`, `Name`, `Address`, `CreateBy`,`Remark`, `Status`, `Logo`)
            VALUES ('$companycode','$companyname','$address','$createby','$remark',1,'no_image.phg')";
        }

        $final = $conn->query($sqlInsertcompany);
        if($final == true){
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                    // SweetAlert code
                    swal({
                        title: "Success",
                        text: "Company added successfully",
                        icon: "success"
                    }).then(function() {
                        window.location = "company-add.php";
                    });
                    });
                </script>';
        }else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "There was an error adding the company. Please try again. Error: ' . $stmt->error . '",
                        icon: "error"
                    }).then(function() {
                        window.location = "company-add.php";
                    });
                });
            </script>';
        }
    }   
}

function company_update() {
    global $conn;

    // Check if the form is submitted
    if (isset($_POST['btnupdate'])) {
        // Validate and sanitize the company ID
        if (isset($_REQUEST['Id']) && !empty($_REQUEST['Id'])) {
            $companyid = $conn->real_escape_string($_REQUEST['Id']);
        } else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "Invalid company ID.",
                        icon: "error"
                    }).then(function() {
                        window.location = "company-list.php";
                    });
                });
            </script>';
            return;
        }

        // Sanitize and validate other inputs
        $companycode = $conn->real_escape_string($_POST['companycode']);
        $companyname = $conn->real_escape_string($_POST['companyname']);
        $address = $conn->real_escape_string($_POST['address']);
        $createby = $conn->real_escape_string($_POST['createby']);
        $remark = $conn->real_escape_string($_POST['remark']);
        $status = isset($_POST['status']) ? 1 : 0;
        $updateat = date("Y_m_d_H_i_s");

        // Handle file upload
        $companyimage = $_FILES['companyimage']['name'];
        $companyimageTmp = $_FILES['companyimage']['tmp_name'];
        $companynewimage = $updateat . '_' . rand() . '_' . $companyimage;

        // Prepare the SQL query for updating the record
        if (!empty($companyimage)) {
            // If a new image is uploaded, update the logo
            $sqlUpdatecompany = "UPDATE `outlet` SET 
                `Code`='$companycode', 
                `Name`='$companyname', 
                `Address`='$address', 
                `CreateBy`='$createby', 
                `Remark`='$remark', 
                `Status`='$status', 
                `Logo`='$companynewimage', 
                `UpdateAt`='$updateat' 
                WHERE `Id`='$companyid'";

            // Move the uploaded file to the designated directory
            if (!move_uploaded_file($companyimageTmp, './ImageCompany/' . $companynewimage)) {
                echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        swal({
                            title: "Error",
                            text: "There was an error uploading the image.",
                            icon: "error"
                        });
                    });
                </script>';
                return;
            }
        } else {
            // If no new image is uploaded, keep the old logo
            $sqlUpdatecompany = "UPDATE `outlet` SET 
                `Code`='$companycode', 
                `Name`='$companyname', 
                `Address`='$address', 
                `CreateBy`='$createby', 
                `Remark`='$remark', 
                `Status`='$status', 
                `UpdateAt`='$updateat' 
                WHERE `Id`='$companyid'";
        }

        // Execute the update query
        if ($conn->query($sqlUpdatecompany) === true) {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Success",
                        text: "Company updated successfully",
                        icon: "success"
                    }).then(function() {
                        window.location = "company-list.php";
                    });
                });
            </script>';
        } else {
            echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "Error",
                        text: "There was an error updating the company. Please try again. Error: ' . $conn->error . '",
                        icon: "error"
                    });
                });
            </script>';
        }
    }
}




// update company condition table don't have column image.
// function company_update() {
//     global $conn;

//     if (isset($_POST['btnsave'])) {
//         $id = $conn->real_escape_string($_POST['id']);
//         $companycode = $conn->real_escape_string($_POST['companycode']);
//         $companyname = $conn->real_escape_string($_POST['companyname']);
//         $address = $conn->real_escape_string($_POST['address']);
//         $createBy = $conn->real_escape_string($_POST['createBy']);
//         $status = isset($_POST['status']) ? 1 : 0;

//         // Prepare the SQL statement with placeholders
//         $sqlUpdate = "UPDATE `outlet` SET `Code` = ?, `Name` = ?, `Address` = ?, `CreateBy` = ?, `Status` = ? WHERE `Id` = ?";

//         // Prepare and bind
//         if ($stmt = $conn->prepare($sqlUpdate)) {
//             // Bind the parameters to the placeholders in the SQL statement
//             $stmt->bind_param("sssiii", $companycode, $companyname, $address, $createBy, $status, $id);

//             // Execute the statement
//             if ($stmt->execute()) {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Success",
//                             text: "Company updated successfully",
//                             icon: "success"

//                         }).then(function() {
//                             window.location = "company-list.php";
//                         });
//                     });
//                       </script>';
//             } else {
//                 // Display a detailed error message
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "There was an error updating the company. Please try again. Error: ' . $stmt->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php?OutId=' . $id . '";
//                         });
//                     });
//                       </script>';
//             }
//             // Close the statement
//             $stmt->close();
//         } else {
//             // Display a detailed error message
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "There was an error preparing the statement. Please try again. Error: ' . $conn->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-add.php?OutId=' . $id . '";
//                     });
//                 });
//                   </script>';
//         }
//     }
// }

// update company have image.
// function company_update() {
//     global $conn;

//     if (isset($_POST['btnsave'])) {
//         $companyid = $conn->real_escape_string($_POST['companyid']);
//         $companycode = $conn->real_escape_string($_POST['companycode']);
//         $companyname = $conn->real_escape_string($_POST['companyname']);
//         $address = $conn->real_escape_string($_POST['address']);
//         $createBy = $conn->real_escape_string($_POST['createBy']);
//         $remark = $conn->real_escape_string($_POST['remark']);
//         $status = isset($_POST['status']) ? 1 : 0;

//         $imagePath = null;

//         // Handle file upload if a new image is provided
//         if (isset($_FILES['companyimage']) && $_FILES['companyimage']['error'] == 0) {
//             $target_dir = "ImageCompany/";
//             $originalFilename = $_FILES['companyimage']['name'];
//             $imageFileType = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));
//             $target_file = $target_dir . $originalFilename;

//             // Check if image file is an actual image or fake image
//             $check = getimagesize($_FILES['companyimage']['tmp_name']);
//             if ($check !== false) {
//                 // Check file size (5MB limit)
//                 if ($_FILES['companyimage']['size'] > 5000000) {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, your file is too large.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php?OutId=' . $companyid . '";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }

//                 // Allow certain file formats
//                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, only JPG, JPEG, PNG & GIF files are allowed.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php?OutId=' . $companyid . '";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }
                
//                 // edit upload image delete old image on folder ImageCompany
//                 $result = $conn->query("SELECT `Logo` FROM `outlet` WHERE `Id` = $companyid");
//                 if ($result && $result->num_rows > 0) {
//                     $row = $result->fetch_assoc();
//                     $oldImage = $row['Logo'];
//                     if ($oldImage && file_exists($target_dir . $oldImage)) {
//                         unlink($target_dir . $oldImage);  // Delete old image
//                     }
//                 }

//                 if (move_uploaded_file($_FILES['companyimage']['tmp_name'], $target_file)) {
//                     $imagePath =  $originalFilename;
//                 } else {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Sorry, there was an error uploading your file.",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-add.php?OutId=' . $companyid . '";
//                             });
//                         });
//                     </script>';
//                     return;
//                 }
//             } else {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "File is not an image.",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php?OutId=' . $companyid . '";
//                         });
//                     });
//                 </script>';
//                 return;
//             }
//         }

//         // Prepare the SQL statement with placeholders
//         $sqlUpdate = "UPDATE `outlet` SET `Code` = ?, `Name` = ?, `Address` = ?, `CreateBy` = ?, `Remark` = ?, `Status` = ?";

//         // Add image update part if a new image is uploaded
//         if ($imagePath !== null) {
//             $sqlUpdate .= ", `Logo` = ?";
//         }

//         $sqlUpdate .= " WHERE `Id` = ?";

//         // Prepare and bind
//         if ($stmt = $conn->prepare($sqlUpdate)) {
//             if ($imagePath !== null) {
//                 // Bind the parameters to the placeholders in the SQL statement
//                 $stmt->bind_param("sssisssi", $companycode, $companyname, $address, $createBy, $remark, $status, $imagePath, $companyid);
//             } else {
//                 // Bind the parameters to the placeholders in the SQL statement
//                 $stmt->bind_param("sssisii", $companycode, $companyname, $address, $createBy, $remark, $status, $companyid);
//             }

//             // Execute the statement
//             if ($stmt->execute()) {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Success",
//                             text: "Company updated successfully",
//                             icon: "success"
//                         }).then(function() {
//                             window.location = "company-list.php";
//                         });
//                     });
//                 </script>';
//             } else {
//                 // Display a detailed error message
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "There was an error updating the company. Please try again. Error: ' . $stmt->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-add.php?OutId=' . $companyid . '";
//                         });
//                     });
//                 </script>';
//             }
//             // Close the statement
//             $stmt->close();
//         } else {
//             // Display a detailed error message
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "There was an error preparing the statement. Please try again. Error: ' . $conn->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-add.php?OutId=' . $companyid . '";
//                     });
//                 });
//             </script>';
//         }
//     }
// }


// get data view in company-add.php for update.
// function fetch_company($OutId) {
//     global $conn;
//    $sql = "SELECT * FROM `outlet` WHERE `Id` = ?";
//    $stmt = $conn->prepare($sql);
//    $stmt->bind_param("i", $OutId);
//    $stmt->execute();
//    $result = $stmt->get_result();
//    $company = $result->fetch_assoc();
//    $stmt->close();
//    return $company;
// }

 // Check if form is submitted
// function handle_form_submission() {
//    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//        if (isset($_POST['companyid']) && !empty($_POST['companyid'])) {
//            company_update();
//        } else {
//            company_insert();
//        }
//    }
// }


// delete company condition table don't have column image.
// function company_delete($delId) {
//     global $conn;
//     $sqlDeleteOutlet = "DELETE FROM `outlet` WHERE `Id`=?";
//     if ($stmt = $conn->prepare($sqlDeleteOutlet)) {
//         $stmt->bind_param("i", $delId);
//         if ($stmt->execute()) {
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Success",
//                         text: "Data delete success",
//                         icon: "success"
//                     }).then(function() {
//                         window.location = "company-list.php";
//                     });
//                 });
//                   </script>';
//         } else {
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "Error deleting record: ' . $stmt->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-list.php";
//                     });
//                 });
//                   </script>';
//         }
//         $stmt->close();
//     } else {
//         echo '<script>
//             document.addEventListener("DOMContentLoaded", function() {
//                 swal({
//                     title: "Error",
//                     text: "Error preparing statement: ' . $conn->error . '",
//                     icon: "error"
//                 }).then(function() {
//                     window.location = "company-list.php";
//                 });
//             });
//               </script>';
//     }
// }

// delete company
// function company_delete($delId) {
//     global $conn;
    
//     // Step 1: Retrieve the logo filename from the database
//     $sqlGetLogo = "SELECT `Logo` FROM `outlet` WHERE `Id`=?";
//     if ($stmt = $conn->prepare($sqlGetLogo)) {
//         $stmt->bind_param("i", $delId);
//         if ($stmt->execute()) {
//             $stmt->bind_result($logoFilename);
//             $stmt->fetch();
//             $stmt->close();
            
//             // Step 2: Delete the file from the server
//             if ($logoFilename) {
//                 $logoPath = 'ImageCompany/' . htmlspecialchars($logoFilename, ENT_QUOTES, 'UTF-8');
//                 if (file_exists($logoPath)) {
//                     unlink($logoPath);
//                 }
//             }
            
//             // Step 3: Delete the company record from the database
//             $sqlDeleteOutlet = "DELETE FROM `outlet` WHERE `Id`=?";
//             if ($stmt = $conn->prepare($sqlDeleteOutlet)) {
//                 $stmt->bind_param("i", $delId);
//                 if ($stmt->execute()) {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Success",
//                                 text: "Data delete success",
//                                 icon: "success"
//                             }).then(function() {
//                                 window.location = "company-list.php";
//                             });
//                         });
//                           </script>';
//                 } else {
//                     echo '<script>
//                         document.addEventListener("DOMContentLoaded", function() {
//                             swal({
//                                 title: "Error",
//                                 text: "Error deleting record: ' . $stmt->error . '",
//                                 icon: "error"
//                             }).then(function() {
//                                 window.location = "company-list.php";
//                             });
//                         });
//                           </script>';
//                 }
//                 $stmt->close();
//             } else {
//                 echo '<script>
//                     document.addEventListener("DOMContentLoaded", function() {
//                         swal({
//                             title: "Error",
//                             text: "Error preparing statement: ' . $conn->error . '",
//                             icon: "error"
//                         }).then(function() {
//                             window.location = "company-list.php";
//                         });
//                     });
//                       </script>';
//             }
//         } else {
//             echo '<script>
//                 document.addEventListener("DOMContentLoaded", function() {
//                     swal({
//                         title: "Error",
//                         text: "Error executing statement: ' . $stmt->error . '",
//                         icon: "error"
//                     }).then(function() {
//                         window.location = "company-list.php";
//                     });
//                 });
//                   </script>';
//             $stmt->close();
//         }
//     } else {
//         echo '<script>
//             document.addEventListener("DOMContentLoaded", function() {
//                 swal({
//                     title: "Error",
//                     text: "Error preparing statement: ' . $conn->error . '",
//                     icon: "error"
//                 }).then(function() {
//                     window.location = "company-list.php";
//                 });
//             });
//               </script>';
//     }
// }

// select user in input createby
// function select_user($selectedUserId = null) {
//     global $conn;

//     $sqlUser = "SELECT u.Id, u.Username, e.Lastname FROM `user` u JOIN `employee` e ON u.EmployeeId = e.Id";
//     $rsUser = $conn->query($sqlUser);

//     $options = '<option value="" disabled ' . ($selectedUserId === null ? 'selected' : '') . '>Select creator</option>';

//     while ($rowUser = $rsUser->fetch_assoc()) {
//         $isSelected = ($selectedUserId !== null && $selectedUserId == $rowUser['Id']) ? 'selected' : '';
//         $options .= '<option value="' . htmlspecialchars($rowUser['Id']) . '" ' . $isSelected . '>' . htmlspecialchars($rowUser['Username']) . ' ~ ' . htmlspecialchars($rowUser['Lastname']) . '</option>';
//     }

//     return $options;
// }

// view data in table condition don't hide any data.
// function display_companies_table() {
//     global $conn;

//     // Query to fetch company data
//     $sqloutlet = "SELECT * FROM `outlet`";
//     $rs = $conn->query($sqloutlet);

//     // Generate table rows
//     while ($rowOutlet = $rs->fetch_assoc()) {
//         $Createby = $conn->query("SELECT * FROM `user` WHERE Id=" . $rowOutlet['CreateBy'])->fetch_assoc();
//         echo '
//             <tr>
//                 <td>' . htmlspecialchars($rowOutlet['Code']) . '</td>
//                 <td>' . htmlspecialchars($rowOutlet['Name']) . '</td>
//                 <td>' . htmlspecialchars($rowOutlet['Address']) . '</td>
//                 <td>' . htmlspecialchars($Createby['Username']) . '</td>
//                 <td>
//                     <div class="status-toggle">
//                         <input type="checkbox" id="status' . $rowOutlet['Id'] . '" class="status-checkbox" ' . ($rowOutlet['Status'] == 1 ? 'checked' : '') . '>
//                         <label for="status' . $rowOutlet['Id'] . '" class="status-label">
//                             <div class="status-indicator"></div>
//                         </label>
//                     </div>
//                 </td>
//                 <td>' . htmlspecialchars($rowOutlet['CreateAt']) . '</td>
//                 <td>
//                     <a href="company-add.php?OutId=' . $rowOutlet['Id'] . '" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil"></i></a>
//                     <a href="company-list.php?delId=' . $rowOutlet['Id'] . '" class="btn btn-outline-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this Outlet?\')"><i class="fas fa-trash"></i></a>
//                 </td>
//             </tr>
//         ';
//     }
// }

//view data in table have image.
// function display_companies_table() {
//     global $conn;

//     // Query to fetch company data
//     $sqloutlet = "SELECT * FROM `outlet`";
//     $rs = $conn->query($sqloutlet);

//     // Generate table rows
//     while ($rowOutlet = $rs->fetch_assoc()) {
//         $Createby = $conn->query("SELECT * FROM `user` WHERE Id=" . $rowOutlet['CreateBy'])->fetch_assoc();
//         // Define the status badge HTML based on the status value
//         $statusBadge = ($rowOutlet['Status'] == 1) ? '<p><a href="company_update_status.php?OutId=' . $rowOutlet['Id'] . '&Status=0" class="badge badge-lg badge-success text-white">Enable</a></p>' : '<p><a href="company_update_status.php?OutId=' . $rowOutlet['Id'] . '&Status=1" class="badge badge-secondary badge-lg text-white">Disable</a></p>';
//         // Prepare image source
//         $logoFilename = htmlspecialchars($rowOutlet['Logo']);
//         $logoPath = 'ImageCompany/' . $logoFilename;
//         $logoImg = (file_exists($logoPath) && !empty($rowOutlet['Logo'])) 
//             ? '<img src="' . $logoPath . '" alt="Company Logo" width="100px">' 
//             : 'No Image';
//         // Debugging output
//         echo '<!-- Debug: Logo filename = ' . $logoFilename . ', Logo path = ' . $logoPath . ' -->';
//         echo '
//             <tr>
//                 <td>' . htmlspecialchars($rowOutlet['Code']) . '</td>
//                 <td>' . htmlspecialchars($rowOutlet['Name']) . '</td>
//                 <td>' . htmlspecialchars($rowOutlet['Address']) . '</td>
//                 <td>' . $logoImg . '</td>
//                 <td>' . htmlspecialchars($Createby['Username']) . '</td>
//                 <td>' . $statusBadge . '</td>
//                 <td>' . htmlspecialchars($rowOutlet['CreateAt']) . '</td>
//                 <td>
//                     <a href="company-add.php?OutId=' . $rowOutlet['Id'] . '" class="btn btn-outline-primary btn-sm mr-2"><i class="fa fa-pencil"></i></a>
//                     <a href="company-list.php?delId=' . $rowOutlet['Id'] . '" class="btn btn-outline-danger btn-sm " onclick="return confirm(\'Are you sure you want to delete this Outlet?\')"><i class="fas fa-trash"></i></a>
//                 </td>
//             </tr>
//         ';
//     }
// }

?>

