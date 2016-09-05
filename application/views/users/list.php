<div class="row">
	<div class="col-md-7">
		<div class="box box-solid">
			<div class="box-body">
				<a class="btn btn-default pull-right" href="<?= base_url('users/create')?>" style="margin-bottom:10px;">
					<i class="fa fa-plus"></i> Create new user
				</a>
				<table id="entries" class="table table-bordered clearfix" 
					data-delete-url="<?= base_url('users/delete') ?>">
					<thead>
						<tr>
							<th>Full name</th><th>Username</th><th>Login type</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items AS $i):?>
							<tr data-pk="<?= $i['id'] ?>">
								<td><?= $i['fullname'] ?></td>
								<td><?= $i['login_username'] ?></td>
								<td><?= login_type_description($i['login_type']) ?></td>
								<td>
									<a class="btn btn-info btn-xs" href="<?= base_url("users/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
									<a class="btn btn-danger btn-xs remove-line"><i class="fa fa-times "></i> Delete</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>