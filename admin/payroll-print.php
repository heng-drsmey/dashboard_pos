<?php
include('include/head.php');
include('cn.php'); // Include database connection

// Initialize empty array for payroll data
$payroll = array(
    "Id" => "","Code" => "", "Type" => "", "NumberDay"  => "", "NumberMonth"    => "", "InterimSalary" => "", "Date" => "", 
    "CreateBy" => "","CreateAt" => "", "Remark" => "", "CodeEmployee" => "", "Employee" => "", "EmployeeType" => "", "BaseSalary" => "",
    "Bonus" => "", "Allowance" => "", "Seniority" => "", "Deduction" => "", "InterimPayment" => "", "SalaryPayment" => "",
    "UpdateAt" => "","Status" => ""
);

// Fetch payroll ID from query parameters
if (isset($_GET['Id']) && is_numeric($_GET['Id'])) {
    $payrollId = $conn->real_escape_string($_GET['Id']);

    // Query payroll data
    $result = $conn->query("SELECT * FROM `payroll` WHERE `Id` = '$payrollId'");

    if ($result && $result->num_rows > 0) {
        $payroll = $result->fetch_assoc();
    } else {
        echo '<script>
                alert("Error: Payroll data not found.");
                window.location.href = "payroll-list.php";
              </script>';
        exit();
    }
} else {
    echo '<script>
            alert("Error: Invalid Payroll ID.");
            window.location.href = "payroll-list.php";
          </script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Slip</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Custom styles -->
    <link rel="stylesheet" href="css/payroll-style.css"> <!-- Linking payroll-style.css -->
</head>

<body>
    <div class="both">
        <a href="payroll-list.php" class="btn btn-secondary">Back to List</a>
        <button class="btn btn-warning shadow-sm" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
    </div>
    <div class="salary-slip">
        <!-- Header Section -->
        <div class="header d-flex align-items-center">
            <div class="logo">
                <img src="logo.png" alt="Company Logo">
            </div>
            <div class="company-info">
                <h3>Company Name</h3>
                <p>Address Line 1, Address Line 2</p>
                <p>Telephone: (123) 456-7890 | Email: info@company.com</p>
            </div>
        </div>

        <hr class="section-divider">

        <!-- Title and Basic Details -->
        <h4 class="text-center-main">Salary Slip</h4>
        <table class="table">
            <tbody>
                <tr>
                    <th>Invoice.No:</th>
                    <td><?php echo htmlspecialchars($payroll['Code']); ?></td>
                    <th>Type:</th>
                    <td><?php echo htmlspecialchars($payroll['Type']); ?></td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td><?php echo htmlspecialchars($payroll['Date']); ?></td>
                    <th>Remark:</th>
                    <td><?php echo htmlspecialchars($payroll['Remark']); ?></td>
                </tr>
            </tbody>
        </table>

        <hr class="section-divider">

        <!-- Employee Information -->
        <table class="table table-bordered">
            <thead class="table-header">
                <tr>
                    <th colspan="4" class="text-center">Employee Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Code</th>
                    <td><?php echo htmlspecialchars($payroll['CodeEmployee']); ?></td>
                    <th>Employee</th>
                    <td><?php echo htmlspecialchars($payroll['Employee']); ?></td>
                </tr>
                <tr>
                    <th>Employee Type</th>
                    <td><?php echo htmlspecialchars($payroll['EmployeeType']); ?></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>

        <!-- Salary Details -->
        <table class="table table-bordered">
            <thead class="table-header">
                <tr>
                    <th colspan="2" class="text-center">Interim Salary</th>
                    <th colspan="2" class="text-center">Final Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Number of Day</td>
                    <td><?php echo htmlspecialchars($payroll['NumberDay']); ?></td>
                    <td>Base Salary</td>
                    <td><?php echo htmlspecialchars($payroll['BaseSalary']); ?></td>
                </tr>
                <tr>
                    <td>Number of Month</td>
                    <td><?php echo htmlspecialchars($payroll['NumberMonth']); ?></td>
                    <td>Bonus</td>
                    <td><?php echo htmlspecialchars($payroll['Bonus']); ?></td>
                </tr>
                <tr>
                    <td>Base Salary</td>
                    <td><?php echo htmlspecialchars($payroll['InterimSalary']); ?></td>
                    <td>Allowance</td>
                    <td><?php echo htmlspecialchars($payroll['Allowance']); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Seniority Payment</td>
                    <td><?php echo htmlspecialchars($payroll['Seniority']); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Pension Fund Deduction</td>
                    <td><?php echo htmlspecialchars($payroll['Deduction']); ?></td>
                </tr>
                <tr class="table-header">
                    <td class="text-center"><strong>Interim Salary Payment</strong></td>
                    <td><strong><?php echo htmlspecialchars($payroll['InterimPayment']); ?><strong></td>
                    <td class="text-center"><strong>Net Salary Payment</strong></td>
                    <td><strong><?php echo htmlspecialchars($payroll['SalaryPayment']); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section -->
        <div class="signature-section">
            <div>
                <p>Prepared By</p>
                <hr>
            </div>
            <div>
                <p>Authorized By</p>
                <hr>
            </div>
            <div>
                <p>Received By</p>
                <hr>
            </div>
        </div>
    </div>
</body>

</html>
