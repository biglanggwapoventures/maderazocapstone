<div class="box box-solid">
    <div class="box-body">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-navy">
                            <th>Date</th>
                            <th>Cashier</th>
                            <th>Shift</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($shifts AS $row):?>
                            <tr>
                                <td><?= format_date($row['shift_date'], 'F d, Y')?></td>
                                <td><?= $row['user'] ?></td>
                                <td><?= $row['shift_type'] ?></td>
                                <td><a href="<?= base_url("users/view-shift?attendance_id={$row['id']}")?>" target="_blank" class="btn btn-info btn-xs">View</a></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>