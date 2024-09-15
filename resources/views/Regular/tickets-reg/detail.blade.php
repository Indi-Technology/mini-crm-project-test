@php
  \Carbon\Carbon::setLocale('id_tickets'); 
@endphp

@foreach ($data as $dt)
    <div class="modal fade" id="viewdetail-{{ $dt->id_tickets }}" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Ticket Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <img src="{{ asset('images/' . $dt->attachment) }}" alt="Attachment for {{ $dt->title }}" style="max-width: 300px; max-height: 300px;">
                    </div>
                    <div class="row">
                        <div class="demo-inline-spacing">
                            <div class="list-group list-group-flush">
                                <!-- Detail Tiket -->
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Title</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->title }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Message</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->message }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Label</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->labels->label_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Category</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->categories->categories_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Priority</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->priorities->priorities_name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Status</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->status }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Created At</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ \Carbon\Carbon::parse($dt->created_at)->translatedFormat('l, d F Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Updated At</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ \Carbon\Carbon::parse($dt->updated_at)->translatedFormat('l, d F Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body">
                            </div>
                        </div>
                    </div>

                    <!-- Formulir Komentar -->
                    <div class="mt-4">
                        <h6>Add Comment</h6>
                        <form action="{{ route('regular.comment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="ticket_id" value="{{ $dt->id_tickets }}">
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="comment" rows="3" placeholder="Write your comment here..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Comment</button>
                        </form>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
