 <div class="col-sm-12"> <!-- menampilkan form add user-->
				<section class="panel">
                    <div class="panel-body">
                        <a class="btn btn-compose">Add Data Ustad</a>
                        <div class="box-body"	>

                      <div class="form-group">

                        <form class="form-horizontal style-form" role="form" action="act/insertustad.php" method="post">
						<?php
          $query = mysqli_query($conn,"SELECT MAX(id) AS id FROM ustad");
          $result = mysqli_fetch_array($query);
          $idmax = $result['id'];
          if ($idmax==null) {$idmax=1;}
          else {$idmax++;}
        ?>
		<input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $idmax;?>">
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label" for="nama"><span style="color:red">*</span>Name</label>
		  <div class="col-sm-10">
          <input type="text" class="form-control" name="nama" value="">
		   </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label" for="alamat"><span style="color:red"></span>Address</label>
		  <div class="col-sm-10">
          <input type="text" class="form-control" name="alamat" value="">
		   </div>
        </div>
		<div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label" for="no_hp"><span style="color:red"></span>Contact</label>
		  <div class="col-sm-10">
          <input type="text" class="form-control" name="no_hp" value="">
		   </div>
        </div>
        <button type="submit" class="btn btn-primary pull-right" style="background-color: #26a69a; border: 1px solid #e7e7e7;">Save <i class="fa fa-floppy-o"></i></button>
</form>
         </div>
         </div>
         </div>
         </section>
         </div>
