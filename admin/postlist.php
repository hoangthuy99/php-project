<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/post.php'; ?>
<?php
$post = new post();
if (isset($_GET['delid'])) {
    $id = $_GET['delid'];
    $delpost = $post->del_post($id);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
		<?php
            if (isset($delpost)) {
                echo $delpost;
            }
            ?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial No.</th>
						<th>Category Post Name</th>
						<th>Category description</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$show_post = $post->show_post();
					if ($show_post) {
						$i = 0;
						while ($result = $show_post->fetch_assoc()) {
							$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i ;?></td>
							<td><?php echo $result['cat_name'];?></td>
							<td><?php echo $result['description'];?></td>
							<td><?php if ($result['status'] ==1){
                                echo "Ẩn hiện thị";
                                }else if ($result['status'] ==0){
                                    echo "Hiển thị";
                                }
                                ?></td>
							<td><a href="postEdit.php?postID=<?php echo $result['id_cat_post'] ?>">Edit</a> || <a onclick="return confirm('Are you sure you want to delete')" href="?delid=<?php echo $result['id_cat_post'] ?>">Delete</a></td>
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