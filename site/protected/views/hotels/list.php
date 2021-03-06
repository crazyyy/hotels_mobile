<!-- ready -->
<?
/* @var $this HotelsController */
?>
<div class="main_wrapper hotels_list">
    <?php if (isset($label) && isset($data) && isset($data['data']) && isset($dataPagination)) { ?>
        <div class="city_wrapper clearfix">
            <a href="/?s=<?= $label ?>" class="date">Изменить даты</a>

            <h2><?= $label ?></h2>
            <span class="numb"><?= count($data['data']) ?> отелей</span>
            <?php $this->renderPartial('../common/fromTo', array()) ?>
        </div><!-- city_wrapper -->
        <div class="hotel_list">
            <?php foreach ($dataPagination as $key => $oneHotel): ?>
                <?
                OneHotelView::render($oneHotel);
                ?>
            <?php endforeach ?>
        </div>
        <table class="paginator">
            <tr>
                <td>
                    <?php if ($page > 0) { ?>
                        <a href="<?= 'http://' . ViewHelper::getPaginationUrl() . '&' . 'page=' . ($page - 1); ?>">
                            Предыдущая
                        </a>
                    <?php } ?>
                </td>
                <td>
                    <?php $maxLimit = ceil(count($data['data']) / $limit) - 1;
                    if ($page < $maxLimit) {
                        ?>
                        <a href="<?= 'http://' . ViewHelper::getPaginationUrl() . '&' . 'page=' . ($page + 1); ?>">
                            Следующая
                        </a>
                    <?php } ?>
                </td>
            </tr>
        </table><!-- paginator -->
        <div class="pagilist">
            <p>Страница: <?= $page + 1 ?> из <?php echo ceil(count($data['data']) / $limit) ?></p>
        </div>

    <?php } else { ?>
        <div class="no_result">
            <p>Нет результатов</p>
        </div>
    <?php } ?>
</div><!-- main_wrapper -->