<?php if(isset($html_error)): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $html_error; ?>
    </div>
<?php endif; ?>

<?php echo Form::open('register/submit'); ?>
<div class="form-inline">
    <div class="form-group">
        <?php echo Form::label('用語名 *必須項目','term_name'); ?>
        <br>
        <?php echo Form::input('term_name', Input::post('term_name'), array('class'=>'form-control')); ?>
    </div>
    <div class="form-group">
        <?php echo Form::label('略語','abbreviation'); ?>
        <br>
        <?php echo Form::input('abbreviation', Input::post('abbreviation'), array('class'=>'form-control')); ?>
    </div>
</div>
<br>
<div class="form-group">
    <?php echo Form::label('意味','meaning'); ?>
    <?php echo Form::textarea('meaning', Input::post('meaning'), array('class'=>'form-control')); ?>
</div>
<div class="form-group">
    <?php echo Form::label('参考サイト *最大5件まで','reference'); ?>
    <?php echo Form::input('reference0', Input::post('reference0'), array('class'=>'form-control')); ?>
    <?php for ($i=1; $i < 5; $i++) {
        if (Input::post('reference'.$i)) {
            echo Form::input('reference'.$i, Input::post('reference'.$i), array('class'=>'form-control'));
        } else {
            break;
        }
    } ?>
    <!-- フォームを増やす処理 -->
    <script type="text/javascript">var i_val = "<?= $i ?>";</script>
    <button type="button" id="addBtn" class="btn btn-default">追加</button>
    <ul id="list" class="list-unstyled"></ul>
</div>
<div class="form-group">
    <?php echo Form::label('備考','remarks'); ?>
    <?php echo Form::textarea('remarks', Input::post('remarks'), array('class'=>'form-control')); ?>
</div>
<?php echo Form::csrf(); ?>
<div class="actions form-group">
    <?php echo Form::submit('submit', '登録', array('class'=>'btn btn-primary btn-lg')) ?>
</div>
<?php echo Form::close(); ?>
