<?php

namespace Config;

class DBConfig{

    private $DBPath;
    private $TableName;

    public function __construct(string $DBName ,string $TableName){

        $this->DBPath       = Config::getRootPath() . DS . $DBName . DS;
        $this->TableName    = $TableName;

        $DBCheck        = is_dir($this->DBPath);
        $tableCheck     = file_exists($this->getTablePath());
        $procedureCheck = file_exists($this->getProcedurePath());

        if(!$DBCheck){
            $this->dbCreate();
        }
        if(!$tableCheck){
            $this->tableCreate($TableName);
        }
        if(!$procedureCheck){
            $this->procedureCreate($TableName);
        }

    }

    /**
     * Returns the full path of the database
     */
    public function getDBPath() : string {
        return $this->DBPath;
    }

    /**
     * Returns the full path of the table in database
     */
    public function getTablePath() : string {
        return $this->DBPath . $this->TableName . '.json';
    }

    /**
     * Returns the full path of the procedure table in database
     */
    public function getProcedurePath() : string {
        return $this->DBPath . $this->TableName . '_procedure.json';
    }

    /**
     * Creates a new database and returns its status
     */
    private function dbCreate() : bool {
        return mkdir($this->DBPath);
    }

    /**
     * Creates a new table in database.
     */
    private function tableCreate(string $tableName): bool {
        return file_put_contents($this->DBPath . $tableName . '.json', json_encode([]));
    }

    /**
     * Creates a new procedure to save last record index.
     */
    private function procedureCreate(string $tableName) : bool {
        return file_put_contents($this->DBPath . $tableName . '_procedure.json', json_encode(['LastID'=>'1']));
    }


}
