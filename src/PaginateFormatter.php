<?php
/**
 * Created by Roquie.
 * E-mail: roquie0@gmail.com
 * GitHub: Roquie
 * Date: 23/10/2018
 */

namespace Microparts\PaginateFormatter;

use Pagerfanta\Pagerfanta;

/**
 * Class PaginateFormatter
 *
 * @package Roquie\PaginateFormatter
 */
class PaginateFormatter implements PaginateFormatterInterface
{
    /**
     * @var \Pagerfanta\Pagerfanta
     */
    private $pagerfanta;

    /**
     * @var ?array
     */
    private $items = null;

    /**
     * PaginateFormatter constructor.
     *
     * @param \Pagerfanta\Pagerfanta $pagerfanta
     */
    public function __construct(Pagerfanta $pagerfanta)
    {
        $this->pagerfanta = $pagerfanta;
    }

    /**
     * Overwrite items from pagerfanta.
     *
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Return formatted page options.
     *
     * @return array
     */
    public function getPageOptions()
    {
        $prevPage = null;
        if ($this->pagerfanta->hasPreviousPage()) {
            $prevPage = $this->pagerfanta->getPreviousPage();
        }

        $nextPage = null;
        if ($this->pagerfanta->hasNextPage()) {
            $nextPage = $this->pagerfanta->getNextPage();
        }

        return [
            'total'        => $this->pagerfanta->count(),
            'per_page'     => $this->pagerfanta->getMaxPerPage(),
            'current_page' => $this->pagerfanta->getCurrentPage(),
            'total_pages'  => $this->pagerfanta->getNbPages(),
            'prev_page'    => $prevPage,
            'next_page'    => $nextPage,
        ];
    }

    /**
     * Return formatted output.
     *
     * @return array
     */
    public function format()
    {
        $collection = $this->pagerfanta->getCurrentPageResults();
        if (method_exists($collection, 'toArray')) {
            $collection = $collection->toArray();
        }

        return [
            'data' => $this->items ?? $collection ?? [],
            'meta' => [
                'pagination' => $this->getPageOptions()
            ]
        ];
    }
}
