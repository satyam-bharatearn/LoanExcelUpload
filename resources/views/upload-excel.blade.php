@extends('layout')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Upload Excel</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Upload</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary mb-3 justify-content-end" data-toggle="modal"
                data-target="#uploadModal">
                Upload Excel
            </button>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('import_errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach(session('import_errors') as $failure)
                        <li>
                            Row {{ $failure->row() }}:
                            @foreach($failure->errors() as $msg)
                                {{ $msg }}
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="excelForm" action="{{ route('loan.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="lender" class="form-label fw-bold">Select Lender</label>
                            <select name="lender_id" id="lender" class="form-control" required>
                                <option value="" disabled selected>Select a lender</option>
                                @foreach($lenders as $lender)
                                    <option value="{{ $lender->id }}">{{ $lender->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label fw-bold">Choose Excel File</label>
                            <input type="file" name="file" id="file" accept=".xlsx,.xls" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Import
                            </button>
                            <a href="{{ route('loan.template') }}" class="btn btn-outline-primary">
                                <i class="fas fa-download"></i> Download Template
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive p-2" style="overflow-x: auto;">
        <div class="mb-2" style="position: relative;">
            <button id="colVisBtn" class="btn btn-secondary btn-sm">
                <i class="fas fa-columns"></i> Column Visibility
            </button>
            <div id="colVisDropdown" class="dropdown-menu p-3" style="position: absolute; min-width: 100%; display: none;">
                <div class="col-12" style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="0" checked> ID</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="1" checked> Month</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="2" checked> App ID</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="3" checked> Name</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="4" checked> Bank</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="5"> PL/BL</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="6"> Location</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="7"> Company Name</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="8"> Sanction
                        Amount</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="9"> Date</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="10"> Partner</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="11"> Remarks</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="12"> Payout
                        Percent</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="13"> Sub</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="14"> Bank Amount</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="15"> Ex Amount</label>
                    <label class="d-block"><input type="checkbox" class="toggle-vis" data-column="16"> Created At</label>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover" id="loans-table" style="width:100%;">
            <thead class="thead-primary">
                <tr>
                    <th>ID</th>
                    <th>Month</th>
                    <th>App ID</th>
                    <th>Name</th>
                    <th>Bank</th>
                    <th>PL/BL</th>
                    <th>Location</th>
                    <th>Company Name</th>
                    <th>Sanction Amount</th>
                    <th>Date</th>
                    <th>Partner</th>
                    <th>Remarks</th>
                    <th>Payout Percent</th>
                    <th>Sub</th>
                    <th>Bank Amount</th>
                    <th>Ex Amount</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#loans-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('loan.upload') }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'month', name: 'month' },
                    { data: 'app_id', name: 'app_id' },
                    { data: 'name', name: 'name' },
                    { data: 'bank', name: 'bank' },
                    { data: 'pl_bl', name: 'pl_bl' },
                    { data: 'location', name: 'location' },
                    { data: 'company_name', name: 'company_name' },
                    { data: 'sanction_amount', name: 'sanction_amount' },
                    { data: 'date', name: 'date' },
                    { data: 'partner', name: 'partner' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'payout_percent', name: 'payout_percent' },
                    { data: 'sub', name: 'sub' },
                    { data: 'bank_amount', name: 'bank_amount' },
                    { data: 'ex_amount', name: 'ex_amount' },
                    { data: 'created_at', name: 'created_at' }
                ],
                "columnDefs": [
                    { "visible": true, "targets": [0, 1, 2, 3, 4] },
                    { "visible": false, "targets": [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16] }
                ],
                scrollX: true
            });
            $('#colVisBtn').on('click', function (e) {
                e.stopPropagation();
                $('#colVisDropdown').toggle();
            });
            $('#colVisDropdown input.toggle-vis').on('change', function (e) {
                var column = table.column($(this).attr('data-column'));
                column.visible(this.checked);
            });
            $(document).on('click', function (e) {
                if (!$(e.target).closest('#colVisBtn').length && !$(e.target).closest('#colVisDropdown').length) {
                    $('#colVisDropdown').hide();
                }
            });
        });
    </script>
@endpush