<!-- ready -->
<?php $currentAction = Yii::app()->controller->action->id ?>
<table class="menu_hotel">
    <tbody>
    <tr>
        <td class='<?php if ($currentAction == 'rooms') {
            echo "active"; } ?>'>
            <a href="/hotels/rooms/?id=<?= $hotel['hotel_id'] ?>">Номера</a>
        </td>

        <td class='<?php if ($currentAction == 'info') {
            echo "active"; } ?>'>
            <a href="/hotels/info/?id=<?= $hotel['hotel_id'] ?>">Инфо</a>
        </td>

        <?php if ($hotel['commentsCount']) : ?>
            <td class='<?php if ($currentAction == 'reviews') {
                echo "active"; } ?>'>
                <a href="/hotels/reviews/?id=<?= $hotel['hotel_id'] ?>">Отзывы (<?= $hotel['commentsCount'] ?>)</a>
            </td>
        <?php endif ?>

        <?php if ($hotel['longitude'] && $hotel['latitude']) : ?>
            <td class='<?php if ($currentAction == 'map') {
                echo "active"; } ?>'>
                <a href="/hotels/map/?id=<?= $hotel['hotel_id'] ?>">Карта</a>
            </td>
        <?php endif; ?>
    </tr>
    </tbody>
</table><!-- menu_hotel -->