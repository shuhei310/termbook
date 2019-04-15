<div class="container">
    <br>
    <div class="text-center">
        <h1><?= $term_data['term_name'] ?>を削除しますか？</h1>
    </div>
    <br>
    <div class="col-xs-6">
        <!-- いいえ -->
        <?php echo Form::open('/detail?term_id='.$term_data['term_id']); ?>
        <div class="actions form-group">
            <?php echo Form::submit('submit', 'いいえ', array('class'=>'btn btn-warning btn-lg btn-block')) ?>
        </div>
        <?php echo Form::close(); ?>
    </div>
    <div class="col-xs-6">
        <!--はい -->
        <?php echo Form::open('delete/submit'); ?>
        <div class="actions form-group">
            <?php echo Form::submit('submit', 'はい', array('class'=>'btn btn-danger btn-lg btn-block')) ?>
        </div>
        <?php echo Form::close(); ?>
    </div>
</div>
