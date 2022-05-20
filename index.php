
<html>
 <head>
  <title>How to use Tabledit plugin with jQuery Datatable in PHP Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
 </head>
 <body>
  <div class="container">
   <br />
   <div class="panel panel-default">
    <div class="panel-body">
     <div class="table-responsive">
	    <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
      <table id="sample_data" class="table table-bordered table-striped">
       <thead>
        <tr>
         <th>ID</th>
         <th>Produkt</th>
         <th>Gdzie</th>
         <th>Skąd</th>
         <th>Rozmiar</th>
         <th>Kwota 1</th>
         <th>Waluta 1</th>
         <th>Kwota 2</th>
         <th>Waluta 2</th>
		 <th>Kwota 3</th>
         <th>Waluta 3</th>
         <th>Karta</th>
         <th>Data</th>
        </tr>
       </thead>
       <tbody></tbody>
      </table>
     </div>
    </div>
   </div>
  </div>
  <br />
  <br />
 </body>
</html>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

 var dataTable = $('#sample_data').DataTable({
  "processing" : true,
  "serverSide" : true,
  "order" : [],
  "ajax" : {
   url:"fetch.php",
   type:"POST"
  }
 });

 $('#sample_data').on('draw.dt', function(){
  $('#sample_data').Tabledit({
   url:'action.php',
   dataType:'json',
   columns:{
    identifier : [0, 'sales_table_id'],
    editable:[[1, 'item_name'], [2, 'where_sold'], [3, 'item_from'],[4,'size'],[5,'amount_1'],[6,'currency_1'],[7,'amount_2'],[8,'currency_2'],[9,'amount_3'],[10,'currency_3'],[11,'card'],[12,'date']]
   },
   restoreButton:false,
   onSuccess:function(data, textStatus, jqXHR)
   {
    if(data.action == 'delete')
    {
     $('#' + data.id).remove();
     $('#sample_data').DataTable().ajax.reload();
    }
   }
  });
 });
 
   $('#add').click(function(){
   var html = '<tr>';
   html += '<td id="sales_table_id">AUTO</td>';
   html += '<td contenteditable id="item_name"></td>';
   html += '<td contenteditable id="where_sold"></td>';
   html += '<td contenteditable id="item_from"></td>';
   html += '<td contenteditable id="size"></td>';
   html += '<td contenteditable id="amount_1"></td>';
   html += '<td contenteditable id="currency_1"></td>';
   html += '<td contenteditable id="amount_2"></td>';
   html += '<td contenteditable id="currency_2"></td>';
   html += '<td contenteditable id="amount_3"></td>';
   html += '<td contenteditable id=" currency_3"></td>';
   html += '<td contenteditable id=" card"></td>';
   html += '<td contenteditable id=" date"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#sample_data tbody').prepend(html);
  });
  
    $(document).on('click', '#insert', function(){
   var item_name = $('#item_name').text();
   var where_sold = $('#where_sold').text();
   var item_from = $('#item_from').text();
   var size = $('#size').text();
   var amount_1 = $('#amount_1').text();
   var currency_1 = $('#currency_1').text();
   var currency_1 = $('#amount_2').text();
   var currency_1 = $('#currency_2').text();
   var currency_1 = $('#amount_3').text();
   var currency_1 = $('#amount_3').text();
   var currency_1 = $('#card').text();
   var currency_1 = $('#date').text();
   if(item_name != '' && where_sold != ''&& item_from != ''&& size != ''&& amount_1 != ''&& currency_1 != ''&& amount_2 != ''&& currency_2 != ''&& amount_3 != ''&& currency_3 != ''&& card != ''&& date != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{item_name:item_name, where_sold:where_sold,item_from:item_from,size:size,amount_1:amount_1,currency_1:currency_1,amount_2:amount_2,currency_2:currency_2,amount_3:amount_3,currency_3:currency_3,amount_3:amount_3,card:date},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#sample_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
}); 
</script>
