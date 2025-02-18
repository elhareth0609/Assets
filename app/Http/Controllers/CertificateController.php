<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use setasign\Fpdi\Tcpdf\Fpdi;

class CertificateController extends Controller {

    // public function get($id) {
    //     try {
    //         // $coupon = Coupon::find($id);
    //         // return response()->json([
    //         //     'coupon' => $coupon,
    //         // ], 200);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'state' => __("Error"),
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

    public function generateCertificate(Request $request) {
        try {
            // Path to the certificate template
            $pdfPath = public_path('assets/img/my/defaults/certificate.pdf');

            // Check if the template exists
            if (!file_exists($pdfPath)) {
                return response()->json([
                    'error' => 'Certificate template not found',
                    'path' => $pdfPath
                ], 404);
            }

            // Create new PDF document using FPDI instead of TCPDF
            $pdf = new Fpdi('L', 'mm', 'A4', true, 'UTF-8', false);

            // Set document information
            $pdf->SetCreator('Your Organization');
            $pdf->SetAuthor('Your Organization');
            $pdf->SetTitle('Certificate of Completion');

            // Import the template using FPDI
            try {
                // Import first page of the template
                $pdf->setSourceFile($pdfPath);
                $tplIdx = $pdf->importPage(1);
                //         // Get the dimensions of the imported template
                $size = $pdf->getTemplateSize($tplIdx);

                // Add a page with the same dimensions as the template
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

                $pdf->useTemplate($tplIdx); // A4 landscape dimensions
            } catch (Exception $e) {
                return response()->json([
                    'error' => 'Error loading PDF template',
                    'details' => $e->getMessage()
                ], 500);
            }

            // Enable Arabic text support
            $pdf->setRTL(true);

            // Set font for Arabic text
            // Make sure the Amiri font files are in the correct TCPDF fonts directory
            $pdf->SetFont('amiri', '', 24);

            // Overlay dynamic content in Arabic
            $pdf->SetXY(10, 50);
            $pdf->Cell(0, 10, 'شهادة تقدير', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            $pdf->SetXY(10, 70);
            $pdf->Cell(0, 10, 'تم منح هذه الشهادة إلى', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            $pdf->SetFontSize(30);
            $pdf->SetXY(10, 100);
            $pdf->Cell(0, 10, 'خلفاوي الحارث', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            $pdf->SetFontSize(16);
            $pdf->SetXY(10, 130);
            $pdf->Cell(0, 10, 'لإبداعه في إنشاء هذا التطبيق', 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            // Add the date
            $pdf->SetXY(10, 160);
            $pdf->Cell(0, 10, date('d-m-Y'), 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            // Generate unique filename
            return response()->streamDownload(function () use ($pdf) {
                $pdf->Output();
            }, 'certificate.pdf');

        } catch (Exception $e) {
            return response()->json([
                'icon' => 'error',
                'message' => __('Certificate generation failed'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function pdf(Request $request) {
        try {
            $pdfPath = public_path('assets/img/my/defaults/certificate.pdf');

            if (!file_exists($pdfPath)) {
                return response()->json([
                    'icon' => 'error',
                    'message' => __('Certificate template not found'),
                    'error' => $pdfPath
                ], 404);
            }

            $pdf = new Fpdi('L', 'mm', 'A4', true, 'UTF-8', false);

            try {
                $pdf->setSourceFile($pdfPath);
                $tplIdx = $pdf->importPage(1);
                $size = $pdf->getTemplateSize($tplIdx);

                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

                $pdf->useTemplate($tplIdx);
            } catch (Exception $e) {
                return response()->json([
                    'icon' => 'error',
                    'message' => __('Error loading PDF template'),
                    'error' => $e->getMessage()
                ], 500);
            }

            $pdf->setRTL(true);

            $pdf->SetFont('amiri', '', 24);

            $pdf->SetXY($request->name_x, $request->name_y);
            $pdf->Cell(10, 10, $request->name, 0, 1, 'R');

            $pdf->SetXY($request->company_x, $request->company_y);
            $pdf->Cell(10, 10, $request->company, 0, 1, 'R');

            // $pdf->SetXY(10, 160);
            // $pdf->Cell(0, 10, $request->from_date, 0, 1, 'C', 0, '', 0, false, 'T', 'M');
            $dateParts = explode('-', $request->from_date); // Split the date into parts

            // Assign day, month, and year
            $day = $dateParts[2];   // Day
            $month = $dateParts[1]; // Month
            $year = $dateParts[0];  // Year

            $pdf->SetXY(84, 100); // Set the position
            $pdf->SetFont('amiri', '', 17); // Set font family, style, and size (e.g., 12pt)
            $pdf->Cell(0, 10, $year . '  ' . $month . '   ' . $day, 0, 1, 'C', 0, '', 0, false, 'T', 'M');

            $dateParts = explode('-', $request->to_date); // Split the date into parts

            $day = $dateParts[2];   // Day
            $month = $dateParts[1]; // Month
            $year = $dateParts[0];  // Year

            $pdf->SetXY(21, 110); // Set the position (X=0 to start from the left edge)
            $pdf->SetFont('amiri', '', 17); // Set Amiri font with size 17
            $pdf->Cell(0, 10, $year . '  ' . $month . '   ' . $day, 0, 1, 'R', 0, '', 0, false, 'T', 'M');

            function writeMultiLineText($pdf, $x, $y, $text, $maxY = 270) {
                $pdf->SetFont('amiri', '', 17); // Set the font and size (adjust as needed)
        
                $maxWidth1 = 20; // Maximum width for each line (adjust as needed)
                $maxWidth2 = 130; // Maximum width for each line (adjust as needed)
                $lineHeight = 10; // Height of each line

                // Split the text into lines
                $lines1 = explode("\n", wordwrap($text, $maxWidth1, "\n")); // Break text into lines
                $firstLine = $lines1[0];

                $pdf->SetXY($x, $y); // Set the position for the current line
                $pdf->Cell(0, $lineHeight, $firstLine, 0, 1, 'R'); // Write the line

                $remainingText = substr($text, strlen($firstLine)); // Get the remaining text

                // Split the remaining text into lines for the second part
                $lines2 = explode("\n", wordwrap($remainingText, $maxWidth2, "\n")); // Break remaining text into lines

                // Loop through each line and write it to the PDF
                foreach ($lines2 as $line) {
                    // Check if the next line will exceed the maxY (page height)
                    if ($y + $lineHeight > $maxY) {
                        break; // Stop writing if the next line exceeds the maximum Y position
                    }

                    $y += $lineHeight + 4; // Move Y position down for the next line
                    $pdf->SetXY(17, $y); // Set the position for subsequent lines (X=10)
                    $pdf->Cell(0, $lineHeight, $line, 0, 1, 'R'); // Write the line
                }
            }

            writeMultiLineText($pdf, 146, 110, $request->reason);

            $now = Carbon::now();

            // Extract day, month, and year
            $day = $now->day;   // Day
            $month = $now->month; // Month
            $year = $now->year;  // Year

            $pdf->SetXY(98, 176); // Set the position (X=0 to start from the left edge)
            $pdf->SetFont('amiri', '', 17); // Set Amiri font with size 17
            $pdf->Cell(0, 10, $year . '    ' . $month . '   ' . $day, 0, 1, 'R', 0, '', 0, false, 'T', 'M');

            $today = Carbon::now();

            $todayArabic = $today->locale('ar')->isoFormat('dddd'); // Example: الثلاثاء

            $pdf->SetXY(48, 176); // Set the position (X=0 to start from the left edge)
            $pdf->SetFont('amiri', '', 17); // Set Amiri font with size 17
            $pdf->Cell(0, 10, $todayArabic, 0, 1, 'R', 0, '', 0, false, 'T', 'M');

            return response()->streamDownload(function () use ($pdf) {
                $pdf->Output();
            }, 'certificate.pdf');

        } catch (Exception $e) {
            return response()->json([
                'icon' => 'error',
                'message' => __('Certificate generation failed'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function delete($id) {
    //     try {
    //         $coupon = Coupon::withTrashed()->findOrFail($id);

    //         if ($coupon->trashed()) {
    //             $coupon->forceDelete();
    //         } else {
    //             $coupon->delete();
    //         }

    //         return response()->json([
    //             'icon' => 'success',
    //             'state' => 'Deleted',
    //             'message' => 'Coupon deleted successfully.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'icon' => 'error',
    //             'state' => 'Error',
    //             'message' => 'An error occurred while deleting the coupon.'
    //         ], 500);
    //     }
    // }
}




