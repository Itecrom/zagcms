<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MembersExport;
use PDF;

class MemberExportController extends Controller
{
    /**
     * Export members to Excel.
     */
    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter'); // ministry, homecell, age_group
        $value  = $request->input('value');  // corresponding value

        // Use MembersExport class to handle filtered data
        return Excel::download(new MembersExport($filter, $value), 'members.xlsx');
    }

    /**
     * Export members to PDF.
     */
    public function exportPDF(Request $request)
    {
        $filter = $request->input('filter');
        $value  = $request->input('value');

        $members = $this->getFilteredMembers($filter, $value);

        $pdf = PDF::loadView('exports.members_pdf', compact('members'));
        return $pdf->download('members.pdf');
    }

    /**
     * Helper method to apply filter logic.
     */
    private function getFilteredMembers($filter, $value)
    {
        $query = Member::with(['ministry', 'homecell']);

        if ($filter && $value) {
            switch ($filter) {
                case 'ministry':
                    $query->where('ministry_id', $value);
                    break;
                case 'homecell':
                    $query->where('homecell_id', $value);
                    break;
                case 'age_group':
                    if (strpos($value, '-') !== false) {
                        [$min, $max] = explode('-', $value);
                        $query->whereBetween('age', [(int) $min, (int) $max]);
                    }
                    break;
            }
        }

        return $query->get();
    }
}
