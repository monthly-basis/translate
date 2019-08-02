<?php
namespace LeoGalleguillos\Translate\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class Task
{
    /**
     * @var Adapter
     */
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function insert(
        string $en,
        string $es,
        string $fr
    ): int {
        $sql = '
            INSERT
              INTO `translate` (
                   `en`, `es`, `fr`
                   )
            VALUES (?, ?, ?)
                 ;
        ';
        $parameters = [
            $en,
            $es,
            $fr,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectCount(): int
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `translate`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function select(): Generator
    {
        $sql = '
            SELECT `translate_id`
                 , `en`
                 , `es`
                 , `fr`
              FROM `translate`
             ORDER
                BY `translate_id` ASC
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $row) {
            yield($row);
        }
    }
}
