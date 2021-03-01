<?php
namespace DB;

use Config\DBConfig;

class DB extends DBConfig {

    public function __construct(string $DBName ,string $TableName)
    {
        parent::__construct($DBName ,$TableName);
    }

    /**
     * @return object
     * Returns all rows information
     */
    public function getAllRows() : object {
        return (object)json_decode(file_get_contents($this->getTablePath()));
    }

    /**
     * @param int $id
     * @return object
     * Returns the selected row id information.
     */
    public function getRowById(int $id) : object {
        foreach ($this->getAllRows() as $key => $item) {
            if($item->id === $id){
                return $item;
            }
        }
        return (object)[];
    }

    /**
     * @param int $id
     * @return bool
     * Checks whether the selected row id is available or not.
     */
    public function isRowAvailable(int $id) : bool {
        foreach ($this->getAllRows() as $key => $item) {
            if($item->id === $id){
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the content of the procedure
     */
    private function getProcedureContent() : object {
        return (object)json_decode(file_get_contents($this->getProcedurePath()));
    }

    /**
     * Returns the last record index
     */
    public function getLastID() : int {
        return $this->getProcedureContent()->LastID;
    }

    /**
     * @param $id
     * @return bool
     * Sets the last record index
     */
    public function setLastID($id) : bool{
        return file_put_contents($this->getProcedurePath(), json_encode(['LastID'=>$id]));
    }

}
