<button class="btn btn-dark btn-sm w-100" type="button" data-teamId="{{ $id }}" data-userId="{{ $userId }}"
    data-mappingId="{{ $mappingId }}" data-url="{{ route('teammapping.destroy', $mappingId) }}"
    onclick="@if ($assign) fncMapping(this) @else fncUnMapping(this) @endif">
    @if ($assign)
        Assign
    @else
        Unassign
    @endif
</button>
