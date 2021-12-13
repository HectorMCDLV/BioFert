
<?php
require 'fpdf/fpdf.php';

require 'include/config/connect.php';

$link = conectarDB();
session_start(); 

$id_cliente = $_SESSION['id'];
//Select the Products you want to show in your PDF file
$result=mysqli_query($link,"SELECT productoxpedido.cantidad as CANT ,
                            producto.nombre as DESCRIPCION,
                            producto.precio as PRECIO_UNIT,
                            (producto.precio * productoxpedido.cantidad) as TOTAL 
                    from productoxpedido 
                    INNER JOIN pedido on pedido.id = productoxpedido.id_pedido 
                    INNER JOIN producto on productoxpedido.id_producto = producto.id
                    where pedido.id_cliente = $id_cliente ");
$number_of_products = $result->num_rows;

//Initialize the 3 columns and the total
$column_cant= "";
$column_nombre = "";
$column_precio = "";
$column_precio_total = "";

$total = 0;

//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $cant = $row["CANT"];
    $nombre = substr($row["DESCRIPCION"],0,20);
    $precio = $row["PRECIO_UNIT"];
    $precio_total = $row["TOTAL"];

    $column_cant=  $column_cant.$cant."\n";
    $column_nombre = $column_nombre.$nombre."\n";
    $column_precio = $column_precio.$precio."\n";
    $column_precio_total = $column_precio_total.$precio_total."\n";

  

    //Sum all the Prices (TOTAL)
    $total = $total+$precio_total;
}

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
$importe = $total * 0.16;
$TotalFinal =$importe + $total ;


//Create a new PDF file
$pdf=new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();


//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,10,'Recibo',0,0,'C');
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(20,6,'CANT',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(100,6,'DESCRIPCION',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'P UNIT',1,0,'R',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'TOTAL',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_cant,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_nombre,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(30,6,$column_precio,1,'R');
$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);
$pdf->MultiCell(30,6,$column_precio_total,1,'R');
$pdf->SetX(135);



//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
    $pdf->SetX(45);
    $pdf->MultiCell(120,6,'',1);
    $i = $i +1;
}

$pdf->SetX(165);
$pdf->MultiCell(30,6,' Total ',0,'L',0);


$pdf->SetX(165);
$pdf->MultiCell(30,6,'$ '.$total,0,'R',2);


$pdf->SetX(165);
$pdf->MultiCell(30,6,' Importe',0,'L',0);


$pdf->SetX(165);
$pdf->MultiCell(30,6,'$ '.$importe,0,'R',2);

$pdf->SetX(165);
$pdf->MultiCell(30,6,'Total Final ',0,'L',0);

$pdf->SetX(165);
$pdf->MultiCell(30,6,'$ '.$TotalFinal,0,'R',2);

$pdf->Output();
?>