<div class="table-responsive">
    <table class="table" id="ingredients-table">
        <thead>
        <tr>
            <th>User Id</th>
        <th>Description</th>
        <th>Qty</th>
        <th>Measurement Unit Id</th>
        <th>Price</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ingredients as $ingredient)
            <tr>
                <td>{{ $ingredient->user_id }}</td>
            <td>{{ $ingredient->description }}</td>
            <td>{{ $ingredient->qty }}</td>
            <td>{{ $ingredient->measurement_unit_id }}</td>
            <td>{{ $ingredient->price }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['ingredients.destroy', $ingredient->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ingredients.show', [$ingredient->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('ingredients.edit', [$ingredient->id]) }}"
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
