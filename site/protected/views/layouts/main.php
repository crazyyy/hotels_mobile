<?php /* @var $this Controller */ ?>
<!-- ready -->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="description" content="" />
</head>
<body>
<div class="container clearfix" id="page">
  <header>
    <?if($this->header){?>
    <?=$this->header?>
    <?}else{?>
    <table>
        <tr>
            <td>
                <a href="/site/menu"><button type="button" class="menu_header collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button></a>
            </td>

            <td>
                <a href="/"></a>
            </td>

            <?
                if(substr_count(@$_SERVER['DOCUMENT_URI'], 'byCity') or substr_count($_SERVER['REQUEST_URI'], 'byRegion'))
            {
            ?>
            <td>
                <div class="select-filtr w8p">
                    <select onchange="window.location = '<?='http://'.@$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'&'.'sortBy='?>'+this.options[this.selectedIndex].value;">
                        <option value="1">Рекомендуемые</option>
                        <option value="2">Цена</option>
                        <option value="3">Оценка гостей</option>
                        <option value="4">Рейтинг от Hotels24.ua</option>
                    </select>
                </div>
            </td>

            <td>
                <div class="tel_header">
                    <a href="/site/filter">
                        <img class="v-aM" alt="Call" src="/images/icon_1.png">
                    </a>
                </div>
            </td>
            <?}?>

            <td>
                <a href="/site/contacts"></a>
            </td>
        </tr>
    </table>
      <?}?>
    </header><!-- header -->

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
  </footer><!-- footer -->

</div><!-- page -->

</body>
</html>
