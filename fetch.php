<?php

//fetch.php

include('database_connection.php');

$column = array("sales_table_id", "item_name", "where_sold", "item_from","size","amount_1","currency_1","amount_2","currency_2","amount_3","currency_3","card","date");

$query = "SELECT * FROM sales_table ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE item_name LIKE "%'.$_POST["search"]["value"].'%" 
 OR where_sold LIKE "%'.$_POST["search"]["value"].'%" 
 OR item_from LIKE "%'.$_POST["search"]["value"].'%" 
 OR size LIKE "%'.$_POST["search"]["value"].'%" 
 OR amount_1 LIKE "%'.$_POST["search"]["value"].'%" 
 OR currency_1 LIKE "%'.$_POST["search"]["value"].'%" 
 OR amount_2 LIKE "%'.$_POST["search"]["value"].'%" 
 OR currency_2 LIKE "%'.$_POST["search"]["value"].'%" 
 OR amount_3 LIKE "%'.$_POST["search"]["value"].'%" 
 OR currency_3 LIKE "%'.$_POST["search"]["value"].'%" 
 OR card LIKE "%'.$_POST["search"]["value"].'%" 
 OR date LIKE "%'.$_POST["search"]["value"].'%" 
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY sales_table_id DESC ';
}
$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
 $sub_array = array();
 $sub_array[] = $row['sales_table_id'];
 $sub_array[] = $row['item_name'];
 $sub_array[] = $row['where_sold'];
 $sub_array[] = $row['item_from'];
 $sub_array[] = $row['size'];
 $sub_array[] = $row['amount_1'];
 $sub_array[] = $row['currency_1'];
 $sub_array[] = $row['amount_2'];
 $sub_array[] = $row['currency_2'];
 $sub_array[] = $row['amount_3'];
 $sub_array[] = $row['currency_3'];
 $sub_array[] = $row['card'];
 $sub_array[] = $row['date'];
 $data[] = $sub_array;
}

function count_all_data($connect)
{
 $query = "SELECT * FROM sales_table";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 'draw'   => intval($_POST['draw']),
 'recordsTotal' => count_all_data($connect),
 'recordsFiltered' => $number_filter_row,
 'data'   => $data
);

echo json_encode($output);

?>