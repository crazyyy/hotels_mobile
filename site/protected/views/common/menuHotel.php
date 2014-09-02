<!-- ready -->
<? $currentAction = Yii::app()->controller->action->id ?>
<table class="menu_hotel">
    <tbody>
        <tr>
            <td class='<? if ($currentAction == 'rooms') echo "active" ?>'>
                <a href="/hotels/rooms/?id=<?= $hotel['hotel_id'] ?>">Номера</a>
            </td>

            <td class='<? if ($currentAction == 'info') echo "active" ?>'>
                <a href="/hotels/info/?id=<?= $hotel['hotel_id'] ?>">Инфо</a>
            </td>

            <? if ($hotel['commentsCount']) : ?>
                <td class='<? if ($currentAction == 'reviews') echo "active" ?>'>
                    <a href="/hotels/reviews/?id=<?= $hotel['hotel_id'] ?>">Отзывы (<?= $hotel['commentsCount'] ?>)</a>
                </td>
            <? endif ?>

            <? if ($hotel['longitude'] && $hotel['latitude']) : ?>
                <td class='<? if ($currentAction == 'map') echo "active" ?>'>
                    <a href="/hotels/map/?id=<?= $hotel['hotel_id'] ?>">Карта</a>
                </td>
            <? endif; ?>
        </tr>
    </tbody>
</table><!-- menu_hotel -->