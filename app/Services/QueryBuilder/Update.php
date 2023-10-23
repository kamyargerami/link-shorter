<?php

namespace App\Services\QueryBuilder;

class Update implements QueryInterface
{
    private string $table;

    private array $conditions = [];

    private array $columns = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function __toString(): string
    {
        $columns = array_map(function ($item) {
            return '`' . $item . '`';
        }, $this->columns);

        $conditions = array_map(function ($item) {
            return '`' . $item . '`';
        }, $this->conditions);

        return 'UPDATE ' . $this->table
            . ' SET ' . implode(', ', $columns)
            . ($this->conditions === [] ? '' : ' WHERE ' . implode(' AND ', $conditions));
    }

    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->conditions[] = $arg;
        }
        return $this;
    }

    public function set(string ...$columns): self
    {
        foreach ($columns as $column) {
            $this->columns[] = "$column = :$column";
        }
        return $this;
    }
}
