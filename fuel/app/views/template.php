<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo html_tag('link', array( 'rel' => 'shortcut icon', 'type' => 'image/x-icon', 'href' => Asset::get_file('favicon_blue.ico', 'img'))); ?>
    <?php echo html_tag('link', array( 'rel' => 'icon', 'type' => 'image/x-icon', 'href' => Asset::get_file('favicon_blue.ico', 'img'))); ?>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?= $title ?></title>

    <!-- Bootstrap -->
    <?php echo Asset::css("bootstrap.css"); ?>
    <?php echo Asset::css("bootstrap-theme.min.css"); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed"data-toggle="collapse"data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/list">用語帳</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav">
                    <li <?php if (isset($active_list)) {echo $active_list;} ?>><a href='/list' >用語一覧</a></li>
                    <li <?php if (isset($active_register)) {echo $active_register;} ?>><a href="/register">新規登録</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="container-fluid">
        <div class="panel panel-info">
            <div class="panel-heading"><?= $title ?></div>

            <div class="panel-body">
                <?= $content ?>
            </div>
            <?php if (isset($button_path) && isset($button_value)): ?>
                <a href=<?= $button_path ?>><?= $button_value ?></a>
            <?php endif; ?>
        </div>
    </div>
    <footer class="fixed-bottom">
        <div class="container">
            <p class="text-center">Powerd by Gurunavi.Inc</p>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
    <?php echo Asset::js("bootstrap.js"); ?>
</body>
</html>
