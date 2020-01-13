<?php declare(strict_types=1);

namespace Microparts\PaginateFormatter\Adapters;

use Envms\FluentPDO\Queries\Select;
use Pagerfanta\Adapter\AdapterInterface;

class FluentPdoAdapter implements AdapterInterface
{
    /**
     * @var \Envms\FluentPDO\Queries\Select
     */
    private $select;

    /**
     * FluentPdoAdapter constructor.
     *
     * @param \Envms\FluentPDO\Queries\Select $select
     */
    public function __construct(Select $select)
    {
        $this->select = $select;
    }

    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     * @throws \Envms\FluentPDO\Exception
     */
    public function getNbResults()
    {
        return $this->select->count();
    }

    /**
     * Returns an slice of the results.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     * @return array|\Traversable The slice.
     * @throws \Envms\FluentPDO\Exception
     */
    public function getSlice($offset, $length)
    {
        return $this->select
            ->limit($length)
            ->offset($offset)
            ->fetchAll();
    }
}
