@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end px-2">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <a href="{{ route('tickets.index') }}" class="text-muted fw-light">Tickets</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        <div class="card mb-4">
            <div class="card-header align-items-center">
                <h3 class="mb-2">Edit Ticket</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.update', $ticket->id_tickets) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="title">Title</label>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" class="form-control @error('title') border-danger @enderror"
                                    id="title" name="title" value="{{ old('title', $ticket->title) }}" placeholder="Enter Title" />
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
                                <textarea type="text" name="message" id="message" class="form-control"> {{ old('message', $ticket->message) }} </textarea>
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
                            <select class="form-select @error('id_label') border-danger @enderror" id="label_name" name="id_label" aria-label="Select Label">
                                <option disabled selected>Select Label</option>
                                @foreach ($labels as $lbl)
                                    <option value="{{ $lbl->id_label }}" {{ old('id_label', $ticket->id_label ?? '') == $lbl->id_label ? 'selected' : '' }}>
                                        {{ $lbl->label_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_label')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="categories">Categories</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('id_categories') border-danger @enderror" id="categories_name" name="id_categories" aria-label="Select Categories">
                                <option disabled selected>Select Categories</option>
                                @foreach ($categories as $ctg)
                                    <option value="{{ $ctg->id_categories }}" {{ old('id_categories', $ticket->id_categories ?? '') == $ctg->id_categories ? 'selected' : '' }}>
                                        {{ $ctg->categories_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_categories')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="priorities">Priorities</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('id_priorities') border-danger @enderror" id="categories_name" name="id_priorities" aria-label="Select Categories">
                                <option disabled selected>Select Priorities</option>
                                @foreach ($priorities as $prt)
                                    <option value="{{ $prt->id_priorities }}" {{ old('id_priorities', $ticket->id_priorities ?? '') == $prt->id_priorities ? 'selected' : '' }}>
                                        {{ $prt->priorities_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_priorities')
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
                                <option value="0" hidden disabled>Select Status</option>
                                <option value="open" {{ (old('status', $ticket->status) == 'open') ? 'selected' : '' }}>Open</option>
                                <option value="close" {{ (old('status', $ticket->status) == 'close') ? 'selected' : '' }}>Close</option>
                            </select>
                            
                            @error('status')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="assign_user">Assigned Agent</label>
                        <div class="col-sm-5">
                            <select class="form-select @error('assign_user') border-danger @enderror" id="assign_user" name="assign_user" aria-label="Select User">
                                <option disabled selected>Select Agent</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('assign_user', $ticket->assign_user ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->role }})  <!-- Hanya agent yang muncul -->
                                    </option>
                                @endforeach
                            </select>
                            @error('assign_user')
                                <div class="form-text text-danger">
                                    *{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>   
                    
                                        
                    <!-- Attachment Field -->
                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="bukti">attachment </label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="file" id="attachment" class="form-control @error('attachment') border-danger @enderror"
                                    name="attachment" accept="image/*"
                                    onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            @error('attachment')
                            <div class="form-text text-danger">
                                *{{ $message }}
                            </div>
                            @enderror
                            <div class="img-output mt-3 d-flex justify-content-center">
                                <img src="{{ asset('images/' . $ticket->attachment) }}" id="output" width="280">
                            </div>
                        </div>
                    </div>                 
                    
                    <div class="row justify-content-end mt-4">
                        <div class="col-sm-12">
                            <a href="/admin/tickets">
                                <button type="button" class="btn btn-sm btn-secondary px-3">Back</button>
                            </a>
                            <button type="submit" class="btn btn-sm btn-primary px-3">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('foto').addEventListener('change', function() {
            document.getElementById('output').src = window.URL.createObjectURL(this.files[0]);
        });
    </script>
@endsection
