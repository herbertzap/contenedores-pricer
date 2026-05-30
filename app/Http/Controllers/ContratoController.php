<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ContratoController extends Controller
{
    /**
     * Ver contrato en HTML
     */
    public function ver($codigo)
    {
        $view = 'contratos.' . $codigo;
        
        if (view()->exists($view)) {
            return view($view);
        }
        
        abort(404, 'Contrato no encontrado');
    }

    /**
     * Descargar contrato como PDF
     */
    public function descargarPdf($codigo)
    {
        $view = 'contratos.' . $codigo;
        
        if (!view()->exists($view)) {
            abort(404, 'Contrato no encontrado');
        }

        // Obtener el HTML renderizado
        $html = view($view)->render();
        
        // Convertir imágenes locales a base64 para el PDF
        $html = $this->convertirImagenesBase64($html);

        // Generar PDF
        $pdf = Pdf::loadHTML($html);
        
        // Configurar opciones del PDF
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);

        // Nombre del archivo
        $filename = 'Contrato_' . strtoupper(str_replace('-', '_', $codigo)) . '_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Ver PDF en el navegador (sin descargar)
     */
    public function verPdf($codigo)
    {
        $view = 'contratos.' . $codigo;
        
        if (!view()->exists($view)) {
            abort(404, 'Contrato no encontrado');
        }

        // Obtener el HTML renderizado
        $html = view($view)->render();
        
        // Convertir imágenes locales a base64 para el PDF
        $html = $this->convertirImagenesBase64($html);

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);

        return $pdf->stream('Contrato_' . strtoupper(str_replace('-', '_', $codigo)) . '.pdf');
    }

    /**
     * Convertir imágenes a base64 para el PDF
     */
    private function convertirImagenesBase64($html)
    {
        // Buscar la imagen del logo PNG y convertirla a base64
        $logoPathPng = public_path('assets/img/logo-pricer-contenedores.png');
        
        if (file_exists($logoPathPng)) {
            $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPathPng));
            
            $html = str_replace(
                'https://contenedores.pricer.cl/assets/img/logo-pricer-contenedores.png',
                $logoBase64,
                $html
            );
        }
        
        // Buscar la imagen del logo JPEG y convertirla a base64
        $logoPathJpeg = public_path('assets/img/logo-pricer-contendores-ng.jpeg');
        
        if (file_exists($logoPathJpeg)) {
            $logoBase64Jpeg = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPathJpeg));
            
            $html = str_replace(
                'https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg',
                $logoBase64Jpeg,
                $html
            );
        }
        
        return $html;
    }

    /**
     * Listar contratos disponibles
     */
    public function index()
    {
        $contratos = [
            [
                'codigo' => 'contrato-citikold-completo-2025',
                'titulo' => 'Contrato Completo Licencia de Uso Anual - CONTENEDORES PRICER',
                'fecha' => '09 de Febrero de 2025',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$3.490.000 + IVA (anual)'
            ],
            [
                'codigo' => 'contrato-citikold-arriendo-2025',
                'titulo' => 'Contrato Simple Licencia de Uso Anual - CONTENEDORES PRICER',
                'fecha' => '09 de Febrero de 2025',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$3.490.000 + IVA (anual)'
            ],
            [
                'codigo' => 'contrato-citikold-2025',
                'titulo' => 'Contrato Licencia Perpetua - CONTENEDORES PRICER',
                'fecha' => '09 de Febrero de 2025',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$80.000.000 + IVA'
            ]
        ];

        return view('contratos.index', compact('contratos'));
    }
}
