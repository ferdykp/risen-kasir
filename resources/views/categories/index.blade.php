@extends('layouts.master')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 ">
                    <div class="card-header">

                    </div>
                    <div
                        class="card-header pb-0 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <div class="d-flex flex-column flex-sm-row">
                                <button type="button" class="btn btn-md btn-success me-2 mb-2 mb-sm-0" data-bs-toggle="modal"
                                    data-bs-target="#machineModal">
                                    Tambah Mesin
                                </button>
                                {{-- <a href="{{ route('machine.export') }}" class="btn btn-md btn-warning me-2 mb-2 mb-sm-0">
                                    <i class="fa fa-download"></i> Export Data in Excel
                                </a> --}}
                                <button class="btn btn-danger me-2 mb-2 mb-sm-0 d-none" id="delete_selected">Delete
                                    Selected</button>
                            </div>
                        </div>
                    </div>

                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="w-100 w-md-auto mb-2 mb-md-0">
                            <h6 class="mb-0">Data Mesin</h6>
                        </div>
                        <div class="w-100 w-md-25">
                            {{-- <input type="text" id="search" data-route="https://dbridgeconnect.com/machine/search"
                                name="search" placeholder="Search WR Code" autocomplete="off" class="form-control"> --}}
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive p-0 rounded-lg">
                            <table id="datatable" class="table align-items-center mb-0" data-type="wr">
                                <thead class="table-light">
                                    <tr>
                                        <th class="whitespace-nowrap text-center" width="10px"><input type="checkbox"
                                                name="select_all" id="select_all_id"></th>
                                        <th class="whitespace-nowrap text-center" width="10px">No</th>
                                        <th class="whitespace-nowrap text-center">Mesin</th>
                                        <th class="whitespace-nowrap text-center" width="125px">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @include('categories.table', [
                                        'data' => $categories,
                                        'routePrefix' => 'categories',
                                    ])
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of
                            {{ $categories->total() }} entries
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="machineModal" tabindex="-1" aria-labelledby="machineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="machineForm" method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="machineModalLabel">Add Menu Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row items-center">
                            <div class="col-md-4 text-right">
                                <label for="name" class=" col-form-label">Menu Category</label>
                            </div>

                            <div class="col-md-7">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('customScript')
    <script>
        function editModal(response) {
            $('#machineForm').attr('action', '{{ url('machine') }}/update/' + response.id);
            $('#machine_name').val(response.machine_name);
            $('#machineModalLabel').text('Edit Machine');
            $('#machineModal').modal('show');
        }
    </script>
@endpush
