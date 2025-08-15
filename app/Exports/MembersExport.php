<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    protected $filter;
    protected $value;

    public function __construct($filter = null, $value = null)
    {
        $this->filter = $filter;
        $this->value = $value;
    }

    public function collection()
    {
        $query = Member::with(['ministry', 'homecell']);

        if ($this->filter && $this->value) {
            if ($this->filter === 'ministry') {
                $query->where('ministry_id', $this->value);
            } elseif ($this->filter === 'homecell') {
                $query->where('homecell_id', $this->value);
            } elseif ($this->filter === 'age_group') {
                [$min, $max] = explode('-', $this->value);
                $query->whereBetween('age', [(int) $min, (int) $max]);
            }
        }

        return $query->get()->map(function ($member) {
            return [
                'Name'     => $member->name,
                'Email'    => $member->email,
                'Phone'    => $member->phone,
                'Ministry' => $member->ministry->name ?? 'N/A',
                'Homecell' => $member->homecell->name ?? 'N/A',
                'Age'      => $member->age,
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Ministry', 'Homecell', 'Age'];
    }
}
