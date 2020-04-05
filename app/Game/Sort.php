<?php

namespace App\Game;

class Sort
{
    /** @var string[] */
    private $sort;

    /** @var array */
    private $sortableColumns;

    /**
     * Sort constructor.
     *
     * @param string $sort
     * @param string $default
     * @param array $sortableColumns
     */
    public function __construct(string $sort, string $default, array $sortableColumns)
    {
        $this->sort = $this->prepare($sort, $default);

        $this->sortableColumns = $sortableColumns;
    }

    /**
     * Prepare sort by setting an array containing the column and order.
     *
     * @param string $sort
     * @param string $default
     * @return void
     */
    protected function prepare(string $sort, string $default)
    {
        $sort = explode(':', $sort);

        if (count($sort) !== 2) {
            $sort = explode(':', $default);
        }

        return $sort;
    }

    /**
     * Return column.
     *
     * @return string
     */
    public function getColumn()
    {
        $column = $this->sort[0];
        $column = $this->sortableColumns[$column] ?? 'id';

        return $column;
    }

    /**
     * Return order.
     *
     * @return string
     */
    public function getOrder()
    {
        return strtolower($this->sort[1]) === 'desc' ? 'desc' : 'asc';
    }
}