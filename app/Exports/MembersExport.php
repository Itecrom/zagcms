<?php

namespace App\Exports;

use App\Models\Member;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Return a collection of filtered members.
     */
    public function collection()
    {
        $query = Member::with(['homecell', 'ministry']);

        // Apply filters
        if (!empty($this->filters['homecell_id'])) {
            $query->where('homecell_id', $this->filters['homecell_id']);
        }
        if (!empty($this->filters['ministry_id'])) {
            $query->where('ministry_id', $this->filters['ministry_id']);
        }
        if (!empty($this->filters['status'])) {
            switch ($this->filters['status']) {
                case 'active': $query->where('active', true); break;
                case 'transferred': $query->where('transferred', true); break;
                case 'deceased': $query->where('deceased', true); break;
            }
        }

        $members = $query->latest()->get();

        // Map data for Excel
        return $members->map(function ($member) {
            return [
                'Name'              => $member->name,
                'Surname'           => $member->surname,
                'Date of Birth'     => $member->dob->format('Y-m-d'),
                'Phone'             => $member->phone,
                'Home of Origin'    => $member->home_of_origin,
                'Residential Home'  => $member->residential_home,
                'Homecell'          => $member->homecell->name ?? '',
                'Ministry'          => $member->ministry->name ?? '',
                'Marital Status'    => $member->marital_status,
                'Employment Status' => $member->employment_status,
                'Status'            => $member->active ? 'Active' : ($member->transferred ? 'Transferred' : 'Deceased'),
            ];
        });
    }

    /**
     * Excel headings
     */
    public function headings(): array
    {
        return [
            'Name',
            'Surname',
            'Date of Birth',
            'Phone',
            'Home of Origin',
            'Residential Home',
            'Homecell',
            'Ministry',
            'Marital Status',
            'Employment Status',
            'Status',
        ];
    }
}
