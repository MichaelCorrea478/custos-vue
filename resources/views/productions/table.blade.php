<div class="table-responsive">
    <table class="table" id="productions-table">
        <thead>
        <tr>
            <th>Recipe Id</th>
        <th>Qty</th>
        <th>Cost</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productions as $production)
            <tr>
                <td>{{ $production->recipe_id }}</td>
            <td>{{ $production->qty }}</td>
            <td>{{ $production->cost }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['productions.destroy', $production->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('productions.show', [$production->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('productions.edit', [$production->id]) }}"
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
