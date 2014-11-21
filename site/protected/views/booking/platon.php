<?php
/*
 * This file is part of the Hotels24.ua project.
 *
 * (c) Hotels24.ua 2007-2014
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @var string $submit_url
 * @var string $key
 * @var string $payment
 * @var string $payment
 * @var string $order
 * @var array $data
 * @var string $ext1
 * @var string $ext2
 * @vat string $url
 * @var string $error_url
 * @var string $sign
 */
?>

<div class="main_wrapper">
    <div class="bron_form">
        <form name="platonform" target="platonFrame" action="<?= $submit_url ?>" method="post">
            <input type="hidden" name="formid" value ="iframe">
            <input type="hidden" name="key" value="<?= $key?>">
            <input type="hidden" name="payment" value="<?= $payment ?>">
            <input type="hidden" name="order" value="<?= $order?>">
            <input type="hidden" name="data"
                   value="<?= $data ?>">
            <input type="hidden" name="ext1" value="<?= $ext1?>">
            <input type="hidden" name="ext2" value="<?= $ext2?>">
            <input type="hidden" name="url"
                   value="<?= $url ?>">
            <input type="hidden" name="error_url"
                   value="<?= $error_url ?>">
            <input type="hidden" name="sign" value="<?= $sign?>">
        </form>
        <iframe name="platonFrame" width="100%" height="340px"></iframe>
        <script type="text/javascript">
            document.platonform.submit();
        </script>
    </div>
</div>