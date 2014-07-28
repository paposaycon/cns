<?php require_once Config::get('mlm_config.get_header'); ?>

<?php 
if (Auth::check()) 
{ 
?>
<div class="row">
<section id="profile" class="col-md-8 col-sm-8">
	<h3>Account Details</h3>
	ID: <?= Config::get('mlm_config.id_prefix') ?><?= Auth::user()->id ?> <br>
	Username: <?= Auth::user()->username ?> <br>
	Email: <?= Auth::user()->email ?> <br>
	Password: ****** <br>
	First Name: <?= Auth::user()->firstname ?> <br>
	Middle Name: <?= Auth::user()->middlename ?> <br>
	Last Name: <?= Auth::user()->lastname ?> <br>
	Gender: <?= Auth::user()->sex ?> <br>
	Direct Upline: <?= Auth::user()->directupline ?> <br>
	Sponsor: <?= Auth::user()->sponsor ?> <br>
	Registered at: <?= Auth::user()->created_at ?> <br>
	Last Account Update: <?= Auth::user()->updated_at ?>

	<br><br>
	<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#edit_profile">Edit Profile</button>
	<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#change_password">Change Password</button>
	<br><br>


	<!-- Editprofile Modal -->
	<div class="modal fade" id="edit_profile">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><b>Edit Profile</b></h4>
				</div>
				<div class="modal-body">
					<div class="editprofile-error"></div>
					<div class="registration-form">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-username">Username</label>
								<input type="text" class="form-control" name="update-username" id="update-username" value="<?= Auth::user()->username ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-firstname">First Name</label>
								<input type="text" class="form-control" name="update-firstname" id="update-firstname" value="<?= Auth::user()->firstname ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-middlename">Middle Name</label>
								<input type="text" class="form-control" name="update-middlename" id="update-middlename" value="<?= Auth::user()->middlename ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-lastname">Last Name</label>
								<input type="text" class="form-control" name="update-lastname" id="update-lastname" value="<?= Auth::user()->lastname ?>" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-sex">Gender</label>
								<input type="text" class="form-control" name="update-sex" id="update-sex" value="<?= Auth::user()->sex ?>" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submit-profile-changes">Save Changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- Editprofile Modal - END-->

	<!-- Change password Modal -->
	<div class="modal fade" id="change_password">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title"><b>Change Password</b></h4>
				</div>
				<div class="modal-body">
					<div class="changepassword-error"></div>
					<div class="registration-form">
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-currentpassword">Current Password</label>
								<input type="password" class="form-control" name="update-currentpassword" id="update-currentpassword">
							</div>						
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-newpassword">New Password</label>
								<input type="password" class="form-control" name="update-newpassword" id="update-newpassword">
							</div>						
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="update-confirmnewpassword">Confirm Password</label>
								<input type="password" class="form-control" name="update-confirmnewpassword" id="update-confirmnewpassword">
							</div>						
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" id="submit-password-changes">Save New Password</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- Change password Modal - END-->

	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos quis modi optio vero sit, accusantium suscipit voluptatibus commodi nisi id nobis harum esse nam inventore consequatur ut, quo dolore animi. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa atque ducimus quisquam maxime, quos officiis velit cum iure quidem inventore hic voluptatibus facilis esse nisi commodi accusantium ut! Ut, similique!
</section>

<?php echo View::make('common.sidebar-right')->render(); ?>
</div>
<?php }
else 
{
	// If Guest.
} 
?>

<script>
	$(document).ready(function () {
		
		// Validator
		function validateUsername(data) {
			var pattern = /^[a-z0-9]{6,}/i;
			return pattern.test(data);
		}
		function validateName(data) {
			var pattern = /^[a-z0-9]{2,}/i;
			return pattern.test(data);
		}
		function validateSponsor(data) {
			if(data != null){
				if (data.length != 0) {
					return true;
				}
			}
			else {
				return false;
			}
		}

		$('#submit-profile-changes').click(function() {
			var username = $('#update-username').val(),
				firstname = $('#update-firstname').val(),
				middlename = $('#update-middlename').val(),
				lastname = $('#update-lastname').val(),
				sex = $('#update-sex').val(),
				errormsg = '';

			function addError(data) {
				errormsg += data + "<br>";
			}
			validateUsername(username) || addError('*Username must be at least 6 characters(Also use alphanumeric characters)');
			validateName(firstname) || addError('*First name should be at least 2 characters');
			validateName(middlename) || addError('*Last name should be at least 2 characters');
			validateName(lastname) || addError('*Last name should be at least 2 characters');
			$('.editprofile-error').html('<div class="alert alert-danger">' + errormsg + '</div>');
			errormsg == '' && updateProfile();
			

			function updateProfile() {
				$.ajax({
					url:"<?= route('updateprofile') ?>",
					type: 'POST',
					data: {
						field : 'common',
						username : username,
						firstname : firstname,
						middlename : middlename,
						lastname : lastname,
						sex : sex
					},
					beforeSend:function(){
						$('#submit-profile-changes').html('Verifying and Saving');
					},
					success:function(result){
					    if (result == 'true') {
					    	location.reload(true); 
					    }
					    else {
					    	$('.editprofile-error').html('<h4 style="color: red;">' + result + '</h4>');
					    	$('#submit-profile-changes').html('Save Changes');
					    }
					}
				});
			}
		});
	});
</script>

<script>
	$(document).ready(function () {

		// Validator
		function validatePassword(data) {
			if (data != undefined){
				if (data.length > 7) {
					return true;
				}
			}
			else {
				return false;
			}
		}

		$('#submit-password-changes').click(function() {
			var currentpassword = $('#update-currentpassword').val(),
				newpassword = $('#update-newpassword').val(),
				confirmnewpassword = $('#update-confirmnewpassword').val(),
				errormsg = '';

			function addError(data) {
				errormsg += data + "<br>";
			}

			validatePassword(newpassword) || addError('*Password must be at least 8 characters');
			newpassword == confirmnewpassword || addError('New Password does not match');
			errormsg == '' && updatePassword();
			$('.changepassword-error').html('<div class="alert alert-danger">' + errormsg + '</div>');

			function updatePassword(){
				$.ajax({
					url:"<?= route('updateprofile') ?>",
					type: 'POST',
					data: {
						field : 'password',
						currentpassword : currentpassword,
						newpassword : newpassword,
					},
					beforeSend:function(){
						$('#submit-password-changes').html('Verifying and Saving');
					},
					success:function(result){
					    if (result == 'true') {
					    	location.reload(true); 
					    }
					    else
					    {
					    	$('.changepassword-error').html('<h4 style="color: red;">' + result + '</h4>');
					    }
					}
				});
			}
		});
	});
</script>
<?php require_once Config::get('mlm_config.get_footer'); ?>