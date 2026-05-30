@extends('components.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">
                            <i class="fas fa-file-invoice-dollar me-2"></i>
                            Cotizaciones
                        </h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Título</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Monto</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                    <th class="text-secondary opacity-7 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cotizaciones as $cotizacion)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ strtoupper($cotizacion['codigo']) }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $cotizacion['titulo'] }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs text-secondary mb-0">{{ $cotizacion['cliente'] }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-success">{{ $cotizacion['monto'] }}</span>
                                    </td>
                                    <td>
                                        <span class="text-secondary text-xs font-weight-bold">{{ $cotizacion['fecha'] }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('cotizaciones.ver', $cotizacion['codigo']) }}" 
                                           class="btn btn-link text-info px-2 mb-0" 
                                           data-bs-toggle="tooltip" 
                                           title="Ver HTML">
                                            <i class="fas fa-eye text-info"></i>
                                        </a>
                                        <a href="{{ route('cotizaciones.ver-pdf', $cotizacion['codigo']) }}" 
                                           class="btn btn-link text-warning px-2 mb-0" 
                                           target="_blank"
                                           data-bs-toggle="tooltip" 
                                           title="Ver PDF">
                                            <i class="fas fa-file-pdf text-warning"></i>
                                        </a>
                                        <a href="{{ route('cotizaciones.pdf', $cotizacion['codigo']) }}" 
                                           class="btn btn-link text-primary px-2 mb-0" 
                                           data-bs-toggle="tooltip" 
                                           title="Descargar PDF">
                                            <i class="fas fa-download text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <p class="text-secondary mb-0">No hay cotizaciones disponibles</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de Acceso Rápido -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-link me-2"></i>Enlaces Directos - COT-2025-002 (Nueva)</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                            <div>
                                <strong>Ver en navegador (HTML)</strong>
                                <p class="text-xs text-secondary mb-0">/cotizaciones/cot-2025-002</p>
                            </div>
                            <a href="{{ route('cotizaciones.ver', 'cot-2025-002') }}" class="btn btn-sm btn-info" target="_blank">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                            <div>
                                <strong>Ver PDF en navegador</strong>
                                <p class="text-xs text-secondary mb-0">/cotizaciones/cot-2025-002/ver-pdf</p>
                            </div>
                            <a href="{{ route('cotizaciones.ver-pdf', 'cot-2025-002') }}" class="btn btn-sm btn-warning" target="_blank">
                                <i class="fas fa-file-pdf"></i>
                            </a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                            <div>
                                <strong>Descargar PDF</strong>
                                <p class="text-xs text-secondary mb-0">/cotizaciones/cot-2025-002/pdf</p>
                            </div>
                            <a href="{{ route('cotizaciones.pdf', 'cot-2025-002') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header pb-0">
                    <h6><i class="fas fa-info-circle me-2"></i>Información</h6>
                </div>
                <div class="card-body">
                    <p class="text-sm">
                        Las cotizaciones se pueden visualizar en formato HTML para una vista rápida, 
                        o descargar como PDF para enviar al cliente.
                    </p>
                    <div class="alert alert-success text-white text-sm" role="alert">
                        <i class="fas fa-star me-2"></i>
                        <strong>COT-2025-002:</strong> Nueva cotización por $80.000.000 + IVA con capacitaciones online y tutoriales en video incluidos.
                    </div>
                    <div class="alert alert-info text-white text-sm" role="alert">
                        <i class="fas fa-lightbulb me-2"></i>
                        <strong>Tip:</strong> Usa el botón de descarga PDF para obtener el documento 
                        listo para enviar al cliente.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

