<div class="row">
	<div class="col-md-8">
		<div class="box box-solid">
			<div class="box-header with-border"><h4 class="box-title"><?= $title ?></h4></div>
			<?= form_open($action, 'id="ajax"');?>
				<div class="box-body">
					<div class="callout callout-danger hidden" id="validation-messages">
						<ul class="list-unstyled"></ul>
					</div>	
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="firstname">First name</label>
								<?= form_input('firstname', get_val($data, 'firstname'), 'class="form-control" id="firstname"') ?>
							</div>
							<div class="form-group">
								<label for="lastname">Last name</label>
								<?= form_input('lastname', get_val($data, 'lastname'), 'class="form-control" id="lastname"') ?>
							</div>
							<div class="form-group">
								<label for="position">Position</label>
								<?= form_input('position', get_val($data, 'position'), 'class="form-control" id="position"') ?>
							</div>
							<div class="form-group">
								<label for="contact_number">Contact number</label>
								<?= form_input('contact_number', get_val($data, 'contact_number'), 'class="form-control" id="contact_number"') ?>
							</div>
							<div class="form-group">
								<label for="email_address">Email address</label>
								<?= form_input('email_address', get_val($data, 'email_address'), 'class="form-control" id="email_address"') ?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="login_username">Username</label>
								<?= form_input('login_username', get_val($data, 'login_username'), 'class="form-control" id="login_username"') ?>
							</div>
							<div class="form-group">
								<label for="login_password">Password</label>
								<?= form_password('login_password', FALSE, 'class="form-control" id="login_password"') ?>
							</div>
							<div class="form-group">
								<label for="password_confirmation">Confirm password</label>
								<?= form_password('password_confirmation', FALSE, 'class="form-control" id="password_confirmation"') ?>
							</div>
							<div class="well well-sm bg-maroon">
								<div class="form-group">
									<label for="login_type">User type</label>
									<?= form_dropdown('login_type', ['' => '', 's' => 'Standard user', 'a' => 'Admin'], get_val($data, 'login_type'), 'class="form-control" id="login_type"') ?>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-default timeshifts">
						<div class="panel-heading">
							<h3 class="panel-title">Time shifts</h3>
						</div>
						<div class="panel-body">
							<table class="table">
								<thead>
									<tr>
										<th>Day</th>
										<th>Start</th>
										<th>End</th>
										<th></th>
									</tr>
									<tbody>
										<tr>
											<td>
												<?= form_dropdown(
													'shift[0]', 
													['' => '', 'Mon' => 'Monday', 'Tue' => 'Tuesday', 'Wed' => 'Wednesday', 'Thu' => 'Thursday', 'Fri' => 'Friday', 'Sat' => 'Saturday', 'Sun' => 'Sunday', ],
													'',
													'class="form-control" data-name="shift[idx][day]"'
												);?>
											</td>
											<td><?= form_input()?></td>
											<td><?= form_input()?></td>
											<td></td>
										</tr>
									</tbody>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= base_url('users') ?>" id="back">Back</a>
				</div>
			<?= form_close() ?>
		</div>
	</div>
</div>