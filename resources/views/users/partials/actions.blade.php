<div class="d-flex">
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary me-2">
        Edit
    </a>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            Delete
        </button>
    </form>
    <button class="btn btn-sm btn-secondary" data-toggle="modal" data-id="{{ $user->id }}" onclick="openChangePasswordModal({{ $user->id }})" data-target="#changePasswordModal">
        Change Password
    </button>
</div>