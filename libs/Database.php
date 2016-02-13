<?php

class Database extends PDO
{

    public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        parent::__construct($DB_TYPE . ':host=' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);

        parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param $sql SQL string
     * @param array $array paramters to bind
     * @param int $fetchMode a PDO fetch mode
     * @return result
     *
     * делаем запрос с целью выполнения SQL запроса и возвращаем результат в виде assoc_array
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
    {
        $result = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $result->bindValue("$key", $value);
        }
        $result->execute();
        return $result->fetchAll($fetchMode);
    }

    /**
     * @param $table table name to insert into
     * @param $data associative array
     *
     * добавляем в таблицу значения через асоц. массив
     */
    public function insert($table, $data)
    {
        ksort($data);
        $fieldNames = implode(',', array_keys($data));
        $fieldValues = implode("','", array_values($data));

        $result = $this->prepare("INSERT INTO $table
                                  ($fieldNames)
                                  VALUES ('$fieldValues')");
        $result->execute();
    }

    /**
     * @param $table table name to update
     * @param $data associative array
     * @param $where WHERE query part
     *
     * обновляем таблицу
     */
    public function update($table, $data, $where)
    {
        ksort($data);

        $fieldDetails = null;
        foreach ($data as $key => $value) {
            $fieldDetails .= "$key='$value',";
        }
        $fieldDetails = rtrim($fieldDetails, ',');


        $result = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        $result->execute();
    }

    /**
     * @param $table table name to delete
     * @param $where query part
     * @param int $limit limit
     * @return int result
     *
     * удаляем из таблицы значение по SQL запросу и возвращаем число
     */
    public function delete($table, $where, $limit = 1)
    {
        return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

}