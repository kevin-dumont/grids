# Grids

Grids is a datagrid widget for laravel 5. It easily generate datatables from your entities.
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

Then, you must add these lines in your template :
```php
    {!! Grids::head() !!}
    {!! Grids::styles() !!}
    {!! Grids::scripts() !!}
```

## Simple example

In your controller :

```php
$grid = Grids::make(new Model())
    // Pagination; 15 is the number of results to show by page
    ->paginate(15) 
    // Show a reset button to clear filters (In the filter form)
    ->reset() 
    // You can add a condition...
    ->where('field', '<', 'content') 
    // ...Many conditions
    ->where('field', 'content') 
    // Where In SQL Statement is supported
    ->whereIn('field', ['content1', 'content2']) 
    // Order by SQL Statement is supported
    ->orderBy('field', 'ASC') 
    // Add a new field (name, Label)
    ->addField(Grids::text('id', 'ID')
        // Define the primary key (needed)
        ->setPrimary() 
        // The field will be hidden
        ->setVisible(false) 
    )
    // You can create a custom field with a callback
    ->addField(Grids::custom('custom', 'custom', function($row){ 
      // You can access to the data of the actual row
      return $row->name; 
    })
    ->addField(Grids::text('name', 'Name')
        // An order by on this field will be available
        ->setSortable()
        // We can search keywords in an input
        ->setFilterable()
    )
    // Eloquent OneToMany/OneToOne relation
    // entities.name -> "entities" is your association method in your model ( entities() )
    // "name" is th name of the field in the associated model
    ->addField(Grids::oneRelation('entities.name', 'Label of entity', 'App\Models\EntityName')
         // You can filter the relation field
        ->setFilterable() 
    )
    // Eloquent ManyToMany relation
    // entity.name -> "entity" is your association method in your model ( entity() ), like oneRelation 
    // "name" is th name of the field in the associated model, like oneRelation
    // The result is a list (separated by comas)
    ->addField(Grids::manyRelation('entity.name', 'Label of entity', 'App\Models\EntityName') 
        ->setFilterable()
    )
    // Date field
    ->addField(Grids::date('updated_at', 'Dernière modification', 'd/m/Y H:i:s')
        ->setSortable()
        ->setFilterable() // You will have a bootstrap calendar to select period
    )
    // Add a mass action (For example : to delete entries)
    ->addAction(Grids::massAction("Delete", URL::route('model.delete')))
    // Add a single action at the end of the row : you can for example return a button
    ->addAction(Grids::action("Edit", function($label, $row){
        $url = URL::route('model.edit', ['id' => $row->id]);
        return '<a class="btn btn-primary" href="'. $url .'">'. $label .'</a>';
    })); // Add 
```

And the template :

```php
<div class="panel-body">
    <!-- Show the filter form -->
    {!! $grid->renderFilters() !!}
</div>
<div class="panel-body pn">
    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
        <!-- Show the grid -->
        {!! $grid->renderTable() !!}

        <div class="dt-panelfooter clearfix">
            <div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
                <!-- Show informations about pagination -->
                {{ $grid->renderPaginationInfos() }}
            </div>
            <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                <!-- Show the pagination -->
                {!! $grid->renderPagination() !!}
            </div>
        </div>
    </div>
</div>
```

## License


Grids in under a [MIT License](http://opensource.org/licenses/MIT).
