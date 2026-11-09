@props(['user'])

<div class="d-flex">
    <button type="button" class="edit btn btn-sm btn-primary me-2" data-toggle="modal" data-id="{{ $user->id }}" data-target="#edit">
        <i class="fa fa-edit"></i>
    </button>
    <form action="{{ route('admin.pengguna.paket', ['id'=>$user->id]) }}" method="POST" class="me-1" onsubmit="return confirm('Apakah anda yakin akan mengubah paket akun ini?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Ubah Paket">
            <i class="fas fa-gift"></i>
        </button>
    </form>
    <form action="{{ route('admin.pengguna.password', ['id'=>$user->id]) }}" method="POST" class="me-1" onsubmit="return confirm('Apakah anda yakin akan mereset password akun ini?')">
        @csrf
        <button type="submit" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="top" title="Reset Password">
            <i class="fas fa-key"></i>
        </button>
    </form>
    <form action="{{ route('admin.pengguna.destroy', ['id'=>$user->id]) }}" method="POST" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
    </form>
</div>
