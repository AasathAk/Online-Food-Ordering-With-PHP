<?php
require 'FPDF/fpdf.php';
include '../Dbconnect/config.php';

// Instantiate the PDF object
$pdf = new FPDF();

// Add a new page
$pdf->AddPage();

// Set the font
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(252, 3, 3);
$pdf->Cell(200, 20, "DINE AND DIVINE FAMILY RESTAURANT", "0", "1", 'C');

$pdf->SetLeftMargin(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 14);

if (isset($_GET["order_id"])) {
    $oid = $_GET['order_id'];

    $query = "SELECT orders.id, users.username, orders.phone,orders.address,orders.products, orders.amount_paid
              FROM orders
              INNER JOIN users ON orders.uid = users.uid
              WHERE id=$oid";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $pdf->Cell(50, 10, "Customer Name:", 0, 0);
            $pdf->Cell(0, 10, $row['username'], 0, 1);

            $pdf->Cell(50, 10, "Address:", 0, 0);
            $pdf->Cell(0, 10, isset($row['address']) ? $row['address'] : '', 0, 1);

            $pdf->Cell(50, 10, "Phone No", 0, 0);
            $pdf->Cell(0, 10, isset($row['phone']) ? $row['phone'] : '', 0, 1);

            $pdf->Ln(10);
            $pdf->Cell(120, 10, "Item", 1, 0, 'C');
            $pdf->Cell(40, 10, "Total", 1, 1, 'C');

            $pdf->Cell(120, 10, $row['products'], 1, 0);
            $pdf->Cell(40, 10, $row['amount_paid'], 1, 1, 'R');
            $pdf->Ln(10);
           

            $pdf->Cell(110, 10, '', 0, 0);
            $pdf->Cell(40, 10, "Total:", 1, 0, 'R');
            $pdf->Cell(40, 10, "$21.50", 1, 1, 'R');
        }
    } else {
        echo "No result found.";
    }
}

// Output the PDF
$pdf->Output();
