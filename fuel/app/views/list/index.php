<div class="container">
    <div class="row">
        <div class="col-xs-2">
            <!-- ソート -->
            <div class="input_form">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        並び替え
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="list?sort_key=create_date">登録日時</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="list?sort_key=update_date">更新日時</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="list?sort_key=term_name">文字列</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-7 pull-right">
            <!-- 検索フォーム -->
            <?php echo Form::open('list/search'); ?>
            <div class="input-group">
                <?php echo Form::input('search_word', Input::post('search_word') ,array('class'=>'form-control','placeholder'=>'検索ワードを入力')); ?>
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
    <!-- タブ・メニュー -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#ContentA" data-toggle="tab">降順</a></li>
        <li><a href="#ContentB" data-toggle="tab">昇順</a></li>
    </ul>
    <!-- タブ内容 -->
    <div class="tab-content">
        <div class="tab-pane active" id="ContentA">
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
            <div class="list-group text-center">
                <a href="#" class="list-group-item toThePageTop"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
            </div>
        <?php }
        else
        { ?>
            <div class="alert alert-warning" role="alert">用語がありません</div>
        <?php } ?>
    </div>
    <div class="tab-pane" id="ContentB">
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
                        <?php foreach (array_reverse($terms) as $term): ?>
                            <tr data-href='/detail?term_id=<?= $term['term_id'] ?>'>
                                <td style="word-wrap:break-word;"><?= $term['term_name'] ?></td>
                                <td style="word-wrap:break-word;"><?= $term['meaning'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="list-group text-center">
            <a href="#" class="list-group-item toThePageTop"><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
        </div>
    <?php }
    else
    { ?>
        <div class="alert alert-warning" role="alert">用語がありません</div>
    <?php } ?>
</div>
</div>

</div>
