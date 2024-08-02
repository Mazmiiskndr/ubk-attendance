<?php

namespace App\Exports;


use App\Services\User\UserService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class LectureExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $userService;
    protected $totalRowNumber;

    /**
     * ListOnlineUsersExport constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get all the active sessions.
     * @return mixed
     */
    public function collection()
    {
        // Retrieve the data from the hotel rooms service
        $data = $this->userService->getUsers('dosen');

        // Transform the data to match the headings
        $mappedData = $data->map(function ($row, $key) {
            return [
                'No' => $key + 1,
                'Username' => $row->username ?? '-',
                'Nama' => $row->name ?? '-',
                'NIM' => $row->userDetail->ident_number ?? '-',
                'Jenis Kelamin' => $row->userDetail->gender ?? '-',
                'No. HP' => $row->userDetail->phone_number ?? '-',
                'Email' => $row->email ?? '-',
                'Tanggal Lahir' => $row->userDetail->birthdate ?? '-',
                'Alamat' => $row->userDetail->address ?? '-',
                'Status' => $row->status == 1 ? "Aktif" : "Tidak Aktif",
            ];
        });


        $totalStudents = $mappedData->count();

        $mappedData->push([
            'No' => '',
            'Username' => '',
            'Nama' => '',
            'NIP' => '',
            'Jenis Kelamin' => '',
            'No. HP' => '',
            'Email' => '',
            'Tanggal Lahir' => '',
            'Alamat' => 'TOTAL',
            'Status' => $totalStudents
        ]);
        // Save the row number of the total
        $this->totalRowNumber = $mappedData->count();

        return $mappedData;
    }

    /**
     * Define the headings for the excel sheet.
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'No',
            'Username',
            'Nama',
            'NIP',
            'Jenis Kelamin',
            'No. HP',
            'Email',
            'Tanggal Lahir',
            'Alamat',
            'Status'
        ];
    }

    /**
     * Set the styles for the excel sheet.
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Set the fill color to yellow for the header
        $sheet->getStyle('A1:J1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('b80202');
        $sheet->getStyle('A1:J1')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        // Center the text for the header
        $sheet->getStyle('A1:J1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Make the text bold for the header
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        // Add border to the cells
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        // Get the last row number
        $endRow = $sheet->getHighestRow();

        // Apply the border style to all cells
        $sheet->getStyle('A1:J' . $endRow)->applyFromArray($styleArray);

        // Set column widths
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Center text in the 'Status' column
        $sheet->getStyle('J1:J' . $endRow)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set the alignment to right for the total
        if (isset($this->totalRowNumber)) {
            $sheet->getStyle('I' . $this->totalRowNumber + 1 . ':J' . $this->totalRowNumber + 1)->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            // Make the text bold for the total
            $sheet->getStyle('I' . $this->totalRowNumber + 1 . ':J' . $this->totalRowNumber + 1)->getFont()->setBold(true);
        }
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_TEXT,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
