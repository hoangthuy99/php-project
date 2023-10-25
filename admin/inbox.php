<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../classes/cart.php');
include_once($filepath . '/../helpers/format.php');

?>
<?php
$cart = new cart();
if (isset($_GET['shiftid']) ) {
	$id = $_GET['shiftid'];
	$time= $_GET['time'];
	$price = $_GET['price'];
	$shifted = $cart->shifted($id,$time,$price);
}
if (isset($_GET['delid']) ) {
	$id = $_GET['delid'];
	$time= $_GET['time'];
	$price = $_GET['price'];
	$deled = $cart->deled($id,$time,$price);
}

?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Inbox</h2>
		<div class="block">
			<?php
			if(isset($shifted)){
				echo $shifted;
			}
			?>
			<?php
			if(isset($deled)){
				echo $deled;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>No.</th>
						<th>Order Time</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Customers ID</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$cart = new cart();
					$fm = new Format();

					$get_inbox_cart = $cart->get_inbox_cart();
					if ($get_inbox_cart) {
						$i = 0;
						while ($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $fm->formatDate($result['date_order']) ?></td>
								<td><?php echo $result['product_name'] ?></td>
								<td><?php echo $result['qty'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><?php echo $result['customer_id'] ?></td>
								<td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">View Customers</a></td>
								<td><?php
									if ($result['status'] == 0) {
									?>
										<a href="?shiftid=<?php echo $result['ID'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Pending</a>
									<?php
									} elseif ($result['status'] == 1){
									?>
									 <?php echo "Shifting..."?> 
									<?php
									}elseif ($result['status'] == 2){
									?>
										<a href="?delid=<?php echo $result['ID'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>
									<?php
									}
									?>
								</td>
							</tr>
					<?php
						}
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();

		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>