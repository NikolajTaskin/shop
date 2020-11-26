<?php



/**
 * Class FileDB
 */
class FileDB
{
    private string $file_name;
    private array $data;

    /**
     * FileDB constructor.
     *
     * @param $file_name
     */
    public function __construct($file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     * Set $data variable
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data ?? [];
    }

    /**
     * Get $data variable
     *
     * @param array $data_array
     */
    public function setData(array $data_array): void
    {
        $this->data = $data_array;
    }

    /**
     * Save JSON representation of an array to database file
     *
     * @return bool
     */
    public function save(): bool
    {
        $data = json_encode($this->getData());
        $bytes_written = file_put_contents($this->file_name, $data);

        return $bytes_written !== false;
    }

    /**
     * Get data from database file and decode to array
     *
     * @return bool
     */
    public function load(): bool
    {
        if (file_exists($this->file_name)) {
            $data = file_get_contents($this->file_name);

            if ($data !== false) {
                $this->setData(json_decode($data, true) ?? []);
            } else {
                $this->setData([]);
            }

            return true;
        }

        return false;
    }

//    /**
//     * Create a new array with $table_name inside of $data
//     *
//     * @param string $table_name
//     * @return bool
//     */
//    public function createTable(string $table_name): bool
//    {
//        if (!isset($this->data[$table_name])) {
//            $this->data[$table_name] = [];
//            return true;
//        }
//
//        return false;
//
//    }

    /**
     * Function creates new array in $this->data array with particular index.
     * @param $table_name - array index.
     * @return bool
     */
    public function createTable(string $table_name): bool
    {
        if (!$this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }
        return false;
    }

    /**
     * Function checks if table with given name exists.
     *
     * @param $table_name
     * @return bool
     */
    public function tableExists($table_name): bool
    {
        return isset($this->data[$table_name]);
    }

    /**
     * Delete array with index from data.
     *
     * @param string $table_name
     * @return bool
     */
    public function dropTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            unset($this->data[$table_name]);

            return true;
        }

        return false;
    }


    /**
     * Deletes table content leaving the index
     *
     * @param string $table_name
     * @return bool
     */
    public function truncateTable(string $table_name): bool
    {
        if ($this->tableExists($table_name)) {
            $this->data[$table_name] = [];
            return true;
        }
        return false;
    }


//    /**
//     * Function adds rows
//     *
//     * @param $table_name
//     * @param $row
//     * @param null $row_id
//     * @return bool|int|string|null
//     */
//    public function insertRow(string $table_name, array $row, $row_id = null)
//    {
//        if (!isset($this->data[$table_name][$row_id])) {
//            if ($row_id == null) {
//                $this->data[$table_name][] = $row;
//                $row_id = array_key_last($this->data[$table_name]);
//            } else {
//                $this->data[$table_name][$row_id] = $row;
//            }
//            return $row_id;
//        }
//        return false;
//    }

    /**
     * Insert row(array) into created table
     *
     * @param string $table_name
     * @param array $row
     * @param string|null $row_id
     * @return false|int|string|null
     */
    public function insertRow(string $table_name, array $row, $row_id = null)
    {
        if (!$this->rowExists($table_name, $row_id)) {
            if ($row_id === null) {
                $this->data[$table_name][] = $row;
                $row_id = array_key_last($this->data[$table_name]);
            } else {
                $this->data[$table_name][$row_id] = $row;
            }

            return $row_id;
        }

        return false;
    }

    /**
     * Checks if row already exists in table.
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id): bool
    {
        return array_key_exists($row_id, $this->data[$table_name]);
    }


    /**
     * Update $table[$row_id] content
     *
     * @param string $table_name
     * @param $row_id
     * @param $row
     * @return bool
     */
    public function updateRow(string $table_name, $row_id, array $row): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            $this->data[$table_name][$row_id] = $row;

            return true;
        }

        return false;
    }

    /**
     * Deletes row from the designated table
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
            unset($this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     * Return from $table row, which ID is [$row_id]
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];

        }

        return false;
    }



    /**
     * Suranda eilutes iš table pagal tai, kokie $conditions nurodyti stulpeliams
     *
     * @param string $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere(string $table_name, array $conditions = []): array
    {
        $results = [];

        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }

            if ($found) {
                $results[$row_id] = $row;
            }
        }

        return $results;
    }

    /**
     * Gražina vienos eilutės array pagal tai, kokie $conditions nurodyti
     *
     * @param string $table_name
     * @param array $conditions
     * @return false|array
     */
    public function getRowWhere(string $table_name, array $conditions)
    {
        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;
            foreach ($conditions as $condition_id => $condition_value) {
                var_dump($row);
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                return $row;
            }
        }
        return false;
    }
}
