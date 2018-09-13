<?php

class Model
{
    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USER_NAME, PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // выбрасывает исключения
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // вызывает стандартный варнинг, удобен при отладке
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); // режим по умолчанию для вывода всех ошибок
            $this->pdo->exec("set names utf8"); // utf8
        } catch (PDOException $e) {
            $info = $e->getMessage();
            $message = "StartError:$info/EndError Ошибка в базе данных";
            Router::error($message);
            error_log($e, 3, 'logs/error.log');
            exit();
        }
    }

    protected function pdoDelete($table, $name, $value)
    {
        $result = $this->pdo->prepare("DELETE FROM $table WHERE $name = :val");
        $result->bindValue(':val', $value);
        $result->execute();
    }

    protected function pdoUpdate($table, $array, $where)
    {
        $fieldDetails = null;
        foreach ($array as $key => $value) {
            $fieldDetails .= "$key='$value',";
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $result = $this->pdo->prepare("UPDATE $table SET $fieldDetails WHERE $where");
        $result->execute();
    }

    protected function pdoInsert($table, $array, $lastId = false)
    {
        $fieldNames = implode(',', array_keys($array));
        $fieldValues = implode(',', array_values($array));

        $result = $this->pdo->prepare("INSERT INTO $table
                                  ($fieldNames)
                                  VALUES ('$fieldValues')");
        $result->execute();
        $result = ($lastId != true) ? null : $this->pdo->lastInsertId();
        return $result;
    }

    protected function pdoSelect($sql, $array = array(), $fetch_mode = PDO::FETCH_ASSOC)
    {
        $result = $this->pdo->prepare($sql);
        foreach ($array as $key => $value) {
            $result->bindValue("$key", $value);
        }
        $result->execute();
        return $result->fetchAll($fetch_mode);
    }

    protected function pdoCount($table, $extraTables = null)
    {
        $result = $this->pdo->query("SELECT COUNT(*) FROM $table")->fetch(PDO::FETCH_ASSOC);
        $tableExtra = array();
        if (is_array($extraTables)) {
            $tableExtra[$table] = $result;
            foreach ($extraTables as $item) {
                $tableExtra[$item] = $this->pdo->query("SELECT COUNT(*) FROM $item")->fetch(PDO::FETCH_ASSOC);
            }
            return $tableExtra;
        }
        return $result;
    }
}