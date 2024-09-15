@extends('admin.layouts.main')

@section('content-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
        <ol class="breadcrumb breadcrumb-style1">
            <li class="breadcrumb-item">
                <a href="{{ route('categories.index') }}" class="text-muted fw-light">categories</a>
            </li>
            <li class="breadcrumb-item active">Edit Label</li>
        </ol>
    </nav>
    <div class="card mb-4">
        <div class="card-header align-items-center">
            <h3 class="mb-2">Edit Label</h3>
        </div>
        <div class="card-body">
            <!-- Form to update label -->
            <form action="{{ route('categories.update', $categories->id_categories) }}" method="POST">
                @csrf
                @method('PUT') <!-- Specify that this is a PUT request -->

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="label_name">Categories Name</label>
                    <div class="col-sm-5">
                        <div class="input-group">
                            <!-- Prefill the input with the current label name -->
                            <input type="text" class="form-control @error('categories_name') border-danger @enderror"
                                id="categories_name" name="categories_name" value="{{ old('categories_name', $categories->categories_name) }}"
                                placeholder="Insert Label Name" />
                        </div>
                        @error('categories_name')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row justify-content-end mt-4">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-sm btn-primary px-3">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection