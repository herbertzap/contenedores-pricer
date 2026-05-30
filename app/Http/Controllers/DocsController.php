<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocsController extends Controller
{
    /**
     * Ver documentacion API V1 para clientes en HTML
     */
    public function apiV1Cliente()
    {
        return view('docs.api-v1-cliente');
    }

    /**
     * Descargar documentacion API V1 como PDF
     */
    public function apiV1ClientePdf()
    {
        $html = view('docs.api-v1-cliente')->render();
        $html = $this->convertirImagenesBase64($html);

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);

        $filename = 'API_V1_Documentacion_Cliente_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Ver documentacion de onboarding en HTML
     */
    public function onboardingOperador()
    {
        return view('docs.onboarding-operador');
    }

    /**
     * Descargar documentacion de onboarding como PDF
     */
    public function onboardingOperadorPdf()
    {
        $html = view('docs.onboarding-operador')->render();
        $html = $this->convertirImagenesBase64($html);

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);

        $filename = 'Onboarding_Nuevo_Operador_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Convertir imágenes locales a base64 para PDF
     */
    private function convertirImagenesBase64($html)
    {
        $logoPathPng = public_path('assets/img/logo-pricer-contenedores.png');
        if (file_exists($logoPathPng)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPathPng));
            $html = str_replace('https://contenedores.pricer.cl/assets/img/logo-pricer-contenedores.png', $logoBase64, $html);
        }

        $logoPathJpeg = public_path('assets/img/logo-pricer-contendores-ng.jpeg');
        if (file_exists($logoPathJpeg)) {
            $logoBase64Jpeg = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPathJpeg));
            $html = str_replace('https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg', $logoBase64Jpeg, $html);
        }

        return $html;
    }
}
