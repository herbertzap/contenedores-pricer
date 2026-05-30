<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CotizacionController extends Controller
{
    /**
     * Ver cotización en HTML
     */
    public function ver($codigo)
    {
        $aliases = [
            'cot-010' => 'cot-2024-001',
            'cot-0012' => 'cot-2024-002',
        ];
        $codigo = $aliases[$codigo] ?? $codigo;

        $view = 'cotizaciones.' . $codigo;
        
        if (view()->exists($view)) {
            return view($view);
        }
        
        abort(404, 'Cotización no encontrada');
    }

    /**
     * Descargar cotización como PDF
     */
    public function descargarPdf($codigo)
    {
        $codigoSolicitado = $codigo;
        $aliases = [
            'cot-010' => 'cot-2024-001',
            'cot-0012' => 'cot-2024-002',
        ];
        $codigo = $aliases[$codigo] ?? $codigo;

        $view = 'cotizaciones.' . $codigo;
        
        if (!view()->exists($view)) {
            abort(404, 'Cotización no encontrada');
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
        $filename = 'Cotizacion_' . strtoupper($codigoSolicitado) . '_' . now()->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Ver PDF en el navegador (sin descargar)
     */
    public function verPdf($codigo)
    {
        $codigoSolicitado = $codigo;
        $aliases = [
            'cot-010' => 'cot-2024-001',
            'cot-0012' => 'cot-2024-002',
        ];
        $codigo = $aliases[$codigo] ?? $codigo;

        $view = 'cotizaciones.' . $codigo;
        
        if (!view()->exists($view)) {
            abort(404, 'Cotización no encontrada');
        }

        // Obtener el HTML renderizado
        $html = view($view)->render();
        
        // Convertir imágenes locales a base64 para el PDF
        $html = $this->convertirImagenesBase64($html);

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('letter', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);

        return $pdf->stream('Cotizacion_' . strtoupper($codigoSolicitado) . '.pdf');
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
            
            // Reemplazar URLs del logo PNG por base64
            $html = str_replace(
                'https://contenedores.pricer.cl/assets/img/logo-pricer-contenedores.png',
                $logoBase64,
                $html
            );
        }
        
        // Buscar la imagen del logo JPEG (versión negra) y convertirla a base64
        $logoPathJpeg = public_path('assets/img/logo-pricer-contendores-ng.jpeg');
        
        if (file_exists($logoPathJpeg)) {
            $logoBase64Jpeg = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPathJpeg));
            
            // Reemplazar URLs del logo JPEG por base64
            $html = str_replace(
                'https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg',
                $logoBase64Jpeg,
                $html
            );
        }
        
        return $html;
    }

    /**
     * Listar cotizaciones disponibles
     */
    public function index()
    {
        $cotizaciones = [
            [
                'codigo' => 'cot-0012',
                'titulo' => 'Cotización Adecuaciones API + Traspaso TATC entre Operadores',
                'fecha' => '15 de Abril de 2026',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$550.000 CLP'
            ],
            [
                'codigo' => 'cot-2025-002',
                'titulo' => 'Cotización Licencia Perpetua + Capacitaciones - Contenedores PRICER',
                'fecha' => '09 de Febrero de 2025',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$80.000.000 + IVA'
            ],
            [
                'codigo' => 'cot-2025-001',
                'titulo' => 'Cotización Licencia Perpetua de Software - Contenedores PRICER',
                'fecha' => '21 de Enero de 2025',
                'cliente' => '[Pendiente de asignar]',
                'monto' => '$15.000.000 CLP'
            ],
            [
                'codigo' => 'cot-010',
                'titulo' => 'Cotización Nuevo Operador - Contenedores PRICER',
                'fecha' => '26 de Diciembre de 2024',
                'cliente' => 'CITIKOLD CHILE S.P.A.',
                'monto' => '$4.450.000 CLP'
            ]
        ];

        return view('cotizaciones.index', compact('cotizaciones'));
    }
}

