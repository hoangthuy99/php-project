<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php include '../classes/blog.php'; ?>
<?php include_once '../helpers/format.php'; ?>
<?php
$blog = new blog();
$fm = new Format();
if (isset($_GET['delid'])) {
	$id = $_GET['delid'];
	$delblog = $blog->del_blog($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Blog List</h2>
		<div class="block">
			<?php
			if (isset($delblog)) {
				echo $delblog;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Blog Name</th>
						<th>Category</th>
						<th>Description</th>
						<th>Image</th>
						<th>Status</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$bloglist = $blog->show_blog();
					if ($bloglist) {
						$t = 0;
						while ($result = $bloglist->fetch_assoc()) {
							$t++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $t ?></td>
								<td><?php echo $result['blog_name'] ?></td>
								<td><?php echo $result['cat_name'] ?></td>
								<td><?php echo $fm->textShorten($result['description'], 50)  ?></td>
								<td> <img src="uploads/<?php echo $result['image'] ?>" width="100px" , height="100px"></td>
								<td><?php if ($result['status'] == 0) {
										echo "Hiển thị";
									} else {
										echo "Ẩn hiển thị";
									}
									?></td>

								<td><a href="blogedit.php?blogid=<?php echo $result['blog_id'] ?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete')" href="?delid=<?php echo $result['blog_id'] ?>">Delete</a></td>
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