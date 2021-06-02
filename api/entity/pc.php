<?php
class PC{
    private $conn;

    public function __construct($db)
    {
        $this->conn= $db;
    }
    private function validationParams(array $params):array
    {
        extract($params);

        $param = [
            'speed' => $speed,
            'hdd' => $hdd,
            'ram' => $ram,
            'price' => $price
        ];

        $result = [];

        foreach ($param as $column => $values) {
            if ($values && is_array($values) && count($values) <= 2) {
                foreach ($values as $position => $value) {
                    if (is_numeric($value)) {
                        if($position == "to") {
                            $result[$column]  = [1, $value];
                        }elseif($position == 'from')
                            $result[$column] [0] = $value;
                    }
                }
            }
        }

        return $result;
    }

    public function read(array $criteria){

        if(!empty($criteria)) $conditions  = $this->rangeConditions($this->validationParams($criteria));

        $query = "SELECT * FROM `pc` WHERE ". $conditions['where'] . " LIMIT 16";

        $stmt =$this->conn->prepare($query);
        $stmt->execute($conditions['parameters']);

        return $stmt;
    }

    private function rangeConditions(array $criteria): array
    {
        $parameters = [];
        $where      = [];

        foreach ($criteria as $column => $values) {
            foreach ($values as $position => $value) {
                if(isset($position)) {
                    $where[] = sprintf('`%s` %s ?', $column, $position  ? '<=' : '>=');
                    $parameters[] = $value;
                }
            }
        }
        return [
            'where'      => implode(' and ', $where),
            'parameters' => $parameters
        ];
    }
}