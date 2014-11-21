<!-- ready -->
<div class="form_wrapper bgc_orange">
    <form id="" action="/search" method="get">
        <ul>
            <li>
                <label for="scity">Найти город или отель:</label>
                <input typte="text" id="scity" name="s" placeholder="" value="<?php if ($s) {
                    echo $s; } ?>" autocomplete="off" spellcheck="false" required="required">
            </li>
        </ul>
    </form>
</div><!-- form_wrapper -->
<div class="main_wrapper">
    <div class="search_wrapper">
        <?php if ($data && isset($data['result'][1])): ?>
            <?php $count = 0; ?>
            <?php $count += count($data['result'][1]['cities']) ?>
            <?php $count += count($data['result'][1]['regions']) ?>
            <?php $count += count($data['result'][1]['hotels']) ?>
        <?php endif ?>
        <?php if (isset($error)) { ?>
        <?= $error . "<br><br>" ?>
        <?php } ?>
        <?php if (!$data || !isset($data['result'][1]) || !$count) { ?>
            Нет результатов.
        <?php } else { ?>
            <?php foreach ($data['result'][1] as $key => $rArray) { ?>
                <?= SearchResultView::render($key, $rArray, $parameters) ?>
            <?php } ?>
        <?php } ?>
    </div>
    <!-- search_wrapper -->
</div><!-- main_wrapper -->