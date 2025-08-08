<?php

namespace App\Http\Controllers;

use App\Imports\LoanImport;
use App\Models\ColumnMapping;
use App\Models\Lender;
use App\Models\Loan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UploadController extends Controller
{
    public function showUploadForm()
    {
        if (request()->ajax()) {
            $users = Loan::latest()->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('created_at', function ($user) {
                    return $user->created_at ?? '-';
                })
                ->rawColumns(['created_at'])
                ->make(true);
        }
        $lenders = Lender::all();
        return view('upload-excel', compact('lenders'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'lender_id' => 'required|exists:lenders,id'
        ]);
        $import = new LoanImport($request->lender_id);
        Excel::import($import, $request->file('file'));
        if (count($import->failures())) {
            return back()->with('import_errors', $import->failures());
        }
        return back()->with('success', 'Excel Imported');
    }
    public function index()
    {
        $lenders = Lender::all();
        return view('lender', compact('lenders'));
    }

    public function storeLender(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);
        $lender = Lender::create($validated);
        return response()->json([
            'success' => true,
            'message' => 'Lender saved successfully',
            'lender' => $lender
        ]);
    }

    public function storeMappings(Request $request)
    {
        $validated = $request->validate([
            'lender_id' => 'required|exists:lenders,id',
            'mappings' => 'required|array',
            'mappings.*.column_name' => 'required|string',
            'mappings.*.excel_position' => 'required|string|max:2',
        ]);
        ColumnMapping::where('lender_id', $validated['lender_id'])->delete();
        foreach ($validated['mappings'] as $mapping) {
            ColumnMapping::create([
                'lender_id' => $validated['lender_id'],
                'column_name' => $mapping['column_name'],
                'excel_position' => strtoupper($mapping['excel_position']),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Column mappings saved successfully'
        ]);
    }
}
