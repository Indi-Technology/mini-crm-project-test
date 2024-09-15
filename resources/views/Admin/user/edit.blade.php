@extends('admin.layouts.main')

@section('content-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="{{ route('RegistUser.index') }}" class="text-muted fw-light">Data Users</a>
            </li>
            <li class="breadcrumb-item active">Edit User</li>
        </ol>
    </nav>
    <div class="card mb-4">
        <div class="card-header align-items-center">
            <h3 class="mb-2">Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('RegistUser.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="name">Name</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Insert Name" />
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="email">Email</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Insert Email" />
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="password">Password</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="Leave blank to keep current password" />
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        <small class="form-text text-muted">Leave blank to keep the current password.</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="role">Role</label>
                    <div class="col-sm-5">
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                            <option value="">Select Role</option>
                            <option value="agent" {{ old('role', $user->role) == "agent" ? 'selected' : '' }}>Agent</option>
                            <option value="regular" {{ old('role', $user->role) == "regular" ? 'selected' : '' }}>Regular</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-end mt-4">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary px-3">Update</button>
                        <a href="{{ route('RegistUser.index') }}" class="btn btn-sm btn-secondary px-3">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection