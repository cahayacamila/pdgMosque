<div class="col-sm-12"> <!-- menampilkan form add facility-->
        <section class="panel">
                    <div class="panel-body">
                        <a class="btn btn-compose">Update Facility</a>
                        <div class="box-body" >

        <?php  if (isset($_GET['id'])){
					$id=$_GET['id'];
					$sql = mysqli_query($conn,"SELECT * FROM facility where id=$id");
					$data = mysqli_fetch_array($sql)
				?>
		<form role="form" action="act/updfas.php" method="post">
					<button type="submit" class="btn btn-primary pull-right" style="background-color: #26a69a; border: 1px solid #e7e7e7;">Update <i class="fa fa-floppy-o"></i></button>
					<input type="text" class="form-control hidden" name="id_fasilitas" value="<?php echo $data['id'] ?>">
					<div class="form-group" style="clear:both">
						<label for="nama">Facility</label>
						<input type="text" class="form-control" name="fasilitas" value="<?php echo $data['name'] ?>" required>
					</div>
				</form>
				<?php } ?>
                  </div>
                    </div>
                </section>
                 </div>