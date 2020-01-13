<?php declare(strict_types=1);

namespace Microparts\PaginateFormatter\Adapters;

use Amp\Postgres\Pool;
use Amp\Postgres\ResultSet;
use Pagerfanta\Adapter\AdapterInterface;
use function Amp\Promise\wait;

class SqlAmphpAdapter implements AdapterInterface
{
    /**
     * @var \Amp\Postgres\Pool
     */
    private $pool;

    /**
     * @var string
     */
    private $table;

    /**
     * SqlAmphpAdapter constructor.
     *
     * @param \Amp\Postgres\Pool $pool
     * @param string $table
     */
    public function __construct(Pool $pool, string $table)
    {
        $this->pool  = $pool;
        $this->table = $table;
    }

    /**
     * @return int
     * @throws \Amp\Sql\ConnectionException
     * @throws \Amp\Sql\FailureException
     * @throws \Throwable
     */
    public function getNbResults(): int
    {
        /** @var ResultSet $result */
        $result = wait($this->pool->query("SELECT count(1) FROM {$this->table}"));

        if (wait($result->advance())) {
            return $result->getCurrent()['count'];
        }

        return 0;
    }

    /**
     * @param int $offset
     * @param int $length
     * @return array|\Traversable
     * @throws \Amp\Sql\ConnectionException
     * @throws \Amp\Sql\FailureException
     * @throws \Throwable
     */
    public function getSlice($offset, $length): array
    {
        /** @var \Amp\Sql\Statement $stmt */
        $stmt = wait($this->pool->prepare("SELECT * FROM {$this->table} OFFSET ? LIMIT ?"));

        /** @var ResultSet $result */
        $result = wait($stmt->execute([$offset, $length]));

        $items = [];
        while (wait($result->advance())) {
            $items[] = $result->getCurrent();
        }

        return $items;
    }
}
