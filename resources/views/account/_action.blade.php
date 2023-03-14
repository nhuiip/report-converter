<div class="btn-group">
    {{-- <button type="button" class="btn btn-dark btn-sm">Action</button> --}}
    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"
        aria-expanded="false">
        <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('accounts.edit', $id) }}"><i class="fa fa-pencil"></i>&nbsp; Edit</a>
        </li>
        <li><a class="dropdown-item" href="{{ route('accounts.resetpassword', $id) }}"><i
                    class="fa fa-refresh"></i>&nbsp; Reset password</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm" data-id="{{ $id }}" onclick="fncPushUserId(this)"><i
                    class="fa fa-users"></i>&nbsp; Assign Team</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item text-danger" href="javascript:;" data-text="Delete!"
                data-form="delete-form-{{ $id }}" onclick="fncDelete(this)"><i class="fa fa-remove"></i>&nbsp;
                Delete</a></li>
    </ul>
</div>
<form id="delete-form-{{ $id }}" method="post" action="{{ route('accounts.destroy', $id) }}">
    @csrf
    @method('DELETE')
</form>
