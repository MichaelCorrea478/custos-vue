<div class="table-responsive">
    <table class="table" id="losses-table">
        <thead>
        <tr>
            <th>Recipe Id</th>
        <th>Qty</th>
        <th>Cost</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($losses as $loss)
            <tr>
                <td>{{ $loss->recipe_id }}</td>
            <td>{{ $loss->qty }}</td>
            <td>{{ $loss->cost }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['losses.destroy', $loss->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('losses.show', [$loss->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('losses.edit', [$loss->id]) }}"
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
