<?php

namespace Tests\Unit\Game\Steam;

use PHPUnit\Framework\TestCase;
use App\Game\Sort;

class SortTest extends TestCase
{
    public function testDefaultIsReturned()
    {
        $request = '';
        $default = 'id:asc';
        $sortableColumns = [
            'column' => 'column'
        ];

        $sort = new Sort($request, $default, $sortableColumns);

        $this->assertEquals('id', $sort->getColumn());
        $this->assertEquals('asc', $sort->getOrder());
    }

    public function testRequestedSortIsReturned()
    {
        $request = 'column:desc';
        $default = 'id:asc';
        $sortableColumns = [
            'column' => 'column'
        ];

        $sort = new Sort($request, $default, $sortableColumns);

        $this->assertEquals('column', $sort->getColumn());
        $this->assertEquals('desc', $sort->getOrder());
    }
}
