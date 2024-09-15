@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <span class="text-muted fw-light">Tambah</span>
                </li>
                <li class="breadcrumb-item active">Data Priorities</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header align-items-center">
                <h3 class="mb-2">Priorities</h3>
            </div>
            <div class="card-body">
                <form action="{{ Route('priorities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="label_name">Priorities Name</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control @error('priorities_name') border-danger @enderror"
                                    id="priorities_name" name="priorities_name" value="{{ old('priorities_name') }}" placeholder="Insert Label Name" />
                            </div>
                            @error('priorities_name')
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
    </div>

<!--view--> 
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card p-4">
            <h3 class="card-header p-0 mb-4">Categories Data</h3>

            <table id="example" class="table table-striped py-3" style="width: 100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Categories Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->index + 1 }}. </td>
                            <td>{{ $dt->priorities_name }}</td>
                            <td>
                                <!-- Edit Icon -->
                                <a href="{{ route('priorities.edit', $dt->id_priorities) }}" class="text-primary me-2">
                                    <i class="bx bx-edit-alt" style="font-size: 1.2rem;"></i> <!-- Edit Icon -->
                                </a>
                            
                                <!-- Delete Icon -->
                                <form action="{{ route('priorities.destroy', $dt->id_priorities) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure you want to delete this label?');">
                                        <i class="bx bx-trash" style="font-size: 1.2rem;"></i> <!-- Delete Icon -->
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection