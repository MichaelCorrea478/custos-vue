<li class="nav-item">
    <a href="{{-- {{ route('measurementUnits.index') }} --}}"
       class="nav-link {{ Request::is('measurementUnits*') ? 'active' : '' }}">
        <p>Measurement Units</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{-- {{ route('ingredients.index') }} --}}"
       class="nav-link {{ Request::is('ingredients*') ? 'active' : '' }}">
        <p>Ingredients</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{-- {{ route('recipes.index') }} --}}"
       class="nav-link {{ Request::is('recipes*') ? 'active' : '' }}">
        <p>Recipes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{-- {{ route('customers.index') }} --}}"
       class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">
        <p>Customers</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('incomes.index') }}"
       class="nav-link {{ Request::is('incomes*') ? 'active' : '' }}">
        <p>Incomes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('losses.index') }}"
       class="nav-link {{ Request::is('losses*') ? 'active' : '' }}">
        <p>Losses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('productions.index') }}"
       class="nav-link {{ Request::is('productions*') ? 'active' : '' }}">
        <p>Productions</p>
    </a>
</li>


