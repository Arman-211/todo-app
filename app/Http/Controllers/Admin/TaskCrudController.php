<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TaskCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TaskCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Task::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/task');
        CRUD::setEntityNameStrings('task', 'tasks');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(): void
    {
        CRUD::column('title')->type('text')->label('Title');
        CRUD::column('description')->type('text')->label('Description')->limit(50);
        CRUD::column('status')->type('select_from_array')->label('Status')->options([
            'new' => 'New',
            'in_progress' => 'In Progress',
            'done' => 'Done'
        ])->wrapper([
            'class' => function ($crud, $column, $entry) {
                return $entry->status == 'done' ? 'text-success' : 'text-warning';
            }
        ]);
        CRUD::column('user_id')->type('select')->entity('user')->attribute('name')->label('User');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(TaskRequest::class);

        CRUD::field('title')->type('text')->label('Title')->attributes(['required' => 'required']);
        CRUD::field('description')->type('textarea')->label('Description');
        CRUD::field('status')->type('select_from_array')->options([
            'new' => 'New',
            'in_progress' => 'In Progress',
            'done' => 'Done'
        ])->label('Status')->default('new');

        if (backpack_user()->hasRole('admin')) {
            CRUD::field('user_id')->type('select')->entity('user')->attribute('name')->label('User');
        }
    }


    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
