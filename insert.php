<?php
$connect = mysqli_connect("localhost", "root", "", "panel_sprzedazy");
if(isset($_POST["item_name"], $_POST["where_sold"]))
{
 $item_name = mysqli_real_escape_string($connect, $_POST["item_name"]);
 $where_sold = mysqli_real_escape_string($connect, $_POST["where_sold"]);
 $item_from = mysqli_real_escape_string($connect, $_POST["item_from"]);
 $size = mysqli_real_escape_string($connect, $_POST["size"]);
 $amount_1 = mysqli_real_escape_string($connect, $_POST["amount_1"]);
 $currency_1 = mysqli_real_escape_string($connect, $_POST["currency_1"]);
 $amount_2 = mysqli_real_escape_string($connect, $_POST["amount_2"]);
 $currency_2 = mysqli_real_escape_string($connect, $_POST["currency_2"]);
 $currency_2 = mysqli_real_escape_string($connect, $_POST["amount_3"]);
 $currency_2 = mysqli_real_escape_string($connect, $_POST["currency_3"]);
 $currency_2 = mysqli_real_escape_string($connect, $_POST["card"]);
 $currency_2 = mysqli_real_escape_string($connect, $_POST["date"]);
 $query = "INSERT INTO sales_table(sales_table_id,item_name, where_sold,item_from,size,amount_1,currency_1,amount_2,currency_2,amount_3,currency_3,card,date) VALUES(NULL, '$item_name', '$where_sold','$item_from','$size','$amount_1','$currency_1','$amount_2','$currency_2,'$amount_3','$currency_3'','$card','$date'')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>
