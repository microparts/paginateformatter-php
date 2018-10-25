<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 23/10/2018
 */

namespace Roquie\PaginateFormatter;


/**
 * Class PaginateFormatter
 *
 * @package Roquie\PaginateFormatter
 */
interface PaginateFormatterInterface
{
    /**
     * Return formatted page options.
     *
     * @return array
     */
    public function getPageOptions();

    /**
     * Return formatted output.
     *
     * @return array
     */
    public function format();
}
