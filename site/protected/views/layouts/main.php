<?php /* @var $this Controller */ ?>
<!-- ready -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content=""/>
</head>
<body>
<div class="container clearfix" id="page">
    <header>
        <?php if ($this->header) { ?>
            <?= $this->header ?>
        <?php } else { ?>
            <table>
                <tr>
                    <td>
                        <a href="/site/menu">
                            <button type="button" class="menu_header collapsed" data-toggle="collapse"
                                    data-target=".navbar-ex2-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </a>
                    </td>


                    <td class="head-logo">
                        <a href="/"></a>
                    </td>

                    <?php if (substr_count(@$_SERVER['DOCUMENT_URI'], 'byCity') or substr_count(
                            $_SERVER['REQUEST_URI'],
                            'byRegion'
                        )
                    ) { ?>
                        <td class="select-filtr">
                            <select
                                onchange="window.location = '<?= 'http://' . @$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '&' . 'sortBy=' ?>'+this.options[this.selectedIndex].value;">
                                <option value="1">Рекомендуемые</option>
                                <option value="2">Цена</option>
                                <option value="3">Оценка гостей</option>
                                <option value="4">Рейтинг от Hotels24.ua</option>
                            </select>
                        </td><!-- select-filtr -->

                        <td class="tel_header">
                            <a href="/site/filter"></a>
                        </td><!-- tel_header -->
                    <?php } ?>
                </tr>
            </table>
        <?php } ?>
    </header>
    <!-- header -->

    <?php echo $content; ?>

    <footer>
        <ul>
            <li><a href="/site/about">О нас</a></li>
            <li><a href="/site/help">Помощь</a></li>
            <li><a href="/site/contacts">Контакты</a></li>
            <li><a href="/site/confidence">Конфиденциальность</a></li>
        </ul>
        <!--   <p class="copyright">Copyright © 2010 - 2014 ООО "Свит Дрим Украина"<br>
              Все права защищены.</p> -->
    </footer>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
