<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use PDF;

class MemberExportController extends Controller
{
    // Export to Excel
    public function exportExcel(Request $request)
    {
        $filter = $request->filter; // e.g., ministry, homecell, age_group
        $value = $request->value;   // e.g., ministry_id, homecell_id, or '18-25'

        return Excel::download(new MembersExport($filter, $value), 'members.xlsx');
    }

    // Export to PDF
    public function exportPDF(Request $request)
    {
        $filter = $request->filter;
        $value = $request->value;

        $members = $this->getFilteredMembers($filter, $value);

        $pdf = PDF::loadView('exports.members_pdf', compact('members'));
        return $pdf->download('members.pdf');
    }

    // Helper to reuse filter logic
    private function getFilteredMembers($filter, $value)
    {
        $query = Member::with(['ministry', 'homecell']);

        if ($filter && $value) {
            if ($filter === 'ministry') {
                $query->where('ministry_id', $value);
            } elseif ($filter === 'homecell') {
                $query->where('homecell_id', $value);
            } elseif ($filter === 'age_group') {
                [$min, $max] = explode('-', $value);
                $query->whereBetween('age', [(int) $min, (int) $max]);
            }
        }

        return $query->get();
    }
}
