<div class="row">
	<div class="col-md-5">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h4 class="box-title"><?= $title ?></h4>
			</div>
			<?= form_open($action, 'id="ajax"');?>
				<div class="box-body">
					<div class="callout callout-danger hidden" id="validation-messages">
						<ul class="list-unstyled"></ul>
					</div>	
					<div class="form-group">
						<label for="name">Name</label>
						<?= form_input('name', get_val($data, 'name'), 'class="form-control" id="name"') ?>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr class="bg-teal">
								<th class="text-center">FUEL TYPES</th>
								<th style="width:5%">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php $fuelTypes = get_val($data, 'fuel_types', [[]])?>
							<?php foreach($fuelTypes AS $row):?>
								<tr>
									<td>
										<?php if(isset($row['id'])):?>
											<?= form_hidden('id[]', $row['id'])?>
										<?php endif;?>
										
										<?= fuel_type_dropdown('fuel_type_id[]', get_val($row, 'fuel_type_id', FALSE), 'class="form-control"')?>
									</td>
									<td>
										<a class="btn btn-danger" data-click="remove-line"><i class="fa fa-times"></i></a>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2" style="border:0"><a class="btn btn-default" data-click="new-line"><i class="fa fa-plus"></i> Add new line</a></td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= base_url('pumps') ?>" id="back">Back</a>
				</div>
			<?= form_close() ?>
		</div>
	</div>
</div>