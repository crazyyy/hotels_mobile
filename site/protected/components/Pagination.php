<?php


class Pagination extends CWidget
{
    /**
     * @var CPagination
     */
    public $pagination;

    public function run()
    {
        $this->render('pagination');
    }


} 