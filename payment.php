<?php
$conn = new mysqli('localhost', 'root', '', 'repairs');
$amount=$_POST['amount'];
$refno=$_POST['refno'];
$sql="INSERT INTO `payment` ( `amount`, `refno`) VALUES ( '$amount', '$refno')";
if ($conn->query($sql) === TRUE) {
   echo "Payment Added wait for confirmation";
}
else 
{
    echo "failed";
}
?>
