@extends('admin.layouts.main')

@section('content-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <span class="text-muted fw-light">Tambah</span>
            </li>
            <li class="breadcrumb-item active">Data Users</li>
        </ol>
    </nav>
    <div class="card mb-4">
        <div class="card-header align-items-center">
            <h3 class="mb-2">User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('RegistUser.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="name">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('name') border-danger @enderror"
                                id="name" name="name" value="{{ old('name') }}" placeholder="Insert Name" />
                        @error('name')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control @error('email') border-danger @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Insert Email" />
                        @error('email')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('password') border-danger @enderror"
                                id="password" name="password" placeholder="Insert Password" />
                        @error('password')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="role">Role</label>
                    <div class="col-sm-5">
                        <select class="form-select @error('role') border-danger @enderror" id="role" name="role">
                            <option hidden disabled selected>Select Role</option>
                            <option value="Agent" {{ old('role') == "agent" ? 'selected' : '' }}>Agent</option>
                            <option value="Regular" {{ old('role') == "regular" ? 'selected' : '' }}>Regular</option>
                        </select>
                        @error('role')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-end mt-4">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary px-3">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--view--> 
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-4">
            <h3 class="card-header p-0 mb-4">User Data</h3>

            <table id="example" class="table table-striped py-3" style="width: 100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                    <tr>
                        <td>{{ $loop->index + 1 }}.</td>
                        <td>{{ $dt->name }}</td>
                        <td>{{ $dt->email }}</td>
                        <td>{{ $dt->role }}</td>
                        <td>
                            <!-- Edit Icon -->
                            <a href="{{ route('RegistUser.edit', $dt->id) }}" class="text-primary me-2">
                                <i class="bx bx-edit-alt" style="font-size: 1.2rem;"></i>
                            </a>
                            
                            <!-- Delete Icon -->
                            <form action="{{ route('RegistUser.destroy', $dt->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this user?');">
                                    <i class="bx bx-trash" style="font-size: 1.2rem;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
