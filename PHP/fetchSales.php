<?php
require_once("dbconn.php");

$selectCompleted = "SELECT * FROM invoicetbl i JOIN custbl c ON i.CustID = c.CustID JOIN ptrackingtbl p ON i.InvoiceID = p.InvoiceID WHERE i.SellerID = ? AND is_complete = 1";
$selectStmt = $conn -> prepare($selectCompleted);
$selectStmt-> bind_param("i",$UserID);
$selectStmt -> execute();
$result = $selectStmt->get_result();
$invoiceList = $result -> fetch_all(MYSQLI_ASSOC);

$invoicesCompleted = [];

foreach ($invoiceList as $invoice){
    $invoicesCompleted[]= [
        'id' => $invoice['InvoiceID'],
        'customer' => $invoice['FirstName'] . ' ' . $invoice['SurName'],
        'seller' => $invoice['SellerID'],
        'date' => $invoice['DatePurchased'],
        'total' => $invoice['TotalP'],
        'status' => $invoice['Status']
    ];
}

$jsonInvoicesC = json_encode($invoicesCompleted, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/ScompleteInv.json',$jsonInvoicesC);

$selectNot = "SELECT * FROM invoicetbl i JOIN custbl c ON i.CustID = c.CustID JOIN ptrackingtbl p ON i.InvoiceID = p.InvoiceID WHERE i.SellerID = ? AND is_complete = 0";
$selectStmt1 = $conn -> prepare($selectNot);
$selectStmt1-> bind_param("i",$UserID);
$selectStmt1 -> execute();
$result1 = $selectStmt1->get_result();
$invoiceList1 = $result1 -> fetch_all(MYSQLI_ASSOC);

$invoicesNotCompleted = [];

foreach ($invoiceList1 as $invoice1){
    $invoicesNotCompleted[]= [
        'id' => $invoice1['InvoiceID'],
        'customer' => $invoice1['FirstName'] . ' ' . $invoice1['SurName'],
        'seller' => $invoice1['SellerID'],
        'date' => $invoice1['DatePurchased'],
        'total' => $invoice1['TotalP'],
        'status' => $invoice1['Status']
    ];
}

$jsonInvoicesN = json_encode($invoicesNotCompleted, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('../JSON/SincompleteInv.json',$jsonInvoicesN);

$completeInv = file_get_contents('../JSON/ScompleteInv.json');
$invComplete= json_decode($completeInv, true);

$incompleteInv = file_get_contents('../JSON/SincompleteInv.json');
$invInComplete= json_decode($incompleteInv, true);


$currentDate = date('Y-m-d');

$currentWeekNumber = date('W', strtotime($currentDate));
$currentMonthNumber = date('m', strtotime($currentDate));
$currentYear = date('Y', strtotime($currentDate));


$currentWeekSales = 0;
$currentMonthSales = 0;

foreach ([$invComplete] as $invoices) {
    foreach ($invoices as $invoice) {
        $purchaseDate = $invoice['date'];
        $totalAmount = $invoice['total'];

        $invoiceWeekNumber = date('W', strtotime($purchaseDate));
        $invoiceMonthNumber = date('m', strtotime($purchaseDate));
        $invoiceYear = date('Y', strtotime($purchaseDate));

        if ($invoiceWeekNumber == $currentWeekNumber && $invoiceYear == $currentYear) {
            $currentWeekSales += $totalAmount;
        }

        if ($invoiceMonthNumber == $currentMonthNumber && $invoiceYear == $currentYear) {
            $currentMonthSales += $totalAmount;
        }
    }
}

?>