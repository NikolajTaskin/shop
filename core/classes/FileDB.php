<?php

namespace Core;

/**
 *
 * Class FileDB
 *
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

    /**
     * Create new array with index $table_name in $data
     *
     * @param $table_name
     * @return boolean
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
     * Check there is index "$table_name" in $data
     *
     * @param string $table_name
     * @return bool
     */
    public function tableExists(string $table_name): bool
    {
        return isset($this->data[$table_name]);

    }

    /**
     * Delete array with index from $data
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
     * Make empty array by given index
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

    /**
     * If $row_id is given insert data with $row_id index if not create auto index
     *
     * @param string $table_name
     * @param array $row
     * @param null $row_id
     * @return bool|int|string|null
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
     * Check there is $row_id or not
     *
     * @param string $table_name
     * @param null $row_id
     * @return bool
     */
    public function rowExists(string $table_name, $row_id)
    {
        return isset($this->data[$table_name][$row_id]);
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
     * Delete $row_id
     *
     * @param string $table_name
     * @param $row_id
     * @return bool
     */
    public function deleteRow(string $table_name, $row_id): bool
    {
        if ($this->rowExists($table_name, $row_id)) {
           unset( $this->data[$table_name][$row_id]);

            return true;
        }

        return false;
    }

    /**
     *  if $row_id exists return $row by $row_id
     *
     * @param $table_name
     * @param $row_id
     * @return bool|array
     */
    public function getRowById(string $table_name, $row_id)
    {
        if ($this->rowExists($table_name, $row_id)) {
            return $this->data[$table_name][$row_id];
        }

        return false;
    }

    /**
     * creating new array if conditions are correct
     *
     * @param $table_name
     * @param array $conditions
     * @return array
     */
    public function getRowsWhere($table_name, array $conditions = []):array
    {
        $result = [];

        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {
                if ($row[$condition_id] !== $condition_value) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                $result[$row_id] = $row;
            }
        }

        return $result;
    }

    /**
     * Return only one $row with given $conditions
     *
     * @param $table_name
     * @param array $conditions
     * @return bool|array
     */
    public function getRowWhere($table_name, array $conditions = [])
    {

        foreach ($this->data[$table_name] as $row_id => $row) {
            $found = true;

            foreach ($conditions as $condition_id => $condition_value) {


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