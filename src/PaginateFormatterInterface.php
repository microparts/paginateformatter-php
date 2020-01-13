<?php declare(strict_types=1);

namespace Microparts\PaginateFormatter;

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
