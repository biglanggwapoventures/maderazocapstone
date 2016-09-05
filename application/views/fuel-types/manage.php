<div class="row">
	<div class="col-md-4">
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
						<label for="price">Price</label>
						<?= form_input('price', get_val($data, 'price'), 'class="form-control" id="price"') ?>
					</div>
					
				</div>
				<div class="box-footer">
					<button type="submit" class="btn btn-success">Submit</button>
					<a class="btn btn-default pull-right" href="<?= base_url('fuel-types') ?>" id="back">Back</a>
				</div>
			<?= form_close() ?>
		</div>
	</div>
</div>