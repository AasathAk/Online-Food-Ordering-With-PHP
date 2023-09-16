<!-- <?php
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

// $pdf->SetLeftMargin(10);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(30, 10, 'No', 1, 0, 'C');
$pdf->Cell(30, 10, 'Name', 1, 0, 'C');
$pdf->Cell(30, 10, 'Amount', 1, 0, 'C');
$pdf->Cell(30, 10, 'status', 1, 0, 'C');
$pdf->Cell(30, 10, 'Date', 1, 0, 'C');
$pdf->Ln(10);

$query = "SELECT users.*, orders.* FROM users INNER JOIN orders ON users.uid=orders.uid ";
$result = mysqli_query($conn, $query);
$i=1;
       
if ($result && mysqli_num_rows($result) > 0) {
    
    while ($row = mysqli_fetch_assoc($result)) {
       
 
        $pdf->Cell(30, 10, $i++, 1, 1, 'C');
        $pdf->Cell(30, 10, $row['username'], 1, 1, 'C');
        // $pdf->Cell(40, 10, $row['amount_paid'], 1, 0, 'C');
        // $pdf->Cell(40, 10, $row['status'], 1, 0, 'C');
        // $pdf->Cell(40, 10, $row['date'], 1, 0, 'C');

        
     
    }
} else {
    echo "No result found.";
}


// Output the PDF
$pdf->Output();
?> -->

<?php

    //include library
    include('TCPDF/tcpdf.php');
    
    //make TCPDF object
    $pdf = new TCPDF('P','mm','A4');
    
    //remove default header and footer
    // $pdf->setPrintHeader(true);
    // $pdf->setPrintFooter(true);
    
    //add page
    $pdf->AddPage();
    
    //add content (student list)
    //title
    $pdf->SetFont('Helvetica','',14);
    $pdf->Cell(190,10,"University of Insert Name Here",0,1,'C');
    
    // $pdf->SetFont('Helvetica','',8);
    // $pdf->Cell(190,5,"Student List",0,1,'C');
    
    // $pdf->SetFont('Helvetica','',10);
    // $pdf->Cell(30,5,"Class",0);
    // $pdf->Cell(160,5,": Programming 101",0);
    // $pdf->Ln();
    // $pdf->Cell(30,5,"Teacher Name",0);
    // $pdf->Cell(160,5,": Prof. John Smith",0);
    // $pdf->Ln();
    // $pdf->Ln(2);
    
    // //make the table
    // $html = "
    //     <table>
    //         <tr>
    //             <th>ID</th>
    //             <th>First Name</th>
    //             <th>Last Name</th>
    //             <th>Email</th>
    //             <th>Gender</th>
    //             <th>Address</th>
    //         </tr>
    //         ";
    // //load the json data
    // $file = file_get_contents('MOCK_DATA-100.json');
    // $data = json_decode($file);
    
    // //loop the data
    // foreach($data as $student){	
    //     $html .= "
    //             <tr>
    //                 <td>". $student->id ."</td>
    //                 <td>". $student->first_name ."</td>
    //                 <td>". $student->last_name ."</td>
    //                 <td>". $student->email ."</td>
    //                 <td>". $student->gender ."</td>
    //                 <td>". $student->address ."</td>
    //             </tr>
    //             ";
    // }		
    
    // $html .= "
    //     </table>
    //     <style>
    //     table {
    //         border-collapse:collapse;
    //     }
    //     th,td {
    //         border:1px solid #888;
    //     }
    //     table tr th {
    //         background-color:#888;
    //         color:#fff;
    //         font-weight:bold;
    //     }
    //     </style>
    // ";
    // //WriteHTMLCell
    // $pdf->WriteHTMLCell(192,0,9,'',$html,0);	
    
    
    //output
    $pdf->Output();

?>