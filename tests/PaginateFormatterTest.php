<?php

use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Roquie\PaginateFormatter\PaginateFormatter;

/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 23/10/2018
 */


class PaginateFormatterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \TypeError
     * @expectedExceptionMessage must be an instance of Pagerfanta\Pagerfanta
     */
    public function testConstructorMustBeToAcceptPagerfantaInstance()
    {
        new PaginateFormatter(new stdClass());
    }

    public function testFormatPaginationWithPagerfanta()
    {
        $items = [
            [1, 2, 3],
            [1, 2, 3],
            [1, 2, 3],
            [1, 2, 3],
        ];

        $formatter = new PaginateFormatter(new Pagerfanta(new ArrayAdapter($items)));

        $results = [
            'data' => $items,
            'meta' => [
                'pagination' => [
                    'total'        => count($items),
                    'per_page'     => 10,
                    'current_page' => 1,
                    'total_pages'  => 1,
                    'prev_page'    => null,
                    'next_page'    => null,
                ]
            ]
        ];

        $this->assertEquals($results, $formatter->format());
    }
}
