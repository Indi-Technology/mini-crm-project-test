@extends('regular.layouts.main')

@section('content-regular')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <span class="text-muted fw-light">Tickets</span>
                </li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header align-items-center">
                <h3 class="mb-2">Create Tickets</h3>
            </div>
            <div class="card-body">
                <form action="{{ Route('regular.tickets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="title">Title</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control @error('title') border-danger @enderror"
                                    id="title" name="title" value="{{ old('title') }}" placeholder="Masukkan Title" />
                            </div>
                            @error('title')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="message">message</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <textarea type="text" class="form-control @error('message') border-danger @enderror"
                                    id="message" name="message" value="{{ old('message') }}" placeholder="Enter message"> </textarea>
                            </div>
                            @error('message')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="label">Label</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('labels') border-danger @enderror" id="label_name"
                                    aria-label="Example select with button addon" name="id_label">
                                    <option selected>Select Label</option>
                                    @foreach ($labels as $lbl)
                                        <option value="{{ $lbl->id_label }}">{{ $lbl->label_name }}</option>
                                    @endforeach
                            </select>
                            @error('labels')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="categories">Categories</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('categories') border-danger @enderror" id="categories_name"
                                    aria-label="Example select with button addon" name="id_categories">
                                    <option selected>Select Categories</option>
                                    @foreach ($categories as $ctg)
                                        <option value="{{ $ctg->id_categories }}">{{ $ctg->categories_name }}</option>
                                    @endforeach
                            </select>
                            @error('categories')
                        <div class="form-text text-danger">
                            *{{ $message }}
                        </div>
                        @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="priority">Priority</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('priorities') border-danger @enderror" id="priorities_name"
                                    aria-label="Example select with button addon" name="id_priorities">
                                    <option selected>Select Priorities</option>
                                    @foreach ($priorities as $prt)
                                        <option value="{{ $prt->id_priorities }}">{{ $prt->priorities_name }}</option>
                                    @endforeach
                            </select>
                            
                            @error('priority')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="status">Status</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('status') border-danger @enderror" id="status" name="status">
                                <option value="0" hidden disabled selected>Silahkan pilih </option>
                                <option value="open" {{ old('status') == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="close" {{ old('status') == 'close' ? 'selected' : '' }}>Close</option>
                            </select>
                            
                            @error('status')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="attachment">Attachment</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="file" id="attachment"
                                    class="form-control @error('attachment') border-danger @enderror" name="attachment"
                                    value="{{ old('attachment') }}" accept="image/*"
                                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            @error('attachment')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                            <div class="img-output mt-3 d-flex justify-content-center">
                                <img src="" id="output" width="280">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-4">
                        <div class="col-sm-12">
                            <a href="/admin/tickets">
                                <button type="button" class="btn btn-sm btn-secondary px-3">Kembali
                                </button>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary px-3">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('attachment').addEventListener('change', function() {
            document.getElementById('hilang').style.display = 'none';
        });
    </script>
@endsection
