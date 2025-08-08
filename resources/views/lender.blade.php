@extends('layout')
@push('styles')
    <style>
        .column-mapping {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .lenderSel {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .column-box {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            background-color: white;
        }

        .position-select {
            min-width: 60px;
        }

        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endpush
@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">Lender Data Entry System</h1>
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3>1. Lender Information</h3>
            </div>
            <div class="card-body">
                <form id="lenderForm">
                    <div class="row">
                        <div class="col-12 d-flex" style="align-items: self-end;">
                            <div class="col-md-6 mb-2">
                                <label for="lenderName">Lender Name</label>
                                <input type="text" class="form-control" id="lenderName" required>
                            </div>
                            <div class="col-md-6 mb-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Save Lender</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3>2. Column Position Mapping</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    Map each column to its corresponding position in the Excel file (A, B, C, etc.)
                </div>
                <div class="col-12 lenderSel">
                    <label for="lenderSelect">Select Lender</label>
                    <Select class="form-control mb-3" id="lenderSelect">
                        <option value="">Select Lender</option>
                        @foreach ($lenders as $item)
                            <option value="{{ $item->id }}">{{$item->name}}</option>
                        @endforeach
                    </Select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="column-mapping">
                            <h5>Available Columns</h5>
                            <div id="columnList">
                                <div class="column-box" data-column="MONTH">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>MONTH</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="MONTH"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="APP ID">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>APP ID</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="APP ID"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="NAME">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>NAME</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="NAME"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="BANK">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>BANK</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="BANK"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="PL/BL">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>PL/BL</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="PL/BL"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="location">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>location</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="location"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="COMPANY NAME">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>COMPANY NAME</span>
                                        <input type="text" class="form-control position-input m-2 w-50"
                                            data-for="COMPANY NAME" maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="SANCTION AMOUNT">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>SANCTION AMOUNT</span>
                                        <input type="text" class="form-control position-input m-2 w-50"
                                            data-for="SANCTION AMOUNT" maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="DATES">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>DATES</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="DATES"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="PATNER">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>PATNER</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="PATNER"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="Remarks">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Remarks</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="Remarks"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="Payout">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Payout</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="Payout"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="Sub">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Sub</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="Sub"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="Bank Amount">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Bank Amount</span>
                                        <input type="text" class="form-control position-input m-2 w-50"
                                            data-for="Bank Amount" maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                                <div class="column-box" data-column="Ex Amount">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>Ex Amount</span>
                                        <input type="text" class="form-control position-input m-2 w-50" data-for="Ex Amount"
                                            maxlength="2" placeholder="Column Name (A/AA)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="column-mapping">
                            <h5>Column Position Mapping</h5>
                            <div class="table-container">
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Column Name</th>
                                            <th>Excel Position</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mappingTable">
                                    </tbody>
                                </table>
                            </div>
                            <button id="saveMapping" class="btn btn-primary mt-3">Save Mapping</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function isValidExcelColumn(input) {
            if (!input) return false;
            input = input.toUpperCase();
            if (input.length > 2 || input.length < 1) return false;
            for (let i = 0; i < input.length; i++) {
                const charCode = input.charCodeAt(i);
                if (charCode < 65 || charCode > 90) {
                    return false;
                }
            }
            return true;
        }
        $(document).ready(function () {
            $(document).on('input', '.position-input', function () {
                this.value = this.value.toUpperCase();
                this.value = this.value.replace(/[^A-Za-z]/g, '');
                if (this.value.length > 2) {
                    this.value = this.value.substring(0, 2);
                }
            });
            const positions = [];
            for (let i = 0; i < 26; i++) {
                positions.push(String.fromCharCode(65 + i));
            }
            $(document).on('blur', '.position-input', function () {
                const column = $(this).data('for');
                let position = $(this).val().toUpperCase();
                if (position && !isValidExcelColumn(position)) {
                    alert('Please enter a valid Excel column (A-Z or AA-ZZ)');
                    $(this).val('').focus();
                    return;
                }
                $(`#mappingTable tr[data-column="${column}"]`).remove();
                $(`#mappingTable tr[data-position="${position}"]`).remove();
                if (position) {
                    $('#mappingTable').append(`
                                    <tr data-column="${column}" data-position="${position}">
                                        <td>${column}</td>
                                        <td>${position}</td>
                                    </tr>
                                `);
                }
            });
        });
        $('#lenderForm').submit(function (e) {
            e.preventDefault();
            const lenderData = {
                name: $('#lenderName').val(),
                code: $('#lenderCode').val(),
                description: $('#lenderDescription').val()
            };
            $.ajax({
                url: "{{ route('lenders.store') }}",
                method: 'POST',
                data: lenderData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    alert(response.message);
                    $('#lenderSelect').append(
                        $('<option>', {
                            value: response.lender.id,
                            text: response.lender.name,
                            selected: true
                        })
                    );
                },
                error: function (xhr) {
                    alert('Error saving lender: ' + xhr.responseJSON.message);
                }
            });
        });
        $('#saveMapping').click(function () {
            const lenderId = $('#lenderSelect').val();
            if (!lenderId) {
                alert('Please save lender information first');
                return;
            }
            const mappings = [];
            let hasErrors = false;
            $('.position-input').each(function () {
                const position = $(this).val();
                if (position && !isValidExcelColumn(position)) {
                    alert(`Invalid Excel column position: ${position}`);
                    $(this).focus();
                    hasErrors = true;
                    return false;
                }
            });
            if (hasErrors) return;
            $('#mappingTable tr').each(function () {
                const column = $(this).data('column');
                const position = $(this).data('position');
                mappings.push({ column_name: column, excel_position: position });
            });

            if (mappings.length === 0) {
                alert('Please map at least one column');
                return;
            }

            const mappingData = {
                lender_id: lenderId,
                mappings: mappings
            };
            $.ajax({
                url: "{{ route('mappings.store') }}",
                method: 'POST',
                data: mappingData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    alert(response.message);
                },
                error: function (xhr) {
                    alert('Error saving mappings: ' + xhr.responseJSON.message);
                }
            });
        });
    </script>
@endpush