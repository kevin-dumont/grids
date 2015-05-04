# Grids

Grdis is a datagrid widget for laravel 5. It easily generate datatables from your entities.
The generated HTML use Twitter Bootstrap, but you can override templates.

## Comming soon

- A demo with more examples
- CSV/Exel export
- Possibility to extend the plugin, and add custom fields
- Styling fields
- And more...

## Install

First, add this in your **composer.json**

```
  "require": {
    "sygmaa/grids": "dev-master"
  }
```

Then, add a new Service provider in your **config/app.php** :

`'Sygmaa\Grids\GridsServiceProvider',`

And for the Facade :

`'Grids' => 'Sygmaa\Grids\GridsFacade',`

After, if you want override views or languages, you can run this command :

`php artisan vendor:publish`

## Simple example

In your controller :

```
$grid = Grids::make(new Model())
    ->paginate(15) // Pagination
    ->reset() // Show a reset button to clear filters
    ->addField(Grids::field('id', 'ID') // Add a new field (name, Label)
        ->setPrimary() // Define the primary key
        ->setVisible(false) // The field will be hidden
    )
    ->addField(Grids::field('name', 'Name')
        ->setSortable() // An order by on this field will be available
        ->setFilterable() // We can search keywords in an input
    )
    ->addAction(Grids::massAction("Delete", URL::route('model.delete'))) // Add a mass action to delete entries
    ->addAction(Grids::action("Edit", function($label, $row){
        $url = URL::route('model.edit', ['id' => $row->id]);
        return '<a class="btn btn-primary" href="'. $url .'">'. $label .'</a>';
    })); // Add 
```

And the template :

```
<div class="panel-body">
    {!! $grid->renderFilters() !!}
</div>
<div class="panel-body pn">
    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        {!! $grid->renderTable() !!}

        <div class="dt-panelfooter clearfix">
            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                {{ $grid->renderPaginationInfos() }}
            </div>
            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                {!! $grid->renderPagination() !!}
            </div>
        </div>
    </div>
</div>
```

## License


Grids in under a [MIT License](http://opensource.org/licenses/MIT).
