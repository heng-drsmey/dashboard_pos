<?php
include('include/head.php');
include('cn.php'); // Include database connection

// Initialize empty array for payroll data
$payroll = array(
    "Id" => "","Code" => "", "Type" => "", "NumberDay"  => "", "NumberMonth"    => "", "InterimSalary" => "", "Date" => "", 
    "CreateBy" => "","CreateAt" => "", "Remark" => "", "CodeEmployee" => "", "Employee" => "", "EmployeeType" => "","Positions" => "",
    "Nation" => "", "Telephone" =>"", "OutletName" =>"", "Bank" =>"", "AccountName" =>"", "AccountNumber" =>"", "BaseSalary" => "",
    "Bonus" => "", "Allowance" => "", "Seniority" => "", "Deduction" =>"", "InterimPayment" => "", "SalaryPayment" => "",
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

// Assuming you have a connection to the database ($conn)

// Get the OutletName from payroll
$outletName = $payroll['OutletName']; 

// Query to fetch company details based on OutletName
$query = "
    SELECT 
        outlet.Name AS OutletName,
        outlet.Address AS OutletAddress,
        outlet.Telephone AS OutletTelephone,
        outlet.Email AS OutletEmail,
        outlet.Logo AS OutletLogo
    FROM outlet
    WHERE outlet.Name = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $outletName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $company = $result->fetch_assoc();
} else {
    $company = [
        'OutletName' => 'N/A',
        'OutletAddress' => 'N/A',
        'OutletTelephone' => 'N/A',
        'OutletEmail' => 'N/A',
        'OutletLogo' => 'default_logo.png', // Default logo if no logo found
    ];
}
$logoPath = 'ImageCompany/' . htmlspecialchars($company['OutletLogo']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Custom styles -->
    <!-- <link rel="stylesheet" href="css/payroll-style.css"> Linking payroll-style.css -->
    <link rel="stylesheet" href="css/payroll-style.css?v=1.0">

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
                <img src="<?php echo $logoPath; ?>" alt="Company Logo" style="max-width: 100px;">
            </div>
            <div class="company-info">
                <h3><?php echo htmlspecialchars($company['OutletName']); ?></h3>
                <p><?php echo htmlspecialchars($company['OutletAddress']); ?></p>
                <p>
                    Telephone: <?php echo htmlspecialchars($company['OutletTelephone']); ?> | 
                    Email: <?php echo htmlspecialchars($company['OutletEmail']); ?>
                </p>
            </div>
        </div>

        <hr class="section-divider">

        <!-- Title and Basic Details -->
        <h4 class="text-center-main">Payslip</h4>
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

        <!-- <hr class="section-divider"> -->

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
                    <th>Positions</th>
                    <td><?php echo htmlspecialchars($payroll['Positions']); ?></td>
                </tr>
                <tr>
                    <th>Nationality</th>
                    <td><?php echo htmlspecialchars($payroll['Nation']); ?></td>
                    <th>Telephone</th>
                    <td><?php echo htmlspecialchars($payroll['Telephone']); ?></td>
                </tr>
                <tr>
                    <th>Branch</th>
                    <td><?php echo htmlspecialchars($payroll['OutletName']); ?></td>
                    <th>Bank</th>
                    <td><?php echo htmlspecialchars($payroll['Bank']); ?></td>
                </tr>
                <tr>
                    <th>Account Name</th>
                    <td><?php echo htmlspecialchars($payroll['AccountName']); ?></td>
                    <th>Account Number</th>
                    <td><?php echo htmlspecialchars($payroll['AccountNumber']); ?></td>
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
                    <td class="text-center"><strong>Interim Salary Payment ($)</strong></td>
                    <td><strong><?php echo htmlspecialchars($payroll['InterimPayment']); ?><strong></td>
                    <td class="text-center"><strong>Net Salary Payment ($)</strong></td>
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
