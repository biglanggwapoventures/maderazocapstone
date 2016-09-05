<div class="row">
	<div class="col-md-6">
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
					<div class="form-group">
						<label for="name">Type</label>
						<?= creditor_type_dropdown('creditor_type_id', get_val($data, 'creditor_type_id'), 'class="form-control" id="creditor-type"') ?>
					</div>
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= base_url('creditors') ?>" id="back">Back</a>
				</div>
			<?= form_close() ?>
		</div>
	</div>
</div>