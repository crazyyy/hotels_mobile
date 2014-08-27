<?php /* @var $this Controller */ ?>
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

<div class="container" id="page">

    <header>
        <?if($this->header){?>
        <?=$this->header?>
        <?}else{?>
        <div class="navbar-inverse">
                <a href="/site/menu"><button type="button" class="menu_header collapsed" data-toggle="collapse" data-target=".navbar-ex2-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                </a>
            </div>
        <div class="center wrap">
            <div class="dispIB"><a href="#"><img src="/images/logo_opera_mini.png" alt="Logo" class="logo_mini"></a></div>
        </div>
            <div class="tel_header">
             <a href="/site/contacts">
            <img src="/images/tell_opera_mini.png" alt="Call" class="v-aM">
             </a>
            </div>
         <?}?>
    </header><!-- header -->



	<?php echo $content; ?>

	<div class="clear"></div>



</div><!-- page -->

</body>
</html>
