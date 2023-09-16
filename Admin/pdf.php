<?php 
  require ("FPDF/fpdf.php");
  include '../Dbconnect/config.php';

  if (isset($_GET["order_id"])) {
    $oid = $_GET['order_id'];
  //customer and invoice details
  $query = "SELECT orders.id, users.username, orders.phone,orders.address,orders.products, 
  orders.amount_paid, orders.date
  FROM orders
  INNER JOIN users ON orders.uid = users.uid
  WHERE id=$oid";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
while ($row = mysqli_fetch_assoc($result)) {

  $info=[
    "customer"=>$row['username'],
    "address"=>$row['address'],
    "invoice_no"=>$oid,
    "invoice_date"=>$row['date'],
    "total_amt"=>$row['amount_paid'],
    
  ];
  
  
  //invoice Products
  $products_info=[
    [
      "name"=>$row['products'],
      "total"=>$row['amount_paid'],
    ],
  ];
}
}
  }
  
  class PDF extends FPDF
  {
    function Header(){
      
      //Display Company Info
      $this->SetFont('Arial','B',14);
      $this->Cell(50,10,"DINE AND DIVINE RESTAURANT",0,1);
      $this->SetFont('Arial','',14);
      $this->Cell(50,7,"No. 110 Telecom Road,",0,1);
      $this->Cell(50,7,"Kattankudy 01.",0,1);
      $this->Cell(50,7,"PH : 778731770",0,1);
      
      //Display INVOICE text
      $this->SetY(15);
      $this->SetX(-40);
      $this->SetFont('Arial','B',18);
      $this->Cell(50,10,"INVOICE",0,1);
      
      //Display Horizontal line
      $this->Line(0,48,210,48);
    }
    
    function body($info,$products_info){
      
      //Billing Details
      $this->SetY(55);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(50,10,"Bill To: ",0,1);
      $this->SetFont('Arial','',12);
      $this->Cell(50,7,$info["customer"],0,1);
      $this->Cell(50,7,$info["address"],0,1);
    
      
      //Display Invoice no
      $this->SetY(55);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice No : ".$info["invoice_no"]);
      
      //Display Invoice date
      $this->SetY(63);
      $this->SetX(-60);
      $this->Cell(50,7,"Invoice Date : ".$info["invoice_date"]);
      
      //Display Table headings
      $this->SetY(95);
      $this->SetX(10);
      $this->SetFont('Arial','B',12);
      $this->Cell(80,9,"PRODUCTS",1,0);
      $this->Cell(40,9,"TOTAL",1,1,"C");
      $this->SetFont('Arial','',12);
      
      //Display table product rows
      foreach($products_info as $row){
        $this->Cell(80,9,$row["name"],"LR",0);
        // $this->Cell(40,9,$row["price"],"R",0,"R");
        $this->Cell(40,9,$row["total"],"R",0,"R");
      }
      //Display table empty rows
      for($i=0;$i<12-count($products_info);$i++)
      {
        $this->Cell(80,9,"","LR",0);
        $this->Cell(40,9,"","R",0,"R");
      }
      //Display table total row
      $this->SetFont('Arial','B',12);
    //   $this->Cell(150,9,"TOTAL",1,0,"R");
    //   $this->Cell(40,9,$info["total_amt"],1,1,"R");
      
    
    }
    function Footer(){
      
      //set footer position
      $this->SetY(-50);
      $this->SetFont('Arial','B',12);
      $this->Cell(0,10,"Dine and Divine",0,1,"R");
      $this->Ln(15);
      $this->SetFont('Arial','',12);
      $this->Cell(0,10,"Authorized Signature",0,1,"R");
      $this->SetFont('Arial','',10);
      
      //Display Footer Text
      $this->Cell(0,10,"This is a Food order invoice",0,1,"C");
      
    }
    
  }
  //Create A4 Page with Portrait 
  $pdf=new PDF("P","mm","A4");
  $pdf->AddPage();
  $pdf->body($info,$products_info);
  $pdf->Output();
?>