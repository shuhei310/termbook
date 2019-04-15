<?php if(isset($html_error)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $html_error; ?>
    </div>
<?php endif; ?>
<?php echo Form::open('update/submit'); ?>

<div class="form-group">
    <?php echo Form::label('用語名','term_name'); ?>
    <br>
    <div class="">
        <?= $terms['term_name'] ?>
    </div>
</div>
<div class="form-group">
    <?php echo Form::label('略語','abbreviation'); ?>
    <?php echo Form::input('abbreviation', $terms['abbreviation'], array('class'=>'form-control')); ?>
</div>
<div class="form-group">
    <?php echo Form::label('意味','meaning'); ?>
    <?php echo Form::textarea('meaning', $terms['meaning'], array('class'=>'form-control')); ?>
</div>
<div class="form-group">
    <?php echo Form::label('参考サイト *最大5件まで','reference'); ?>
    <?php echo Form::input('reference0', $terms['reference0'], array('class'=>'form-control')); ?>
    <?php $count_form = 1;
    for ($i=1; $i < 5; $i++) {
        if (array_key_exists('reference'.$i,$terms) && $terms['reference'.$i])
        {
            if ($terms['reference'.$i])
            {
                echo Form::input('reference'.$i, $terms['reference'.$i], array('class'=>'form-control'));
                $count_form++;
            }
        }
    } ?>
    <!-- フォームを増やす処理 -->
    <script type="text/javascript">var i_val = "<?= $count_form ?>";</script>
    <button type="button" id="addBtn" class="btn btn-default">追加</button>
    <ul id="list" class="list-unstyled"></ul>
</div>
<div class="form-group">
    <?php echo Form::label('備考','remarks'); ?>
    <?php echo Form::textarea('remarks', $terms['remarks'], array('class'=>'form-control')); ?>
</div>
<?php echo Form::csrf(); ?>
<div class="actions form-group">
    <?php echo Form::submit('submit', '更新', array('class'=>'btn btn-warning btn-lg')) ?>
</div>
<?php echo Form::close(); ?>
