<div class="table-responsive">
    <table class="table" id="recipes-table">
        <thead>
        <tr>
            <th>User Id</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock Qty</th>
        <th>Cost</th>
        <th>Avg Cost</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recipes as $recipe)
            <tr>
                <td>{{ $recipe->user_id }}</td>
            <td>{{ $recipe->description }}</td>
            <td>{{ $recipe->price }}</td>
            <td>{{ $recipe->stock_qty }}</td>
            <td>{{ $recipe->cost }}</td>
            <td>{{ $recipe->avg_cost }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['recipes.destroy', $recipe->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('recipes.show', [$recipe->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('recipes.edit', [$recipe->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
