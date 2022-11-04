<li class="nav-item">
    <router-link :to="{ name: 'measurement_units.index' }"
       class="nav-link {{ Request::is('measurementUnits*') ? 'active' : '' }}">
        <p>Unidades de Medida</p>
    </a>
</li>


<li class="nav-item">
    <router-link :to="{ name: 'ingredients.index' }"
       class="nav-link {{ Request::is('ingredients*') ? 'active' : '' }}">
        <p>Ingredientes</p>
    </router-link>
</li>


<li class="nav-item">
    <router-link :to="{ name: 'recipes.index' }"
       class="nav-link {{ Request::is('recipes*') ? 'active' : '' }}">
        <p>Receitas</p>
    </router-link>
</li>


<li class="nav-item">
    <a href="{{-- {{ route('customers.index') }} --}}"
       class="nav-link {{ Request::is('customers*') ? 'active' : '' }}">
        <p>Clientes</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('incomes.index') }}"
       class="nav-link {{ Request::is('incomes*') ? 'active' : '' }}">
        <p>Vendas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('losses.index') }}"
       class="nav-link {{ Request::is('losses*') ? 'active' : '' }}">
        <p>Perdas</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('productions.index') }}"
       class="nav-link {{ Request::is('productions*') ? 'active' : '' }}">
        <p>Produção</p>
    </a>
</li>


