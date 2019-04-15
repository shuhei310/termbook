<div class="container">
    <!-- 用語名　略語 -->
    <h1><?php
    if ($term_data[0]['abbreviation'])
    {
        echo $term_data[0]['term_name'].'('.$term_data[0]['abbreviation'].')';
    }
    else
    {
        echo $term_data[0]['term_name'];
    }
    ?></h1><br>
    <!-- 意味　参考　備考 -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered" style="table-layout:fixed;width:100%;">
            <colgroup>
                <col style="width:10%;">
                <col style="width:90%;">
            </colgroup>
            <thead>
                <?php if ($term_data[0]['meaning']): ?>
                <tr>
                    <th class="info">意味</th>
                    <td style="word-wrap:break-word;"><?= nl2br($term_data[0]['meaning']) ?></td>
                </tr>
                <?php endif; ?>
            </thead>
            <thead>
                <?php foreach ($term_data as $key =>$value): ?>
                    <?php if (!empty($value['reference'])): ?>
                    <tr>
                        <?php if (empty($th_flg)): ?>
                            <th rowspan=<?= $reference_count ?> class="info">参考サイト</th>
                            <?php $th_flg = 1; ?>
                        <?php endif; ?>
                            <td style="word-wrap:break-word;"><a href=<?= $value['reference'] ?> target="_blank"><?= $value['reference'] ?></a></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </thead>
            <thead>
                <?php if ($term_data[0]['remarks']): ?>
                    <tr>
                        <th class="info">備考</th>
                        <td style="word-wrap:break-word;"><?= nl2br($term_data[0]['remarks']) ?></td>
                    </tr>
                <?php endif; ?>
            </thead>
        </table>
    </div>
    <!-- 更新日付 -->
    <div class="row">
        <div class="col-xs-3">
            <p>登録日時：<?= $value['create_date'] ?> </p>
        </div>
        <?php if ($value['create_date'] !== $value['update_date']): ?>
            <div class="col-xs-3">
                <p>最終更新日時：<?= $value['update_date'] ?> </p>
            </div>
        <?php endif; ?>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6">
            <!-- 更新ボタン -->
            <?php echo Form::open('update'); ?>
            <div class="actions form-group">
                <?php echo Form::submit('submit', '更新', array('class'=>'btn btn-warning btn-lg btn-block')) ?>
            </div>
            <?php echo Form::close(); ?>
        </div>
        <div class="col-xs-6">
            <!-- 削除ボタン -->
            <?php echo Form::open('delete'); ?>
            <div class="actions form-group">
                <?php echo Form::submit('submit', '削除', array('class'=>'btn btn-danger btn-lg btn-block')) ?>
            </div>
            <?php echo Form::close(); ?>
        </div>
    </div>
</div>
