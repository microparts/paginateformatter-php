<?php declare(strict_types=1);

namespace Microparts\PaginateFormatter\Adapters;

use Pagerfanta\Adapter\AdapterInterface;
use PDO;

abstract class BasePdoAdapter implements AdapterInterface
{
    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * @var string
     */
    protected $table;

    /**
     * PaginatePdoAdapter constructor.
     *
     * @param \PDO $pdo
     * @param string $table
     */
    public function __construct(PDO $pdo, string $table)
    {
        $this->pdo    = $pdo;
        $this->table  = $table;
    }

    /**
     * Returns the number of results.
     *
     * @return integer The number of results.
     */
    public function getNbResults()
    {
        $stmt = $this->pdo->prepare("SELECT count(1) FROM {$this->table}");
        $stmt->execute();
        $result = $stmt->fetch();

        return $result['count'] ?? 0;
    }
}
