<div class="container">
    <div class="row">
        <!-- 検索フォーム -->
        <div class="col-sm-5  pull-right">
            <?php echo Form::open('list/search'); ?>
            <div class="input-group">
                <?php echo Form::input('search_word', Input::post('search_word') ,array('class'=>'form-control')); ?>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class='glyphicon glyphicon-search'></i>
                    </button>
                </span>
            </div>
            <?php echo Form::close(); ?>
        </div>
    </div>
    <br>
    <?php if ($terms)
    { ?>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" style="table-layout:fixed;width:100%;">
                <colgroup>
                    <col style="width:15%;">
                    <col style="width:85%;">
                </colgroup>
                <thead>
                    <tr class="info">
                        <th>用語名</th>
                        <th>意味</th>
                    </tr>
                </thead>
                <!--
                モデルから取得した用語データをデータがある数だけループ表示
            -->
            <tbody>
                <?php if (isset($terms)): ?>
                    <?php foreach ($terms as $term): ?>
                        <tr data-href='/detail?term_id=<?= $term['term_id'] ?>'>
                            <td style="word-wrap:break-word;"><?= $term['term_name'] ?></td>
                            <td style="word-wrap:break-word;"><?= $term['meaning'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php }
else
{ ?>
    <div class="alert alert-warning" role="alert">検索結果がありません</div>
<?php } ?>
<div class="list-group text-center">
    <a href="#" class="list-group-item toThePageTop"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
</div>
</div>
