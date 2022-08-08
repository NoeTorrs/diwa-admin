<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1.0</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button class="btn btn-primary" id="btnadduser" data-toggle="modal" href="#addusermodal"><strong><i class='fa fa-plus-circle'></i>  Add User</strong></button>
              	<table class="table table-striped text-center" id="userstable">
	              		<thead>
	              			<th>Email</th>
	              			<th>Confirmation Status</th>
                      <th>Account Status</th>
	              			<th>Action</th>
	              			<th>Action</th>
                      <th>Action</th>
	              		</thead>
	              		 <tbody>
	              			<?php foreach($users as $d): ?>
	              				<tr>
	              					<td><p id="uid"><input type="hidden" id="eid" value="<?=$d["Attributes"][0]["Value"]?>"><p id="email"><?=$d["Attributes"][0]["Value"]?></p></td>
	              					<td><p id="ustatus"><?=$d['UserStatus']?></p></td>
                          <td><p id="ustatus"><?php if($d['Enabled']){echo "Enabled";}else{echo "Disabled";}?></p></td>
	              					<td><button class="btndetails btn btn-primary" data-toggle="modal" href="#detailsmodal">Show Details</button></td>
	              					<td><button class="btn btn-danger">Reset Password</button></td>
                          <td><?php if($d["Enabled"]){?><button class="btn btn-warning">Disable</button><?php }else{ ?>
                            <button class="btn btn-success">Enable</button> <?php } ?>
                          </td>
	              				</tr>
	              			<?php endforeach; ?>
	              		</tbody>
	              	</table>

              </div>
             </div>
            </div>
          </div>
        </div>
      </section>

</div>


<div class="modal fade" tabindex="-1" role="dialog" id="addusermodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   	<form id="auform" method="POST" class="form" action="">
	      <div class="modal-header">
	        <h5 class="modal-title">New User</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	           <div class="form-group">
              <input type="hidden" name="createdBy" id="userlog" value="<?=$userlogged?>">
              <label for="email" class="">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
            </div>
            <div class="form-group">
              <label for="userTypeID" class="">User Type</label>
              <select type="text" class="form-control" name="userTypeID" id="userTypeID" required>
                <?php foreach($utype as $d) { ?>
                   <option value="<?=$d->userTypeID?>"><?=$d->userTypeName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="agencyID" class="">Agency</label>
              <select type="text" class="form-control" name="agencyID" id="agencyID" required>
                <?php foreach($agency as $d) { ?>
                   <option value="<?=$d->agencyID?>"><?=$d->agencyName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="agencyName" class="">Agency Name</label>
              <input type="text" class="form-control" name="agencyName" placeholder="Agency Name" required>
            </div>
            <div class="form-group">
              <label for="userJurID" class="">User Jurisdiction</label>
              <select type="text" class="form-control" name="userJurID" id="userJurID" required>
              	<?php foreach($userjuris as $d) { ?>
              	   <option value="<?=$d->userJurID?>"><?=$d->userJurName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="regionPSGC" class="">Region</label>
              <select type="text" class="form-control" name="regionPSGC" id="regionPSGC" required>
                <?php foreach($region as $d) { ?>
                   <option value="<?=$d->regionPSGC?>"><?=$d->regionName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="auprov">
              <label for="provincePSGC" class="">Province</label>
              <select type="text" class="form-control" name="provincePSGC" id="provincePSGC" >
                <?php foreach($province as $d) { ?>
                   <option value="<?=$d->provincePSGC?>"><?=$d->provinceName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="aumuni">
              <label for="municityPSGC" class="">Municipality/City</label>
              <select type="text" class="form-control" name="municityPSGC" id="municityPSGC" >
                <?php foreach($municity as $d) { ?>
                   <option value="<?=$d->municityPSGC?>"><?=$d->municityName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="aubrgy">
              <label for="barangayPSGC" class="">Barangay</label>
              <select type="text" class="form-control" name="barangayPSGC" id="barangayPSGC" >
                <?php foreach($barangay as $d) { ?>
                   <option value="<?=$d->barangayPSGC?>"><?=$d->barangayName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="prefix" class="">Prefix</label>
              <input type="text" class="form-control" name="prefix" placeholder="Prefix" >
            </div>
            <div class="form-group">
              <label for="firstName" class="">First Name</label>
              <input type="text" class="form-control" name="firstName" placeholder="firstName" required>
            </div>
            <div class="form-group">
              <label for="middleName" class="">Middle Name</label>
              <input type="text" class="form-control" name="middleName" placeholder="Middle Name" >
            </div>
            <div class="form-group">
              <label for="lastName" class="">Last Name</label>
              <input type="text" class="form-control" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="form-group">
              <label for="suffix" class="">Suffix</label>
              <input type="text" class="form-control" name="suffix" placeholder="suffix" >
            </div>
            <div class="form-group">
              <label for="birthdate" class="">Birthdate</label>
              <input type="date" class="form-control" name="birthdate" placeholder="Birthdate" required>
            </div>

            <div class="form-group">
              <label for="sexonbirth" class="">Sex on Birth</label>
              <select type="text" class="form-control" name="sexonbirth" id="sexonbirth" required>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
              </select>
            </div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Create</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>

    </form>
	    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="detailsmodal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="euform" method="POST" class="form" action="">
        <div class="modal-header">
          <h5 class="modal-title">User Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
             <div class="form-group">
              <input type="hidden" name="createdBy" id="userlog" value="<?=$userlogged?>">
              <label for="email" class="">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="email" required disabled>
            </div>
            <div class="form-group">
              <label for="userTypeID" class="">User Type</label>
              <select type="text" class="form-control" name="userTypeID" id="userTypeID" required disabled>
                <?php foreach($utype as $d) { ?>
                   <option value="<?=$d->userTypeID?>"><?=$d->userTypeName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="agencyID" class="">Agency</label>
              <select type="text" class="form-control" name="agencyID" id="agencyID" required disabled>
                <?php foreach($agency as $d) { ?>
                   <option value="<?=$d->agencyID?>"><?=$d->agencyName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="agencyName" class="">Agency Name</label>
              <input type="text" class="form-control" name="agencyName" placeholder="Agency Name" required disabled>
            </div>
            <div class="form-group">
              <label for="userJurID" class="">User Jurisdiction</label>
              <select type="text" class="form-control" name="userJurID" id="userJurID" required disabled>
                <?php foreach($userjuris as $d) { ?>
                   <option value="<?=$d->userJurID?>"><?=$d->userJurName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="regionPSGC" class="">Region</label>
              <select type="text" class="form-control" name="regionPSGC" id="regionPSGC" required disabled>
                <?php foreach($region as $d) { ?>
                   <option value="<?=$d->regionPSGC?>"><?=$d->regionName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="auprov">
              <label for="provincePSGC" class="">Province</label>
              <select type="text" class="form-control" name="provincePSGC" id="provincePSGC" >
                <?php foreach($province as $d) { ?>
                   <option value="<?=$d->provincePSGC?>"><?=$d->provinceName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="aumuni">
              <label for="municityPSGC" class="">Municipality/City</label>
              <select type="text" class="form-control" name="municityPSGC" id="municityPSGC" >
                <?php foreach($municity as $d) { ?>
                   <option value="<?=$d->municityPSGC?>"><?=$d->municityName?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group" style="display:none" id="aubrgy">
              <label for="barangayPSGC" class="">Barangay</label>
              <select type="text" class="form-control" name="barangayPSGC" id="barangayPSGC" disabled>
                <?php foreach($barangay as $d) { ?>
                   <option value="<?=$d->barangayPSGC?>"><?=$d->barangayName?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="prefix" class="">Prefix</label>
              <input type="text" class="form-control" name="prefix" placeholder="Prefix" disabled>
            </div>
            <div class="form-group">
              <label for="firstName" class="">First Name</label>
              <input type="text" class="form-control" name="firstName" placeholder="firstName" required disabled>
            </div>
            <div class="form-group">
              <label for="middleName" class="">Middle Name</label>
              <input type="text" class="form-control" name="middleName" placeholder="Middle Name" disabled>
            </div>
            <div class="form-group">
              <label for="lastName" class="">Last Name</label>
              <input type="text" class="form-control" name="lastName" placeholder="Last Name" required disabled>
            </div>
            <div class="form-group">
              <label for="suffix" class="">Suffix</label>
              <input type="text" class="form-control" name="suffix" placeholder="suffix" disabled>
            </div>
            <div class="form-group">
              <label for="birthdate" class="">Birthdate</label>
              <input type="date" class="form-control" name="birthdate" placeholder="Birthdate" required disabled>
            </div>

            <div class="form-group">
              <label for="sexonbirth" class="">Sex on Birth</label>
              <select type="text" class="form-control" name="sexonbirth" id="sexonbirth" required disabled>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id="btnedetails">Edit Details</button>
          <button type="submit" class="editdbtn btn btn-success" hidden>Submit Edits</button>
          <button type="submit" class="edidtbtn btn btn-danger" hidden>Cancel Edit</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

    </form>
      </div>
  </div>
</div>

