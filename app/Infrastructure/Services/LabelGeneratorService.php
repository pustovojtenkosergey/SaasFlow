<?php

namespace App\Infrastructure\Services;

use App\Infrastructure\Helpers\QrGenerator;
use App\Models\Package;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

class LabelGeneratorService
{

    public function __construct(
        private BarcodeGeneratorPNG $barcodeGeneratorPNG,
    ) {
    }

    public function generate(Package $package): void
    {
        $labelPath = time() . '_' . $package->track_number . '.pdf';

        $pdf = PDF::loadView('templates.default-label', [
            'package' => $package,
            'qrCode' => base64_encode(QrGenerator::create(route('packages.show', ['package' => $package]))),
            'barcode' => base64_encode($this->barcodeGeneratorPNG->getBarcode($package->track_number, BarcodeGeneratorPNG::TYPE_CODE_128)),
        ]);

        Storage::disk('labels')->put($labelPath, $pdf->output());

        $package->label = $labelPath;
        $package->save();
    }

    public function markCanceled(Package $package): void
    {
        $pdf = PDF::loadView('templates.default-label', [
            'package' => $package,
            'qrCode' => base64_encode(QrGenerator::create(route('packages.show', ['package' => $package]))),
            'barcode' => base64_encode($this->barcodeGeneratorPNG->getBarcode($package->track_number, BarcodeGeneratorPNG::TYPE_CODE_128)),
        ]);

        $pdf->setPaper('L');
        $pdf->output();
        $canvas = $pdf->getDomPDF()->getCanvas();

        $height = $canvas->get_height();
        $width = $canvas->get_width();

        $canvas->set_opacity(.2, "Multiply");

        $canvas->set_opacity(.2);

        $canvas->page_text($width / 3, $height / 2, 'Canceled', null,
            55, array(255, 0, 0), 2, 2, -30);

        Storage::disk('labels')->put($package->label, $pdf->output());
    }
}
