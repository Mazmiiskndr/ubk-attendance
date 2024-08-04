<?php

namespace App\Exports;

use App\Enums\AttendanceStatus;
use App\Services\Attendance\AttendanceService;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;

class DateStudentAttendanceExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    protected $attendanceService;
    protected $totalRowNumber;
    protected $searchByDate;

    /**
     * ListOnlineUsersExport constructor.
     * @param AttendanceService $attendanceService
     */
    public function __construct(AttendanceService $attendanceService, $searchByDate)
    {
        $this->attendanceService = $attendanceService;
        $this->searchByDate = $searchByDate;
    }

    /**
     * Get all the active sessions.
     * @return mixed
     */
    public function collection()
    {
        // Retrieve the data from the hotel rooms service
        $today = Carbon::today()->toDateString();
        $selectedDate = $this->searchByDate ? $this->searchByDate : $today;

        $data = $this->attendanceService->getAttendances(null, null, $selectedDate, null, null, 'mahasiswa');
        // Transform the data to match the headings
        $mappedData = $data->map(function ($row, $key) {
            $status = '-';

            // Check and convert status using the AttendanceStatus enum
            if ($row->status) {
                switch ($row->status) {
                    case AttendanceStatus::Hadir->value:
                        $status = 'Hadir';
                        break;
                    case AttendanceStatus::Sakit->value:
                        $status = 'Sakit';
                        break;
                    case AttendanceStatus::Izin->value:
                        $status = 'Izin';
                        break;
                    case AttendanceStatus::Terlambat->value:
                        $status = 'Terlambat';
                        break;
                    case AttendanceStatus::Alpha->value:
                        $status = 'Alpha';
                        break;
                }
            }
            return [
                'No' => $key + 1,
                'Nama' => $row->user->name ?? '-',
                'Mata Kuliah' => $row->courseSchedule->course->name ?? '-',
                'Jam Masuk' => $row->check_in ?? '-',
                'Jam Keluar' => $row->check_out ?? '-',
                'Tanggal' => date("Y-m-d", strtotime($row->attendance_date)) ?? '-',
                'Status' => $status ?? '-',
                'Catatan' => $row->remarks ?? '-',
            ];
        });


        $totalAttendances = $mappedData->count();

        $mappedData->push([
            'No' => '',
            'Nama' => '',
            'Mata Kuliah' => '',
            'Jam Masuk' => '',
            'Jam Keluar' => '',
            'Tanggal' => '',
            'Status' => 'TOTAL',
            'Catatan' => $totalAttendances
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
            'Nama',
            'Mata Kuliah',
            'Jam Masuk',
            'Jam Keluar',
            'Tanggal',
            'Status',
            'Catatan'
        ];
    }

    /**
     * Set the styles for the excel sheet.
     * @param Worksheet $sheet
     */
    public function styles(Worksheet $sheet)
    {
        // Set the fill color to yellow for the header
        $sheet->getStyle('A1:H1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('b80202');
        $sheet->getStyle('A1:H1')->getFont()->getColor()->setARGB(Color::COLOR_WHITE);

        // Center the text for the header
        $sheet->getStyle('A1:H1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Make the text bold for the header
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

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
        $sheet->getStyle('A1:H' . $endRow)->applyFromArray($styleArray);

        // Set column widths
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Center text in the 'Status' column
        $sheet->getStyle('G1:G' . $endRow)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set the alignment and font style for the total
        if (isset($this->totalRowNumber)) {
            // Set alignment to right for column G
            $sheet->getStyle('G' . ($this->totalRowNumber + 1))
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

            // Set alignment to left for column H
            $sheet->getStyle('H' . ($this->totalRowNumber + 1))
                ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Make the text bold for both columns G and H
            $sheet->getStyle('G' . ($this->totalRowNumber + 1) . ':H' . ($this->totalRowNumber + 1))
                ->getFont()
                ->setBold(true);
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
        ];
    }
}
