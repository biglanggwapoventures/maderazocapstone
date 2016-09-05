<div class="row">
	<div class="col-md-6">
		<div class="box box-solid">
			<div class="box-body">
				<a class="btn btn-default pull-right" href="<?= base_url('fuel-types/create')?>" style="margin-bottom:10px;">
					<i class="fa fa-plus"></i> New fuel type
				</a>
				<table id="entries" class="table table-bordered clearfix" 
					data-delete-url="<?= base_url('creditor-types/delete') ?>">
					<thead>
						<tr>
							<th>Name</th><th>Price</th><th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($items AS $i):?>
							<tr data-pk="<?= $i['id'] ?>">
								<td><?= $i['name'] ?></td>
								<td><?= number_format($i['price'], 2) ?></td>
								<td>
									<a class="btn btn-info btn-xs" href="<?= base_url("fuel-types/edit/{$i['id']}") ?>"><i class="fa fa-pencil"></i> Edit</a>
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