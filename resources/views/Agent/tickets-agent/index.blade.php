@extends('agent.layouts.main')

@section('content-agent')
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
                        <th>Created at</th>
                        <th>Updated at</th>
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
                            <td>{{ $dt->created_at }}</td>
                            <td>{{ $dt->updated_at }}</td>
                            <td>
                                <div class="d-flex">
                                    <!-- Edit Icon -->
                                    <a href="{{ route('agent.tickets.edit', $dt->id_tickets) }}" class="me-2" title="Edit">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
{{-- 
    @foreach ($data as $dt)
    @include('admin.member.detail')
    @endforeach --}}
    
@endsection