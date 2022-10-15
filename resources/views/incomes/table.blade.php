<div class="table-responsive">
    <table class="table" id="incomes-table">
        <thead>
        <tr>
            <th>Recipe Id</th>
        <th>Customer Id</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Cost</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($incomes as $income)
            <tr>
                <td>{{ $income->recipe_id }}</td>
            <td>{{ $income->customer_id }}</td>
            <td>{{ $income->qty }}</td>
            <td>{{ $income->price }}</td>
            <td>{{ $income->cost }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['incomes.destroy', $income->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('incomes.show', [$income->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('incomes.edit', [$income->id]) }}"
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
