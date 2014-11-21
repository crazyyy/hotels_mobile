<?php
/* @var $this Pagination */
$pagination = $this->pagination;
?>

<?php if ($pagination->getPageCount() > 1) : ?>
    <div class="center">
        <div class="pag_wrap">
            <?php if ($pagination->getCurrentPage(false) > 0) : ?>
                <a href="<?= CHtml::encode($pagination->createPageUrl($this->getController(), $pagination->getCurrentPage(false) -1 )) ?>">
                    <div class="floatL pag_body marL20 pad_str_L">
                        <img class="floatL" alt="" src="/images/str_l.png">
                        <span class="padL15">Предыдущая</span></div>
                </a>
            <?php endif; ?>

            <?php if ($pagination->getCurrentPage(false) <  $pagination->getPageCount() - 1) : ?>
                <a href="<?= CHtml::encode($pagination->createPageUrl($this->getController(), $pagination->getCurrentPage(false) + 1 )) ?>">
                    <div class="floatR pag_body marR20 pad_str_R">
                        <span class="padR15">Следующая</span>
                        <img class="floatR" alt="" src="/images/str_r.png">
                    </div>
                </a>
            <?php endif; ?>
        </div>
        <div class="paginator">Страница: <?= CHtml::encode($this->pagination->getCurrentPage(false) + 1) ?> из <?= CHtml::encode($this->pagination->getPageCount()) ?></div>

    </div>
<?php endif; ?>