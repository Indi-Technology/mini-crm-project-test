@extends('admin.layouts.main')

@section('content-admin')
    <div class="container-xxl flex-grow-1 container-p-y">
        <nav aria-label="breadcrumb" class="d-flex justify-content-end">
            <ol class="breadcrumb breadcrumb-style1">
                <li class="breadcrumb-item">
                    <span class="text-muted fw-light">Member</span>
                </li>
                <li class="breadcrumb-item active">Daftar</li>
            </ol>
        </nav>
        <div class="card p-4">
            <h5 class="card-header p-0 mb-4">TICKET LOG</h5>

            <table id="example" class="table table-hover py-3" style="width: 100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Attachment</th>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Label</th>
                        <th>Categories</th>
                        <th>Priority</th>
                        <th>Status</th>
                        {{-- <th>Created at</th>
                        <th>Updated at</th>
                        <th>Agent</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $dt)
                        <tr>
                            <td>{{ $loop->iteration }}. </td>
                            <td>
                                <img src="{{ asset('images/'.$dt->attachment) }}" alt="attachment" width="45">
                            </td>
                            <td>{{ $dt->title }}</td>
                            <td>{{ $dt->message }}</td>
                            <td>{{ $dt->labels->label_name }}</td>
                            <td>{{ $dt->categories->categories_name }}</td>
                            <td>{{ $dt->priorities->priorities_name }}</td>
                            <td>{{ $dt->status }}</td>
                            {{-- <td>{{ $dt->created_at }}</td>
                            <td>{{ $dt->updated_at }}</td>
                            <td>{{ $dt->assigned_user}}</td> --}}
                            <td>
                                    <div class="d-flex">
                                        <!-- View Detail Icon -->
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#viewdetail-{{ $dt->id_tickets }}" class="me-2" title="View Details">
                                            <i class="bx bx-error-circle"></i>
                                        </a>
                                        
                                        <!-- Edit Icon -->
                                        <a href="{{ route('tickets.edit', $dt->id_tickets) }}" class="me-2" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        
                                        <!-- Delete Icon -->
                                        <form action="{{ route('tickets.destroy', $dt->id_tickets) }}" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link p-0" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
    @foreach ($data as $dt)
    @include('admin.tickets.detail')
    @endforeach
    
@endsection