<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$product = new product();
$fm = new Format();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$delproduct = $product->del_product($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<div class="block">
			<?php
			if (isset($delproduct)) {
				echo $delproduct;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Image</th>
						<th>Price</th>
						<th>Type</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$productlist = $product->show_product();
					if ($productlist) {
						$t = 0;
						while ($result = $productlist->fetch_assoc()) {
							$t++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $t ?></td>
								<td><?php echo $result['product_name'] ?></td>
								<td><?php echo $result['cat_id'] ?></td>
								<td><?php echo $result['brand_id'] ?></td>
								<td><?php echo $fm->textShorten($result['description'], 50)  ?></td>
								<td> <img src="uploads/<?php echo $result['thumbnail'] ?>" width="100px" , height="100px"></td>
								<td><?php echo $result['price'] ?></td>
								<td><?php if ($result == 0) {
										echo "Non-Featured";
									} else {
										echo "Featured";
									}
									?></td>

								<td><a href="productedit.php?productid=<?php echo $result['product_id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete')" href="?delid=<?php echo $result['product_id'] ?>">Delete</a></td>
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