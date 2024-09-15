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
                                            <span>Created By</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->creator->name ?? 'Unknown' }}</span>
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
                                <div class="list-group-item list-group-item-action mb-1">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <span>Assigned Agent</span>
                                        </div>
                                        <div class="col-lg-8">
                                            <span>: {{ $dt->assignedAgent->name ?? 'Unassigned' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
