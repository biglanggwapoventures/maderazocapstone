<div class="row">
	<div class="col-sm-6">
		<div class="box box-solid">
			<div class="box-body">
				<a class="btn btn-default pull-right" href="<?= base_url('creditors/create')?>" style="margin-bottom:10px;">
					<i class="fa fa-plus"></i> New creditor
				</a>
				<table id="entries" class="table table-bordered clearfix" 
					data-delete-url="<?= base_url('creditors/delete') ?>">
					<thead>
						<tr>
							<th>Name</th><th>Type</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items AS $i):?>
							<tr data-pk="<?= $i['id'] ?>">
								<td><?= $i['name'] ?></td>
								<td><?= $i['type'] ?></td>
								<td>
									<a class="btn btn-info btn-xs" href="<?= base_url("creditors/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
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