<?php
// if (isset($_REQUEST['btnAdd'])) {
//     $txtcode = $_REQUEST['txtcode'];
//     $txtname = $_REQUEST['txtname'];
//     $txtdesc = $conn->real_escape_string($_REQUEST['txtdesc']);
//     $txtcreateby = $_REQUEST['txtcreateby'];
//     $txtcate = $_REQUEST['txtcate'];
//     $txtsku = $_REQUEST['txtsku'];
//     $txtImage = $_FILES['txtImage']['name'];
//     $txtImageTmp = $_FILES['txtImage']['tmp_name'];
//     $currentDate = date("Y_m_d_H_i_s");
//     $txtNewImage = $currentDate . '_' . rand() . '_' . $txtImage;
//     if (!empty($txtImage)) {
//       $sqlInsert = "INSERT INTO `product`(`ProCode`, `CategoryId`, `SkuId`, `Name`, `Description`, `Image`, `CreateBy`) VALUES ($txtcode,$txtcate,$txtsku,$txtname,$txtdesc,$txtNewImage ,$txtcreateby";
//       move_uploaded_file($txtImageTmp, 'ImageProduct/' . $txtNewImage);
//     } else {
//         $sqlInsert = "INSERT INTO `product`(`ProCode`, `CategoryId`, `SkuId`, `Name`, `Description`, `Image`, `CreateBy`) VALUES ($txtcode,$txtcate,$txtsku,$txtname,$txtdesc,no_image.png ,$txtcreateby";
//     }
//     if ($conn->query($sqlInsert) === TRUE) {
//       echo '
//                 <script>
//                   swal({
//                     title: "Success",
//                     text: "Data insert success",
//                     icon: "success",
//                   });
//                 </script>
//                 ';
//     } else {
//       echo '
//                 <script>
//                   swal({
//                     title: "Try again",
//                     text: "Data can not insert",
//                     icon: "error",
//                   });
//                 </script>
//                 ';
//     }
//   }
?>