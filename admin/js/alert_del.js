

// $(document).ready(function () {
//     $('.delete_button').click(function (e) {
//         e.preventDefault();
//         var id = $(this).val();
//         // alert(id);
//         swal({
//             title: "Are you sure?",
//             text: "Once deleted, you will not be able to recover this product!",
//             icon: "warning",
//             buttons: true,
//             dangerMode: true,
//         })
//             .then((willDelete) => {
//                 if (willDelete) {
                    
//                     $.ajax({
//                         url: "product-addOn-uom.php?delId=" + id,  // Same deletion URL
//                         type: "DELETE",  // Specify DELETE method for deletion
//                         success: function(response) {
//                           // Handle successful deletion response (optional)
//                           swal(" Your product has been deleted!", {
//                                         icon: "success",
//                                     });
//                           // Update UI here (e.g., remove the product from the list)
//                           $("#item-" + id).remove();  // Assuming you have elements with IDs like "item-1"
//                         },
//                         error: function(jqXHR, textStatus, errorThrown) {
//                           // Handle deletion errors
//                           console.error("Error deleting product:", textStatus, errorThrown);
//                           // Display an error message to the user here (optional)
//                         }
//                       });
                    
//                     // $.ajax({
//                     //     method: "POST",
//                     //     url: "../function_pro.php",
//                     //     data: {
//                     //         'Id': id,
//                     //         'confirm_delete_alert': true
//                     //     },
//                     //     datatype: "datatype",
//                     //     success: function (response) {
//                     //         swal(" Your product has been deleted!", {
//                     //             icon: "success",
//                     //         });
//                     //     }
//                     // });

//                 } else {
//                     swal("Your product is safe!");
//                 }
//             });
//     });
// });
// // // swal({
// // //     title: "Success",
// // //     text: "Data delete success",
// // //     icon: "success",
// // //     });

// // function deleteProduct(id) {
// //     $.ajax({
// //       url: "product-addOn-uom.php?delId=" + id,  // Same deletion URL
// //       type: "DELETE",  // Specify DELETE method for deletion
// //       success: function(response) {
// //         // Handle successful deletion response (optional)
// //         console.log("Product deleted successfully:", response);
// //         // Update UI here (e.g., remove the product from the list)
// //         $("#item-" + id).remove();  // Assuming you have elements with IDs like "item-1"
// //       },
// //       error: function(jqXHR, textStatus, errorThrown) {
// //         // Handle deletion errors
// //         console.error("Error deleting product:", textStatus, errorThrown);
// //         // Display an error message to the user here (optional)
// //       }
// //     });
// //   }
  
  
