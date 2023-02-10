<div class="btn-group">
    {{-- <button type="button" class="btn btn-dark btn-sm">Action</button> --}}
    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('teams.edit', $id) }}"><i class="fa fa-pencil"></i>&nbsp; Edit</a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item text-danger" href="javascript:;" data-text="Delete!" data-form="delete-form-{{ $id }}" onclick="fncDelete(this)"><i class="fa fa-remove"></i>&nbsp; Delete</a></li>
    </ul>
</div>
<form id="delete-form-{{ $id }}" method="post" action="{{ route('teams.destroy', $id) }}">
    @csrf
    @method('DELETE')
</form>
