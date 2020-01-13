<?php declare(strict_types=1);

namespace Microparts\PaginateFormatter\Adapters;

use PDO;

class PaginatePdoAdapter extends BasePdoAdapter
{
    /**
     * Returns an slice of the results.
     *
     * @param integer $offset The offset.
     * @param integer $length The length.
     * @return array|\Traversable The slice.
     */
    public function getSlice($offset, $length)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} OFFSET ? LIMIT ?");
        $stmt->execute([$offset, $length]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
