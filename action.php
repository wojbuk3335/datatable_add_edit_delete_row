<?php

//action.php

include('database_connection.php');

if($_POST['action'] == 'edit')
{
 $data = array(
  ':item_name'  => $_POST['item_name'],
  ':where_sold'  => $_POST['where_sold'],
  ':item_from'   => $_POST['item_from'],
  ':sales_table_id'    => $_POST['sales_table_id'],
  ':size'    => $_POST['size'],
  ':amount_3'    => $_POST['amount_3'],
  ':currency_3'    => $_POST['currency_3'],
  ':amount_2'    => $_POST['amount_2'],
  ':currency_2'    => $_POST['currency_2'],
  ':currency_1'    => $_POST['currency_1'],
  ':amount_1'    => $_POST['amount_1'],
  ':card'    => $_POST['card'],
  ':date'    => $_POST['date'],
 );

 $query = "
 UPDATE sales_table 
 SET item_name = :item_name, 
 where_sold = :where_sold, 
 size = :size, 
 amount_3 = :amount_3, 
 currency_3 = :currency_3, 
 amount_2 = :amount_2, 
 currency_2 = :currency_2, 
 amount_1 = :amount_1, 
 currency_1 = :currency_1, 
 item_from = :item_from, 
 card = :card, 
 date = :date 
 WHERE sales_table_id = :sales_table_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
 echo json_encode($_POST);
}

if($_POST['action'] == 'delete')
{
 $query = "
 DELETE FROM sales_table 
 WHERE sales_table_id = '".$_POST["sales_table_id"]."'
 ";
 $statement = $connect->prepare($query);
 $statement->execute();
 echo json_encode($_POST);
}


?>