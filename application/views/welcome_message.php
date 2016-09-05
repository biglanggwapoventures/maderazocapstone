<div class="box box-solid">
    <div class="box-body">
        <form action="<?= base_url('home/save') ?>" method="post">
            <div class="row">
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            <i class="fa fa-money"></i> Money Endorsed
                            </h3>
                        </div>
                        <div class="panel-body has-calculation">
                            <?php $pump_values = isset($current_sales['data']['pumps']) ? $current_sales['data']['pumps'] : []; ?>
                            <?php foreach($pumps AS $key => $pump):?>
                                <div class="form-group">
                                    <label ><?= $pump['name'] ?></label>
                                    <?php $val = isset($pump_values[$pump['id']]) ? $pump_values[$pump['id']]['value'] : ''; ?>
                                    <?= form_input("pumps[{$pump['id']}][value]", $val, 'class="form-control pformat variable" data-action="add"')?>
                                </div>
                            <?php endforeach; ?>
                             <div class="form-group">
                                <label><strong>Total</strong></label>
                                <p class="form-control-static total text-bold bg-orange text-center"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            <i class="fa fa-cubes"></i> G.L.A.D.S.
                            </h3>
                        </div>
                        <div class="panel-body has-calculation">
                            <?php $glads = isset($current_sales['data']['glads']) ? $current_sales['data']['glads'] : [];?>
                            <div class="form-group">
                                <label>Gasul</label>
                                <?= form_input("glads[gasul]", element('gasul', $glads), 'class="form-control pformat variable" data-action="add"')?>
                            </div>
                            <div class="form-group">
                                <label>Lubes</label>
                                <?= form_input("glads[lubes]", element('lubes', $glads), 'class="form-control pformat variable" data-action="add"')?>
                            </div>
                            <div class="form-group">
                                <label>Accessories</label>
                                <?= form_input("glads[accessories]", element('accessories', $glads), 'class="form-control pformat variable" data-action="add"')?>
                            </div>
                            <div class="form-group">
                                <label>Drinks</label>
                                <?= form_input("glads[drinks]", element('drinks', $glads), 'class="form-control pformat variable" data-action="add"')?>
                            </div>
                            <div class="form-group">
                                <label>Shop</label>
                                <?= form_input("glads[shop]", element('shop', $glads), 'class="form-control pformat variable" data-action="add"')?>
                            </div>
                             <div class="form-group">
                                <label><strong>Total</strong></label>
                                 <p class="form-control-static total text-bold bg-orange text-center"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            <i class="fa fa-credit-card"></i> Credits
                            </h3>
                        </div>
                        <div class="panel-body">
                             <?php $credits = isset($current_sales['data']['credits']) ? $current_sales['data']['credits'] : [];?>
                            <div class="form-group">
                                <label>BPI</label>
                                <?= form_input("credits[BPI]", element('BPI', $credits), 'class="form-control pformat"')?>
                            </div>
                            <div class="form-group">
                                <label>BDO</label>
                               <?= form_input("credits[BDO]", element('BDO', $credits), 'class="form-control pformat"')?>
                            </div>
                            <div class="form-group">
                                <label>Fleet</label>
                               <?= form_input("credits[fleet]", element('fleet', $credits), 'class="form-control pformat"')?>
                            </div>
                            <div class="form-group">
                                <label>Redeem</label>
                                <?= form_input("credits[redeem]", element('redeem', $credits), 'class="form-control pformat"')?>
                            </div>
                            <div class="form-group">
                                <label>Add Creditor</label>
                                <?= form_dropdown('credits[creditor]', ['' => ''] + array_column($creditors, 'name', 'id'), element('creditor', $credits), 'class="form-control"')?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                     <div class="well well-sm has-calculation bg-gray">
                         <?php $summary = isset($current_sales['data']['summary']) ? $current_sales['data']['summary'] : [];?>
                        <div class="form-group">
                            <label>Disbursements</label>
                            <?= form_input("summary[disbursements]", element('disbursements', $summary), 'class="form-control pformat variable" data-action="subtract"')?>
                        </div>
                        <div class="form-group">
                            <label>Cash Remitted</label>
                            <?= form_input("summary[cash_remitted]", element('cash_remitted', $summary), 'class="form-control pformat variable" data-action="add"')?>
                        </div>
                        <div class="form-group">
                            <label>Cash Collections</label>
                            <?= form_input("summary[cash_collections]", element('cash_collections', $summary), 'class="form-control pformat"')?>
                        </div>
                        <div class="form-group">
                            <label>Total Deposit</label>
                            <p class="form-control-static total text-bold  text-center bg-green"></p>
                        </div>
                     </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
</div>