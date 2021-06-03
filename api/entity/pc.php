<?php
class PC{
    private $conn;

    public function __construct($db)
    {
        $this->conn= $db;
    }

    /** Метод предназначен для валидации входных параметров
     * @param array $params Принимает массив с параметрами
     * @return array Возвращает валидный массив для передаци в метод чтения
     */
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

    /**
     * Метод предназначен для чтения данных из БД по критериям, переданныи в параметрах
     * @param array $criteria Принимает массив критериев для выборки и БД
     * @return mixed Возвращает результат запроса в БД
     */
    public function read(array $criteria){

        if(!empty($criteria)) $conditions  = $this->rangeConditions($this->validationParams($criteria));

        $query = "SELECT * FROM `pc` WHERE ". $conditions['where'] . " LIMIT 16";

        $stmt =$this->conn->prepare($query);
        $stmt->execute($conditions['parameters']);

        return $stmt;
    }

    /**
     * Метод предназначен для формирования условия WHERE, для оператора SELECT, в зависимости от колличесва переданных критериев
     * @param array $criteria Принимает массив с критериями
     * @return array Возвращает массив со строкой запроса и параметрамси для этого запроса
     */
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