<?php

namespace Nicelizhi\Manage\DataGrids\Customers;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class GroupDataGrid extends DataGrid
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('customer_groups')->addSelect('id', 'code', 'name');

        return $queryBuilder;
    }

    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.customers.groups.index.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'code',
            'label'      => trans('admin::app.customers.groups.index.datagrid.code'),
            'type'       => 'string',
            'searchable' => false,
            'filterable' => true,
            'sortable'   => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.customers.groups.index.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'filterable' => true,
            'sortable'   => true,
        ]);
    }

    public function prepareActions()
    {
        if (bouncer_manage()->hasPermission('customers.groups.edit')) {
            $this->addAction([
                'icon'   => 'icon-edit',
                'title'  => trans('admin::app.customers.groups.index.datagrid.edit'),
                'method' => 'PUT',
                'url'    => function ($row) {
                    // return route('manage.groups.edit', $row->id);
                },
            ]);
        }

        if (bouncer_manage()->hasPermission('customers.groups.delete')) {
            $this->addAction([
                'icon'   => 'icon-delete',
                'title'  => trans('admin::app.customers.groups.index.datagrid.delete'),
                'method' => 'DELETE',
                'url'    => function ($row) {
                    return route('manage.customers.groups.delete', $row->id);
                },
            ]);
        }
    }
}
