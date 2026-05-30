<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización COT-0012 - PRICER CONTENEDORES</title>
    <style>
        :root {
            --primary: #FD5523;
            --primary-dark: #e04a1c;
            --secondary: #ff7a50;
            --accent: #2d3748;
            --text-dark: #1a202c;
            --text-light: #4a5568;
            --bg-light: #f7fafc;
            --bg-warm: #fff8f6;
            --border: #e2e8f0;
        }
        @page {
            margin: 10mm 10mm;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: 1.45;
            color: var(--text-dark);
            background: #fff;
        }
        .container { max-width: 210mm; margin: 0 auto; padding: 8mm 10mm; }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 4px solid var(--primary);
            padding-bottom: 14px;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }
        .logo-section { display: flex; align-items: center; gap: 15px; }
        .logo-section img { height: 65px; width: auto; }
        .logo-section .title-group h1 {
            font-size: 22pt;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .logo-section .title-group p { color: var(--text-light); font-size: 10pt; }
        .quote-info { text-align: right; }
        .quote-number {
            font-size: 14pt;
            font-weight: 700;
            color: white;
            background: var(--primary);
            padding: 8px 16px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 8px;
        }
        .quote-date { font-size: 10pt; color: var(--text-light); }
        .info-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }
        .info-card {
            background: var(--bg-light);
            border-radius: 8px;
            padding: 16px 20px;
            border-left: 4px solid var(--primary);
        }
        .info-card.client { border-left-color: var(--accent); }
        .info-card h3 {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            margin-bottom: 12px;
        }
        .info-card p { font-size: 10pt; margin-bottom: 4px; }
        .info-card strong { color: var(--primary); }
        .info-card.client strong { color: var(--accent); }
        .section-title {
            font-size: 14pt;
            font-weight: 700;
            color: var(--accent);
            margin: 18px 0 10px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border);
            page-break-after: avoid;
        }
        .section-title span {
            background: var(--primary);
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 11pt;
            margin-right: 10px;
        }
        .description-box {
            background: var(--bg-warm);
            border-radius: 8px;
            padding: 14px;
            margin-bottom: 12px;
            border: 1px solid #ffe5de;
            page-break-inside: avoid;
        }
        .description-box h4 {
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 11pt;
        }
        .description-box ul { margin-left: 20px; color: var(--text-light); }
        .description-box li { margin-bottom: 5px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            font-size: 10pt;
            page-break-inside: auto;
        }
        th {
            background: var(--primary);
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        th:last-child { text-align: right; }
        td {
            padding: 8px 10px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }
        tr { page-break-inside: avoid; }
        td:last-child {
            text-align: right;
            white-space: nowrap;
            font-weight: 500;
        }
        tr:nth-child(even) { background: var(--bg-light); }
        .item-number {
            background: var(--primary);
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 10pt;
        }
        .item-title { font-weight: 600; color: var(--accent); margin-bottom: 6px; }
        .item-details { color: var(--text-light); font-size: 9pt; line-height: 1.5; }
        .subtotal-row { background: #fff0ec !important; }
        .subtotal-row td {
            font-weight: 600;
            color: var(--primary);
            border-top: 2px solid var(--primary);
        }
        .total-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 8px;
            padding: 16px 18px;
            margin: 14px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            page-break-inside: avoid;
        }
        .total-label { font-size: 12pt; font-weight: 500; color: white; }
        .total-amount { font-size: 28pt; font-weight: 700; color: white; }
        .total-note { font-size: 9pt; opacity: 0.9; margin-top: 5px; color: white; }
        .conditions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 12px 0;
        }
        .condition-card {
            background: var(--bg-light);
            border-radius: 8px;
            padding: 10px;
            border-top: 3px solid var(--primary);
            page-break-inside: avoid;
        }
        .condition-card h4 { color: var(--primary); font-size: 10pt; margin-bottom: 10px; }
        .condition-card ul { margin-left: 20px; font-size: 9pt; color: var(--text-light); }
        .condition-card li { margin-bottom: 4px; }
        .footer {
            text-align: center;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid var(--border);
            font-size: 8pt;
            color: var(--text-light);
            page-break-inside: avoid;
        }
        .brand-accent {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            height: 4px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 2px;
        }

        @media print {
            body {
                font-size: 9.5pt;
                line-height: 1.35;
            }
            .container {
                max-width: none;
                padding: 0;
            }
            .header,
            .info-cards,
            .total-box,
            .footer {
                page-break-inside: avoid;
            }
            .section-title {
                page-break-after: avoid;
            }
            .info-cards,
            .conditions-grid {
                display: block;
            }
            .info-card,
            .condition-card {
                margin-bottom: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="brand-accent"></div>

        <div class="header">
            <div class="logo-section">
                <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg" alt="Pricer Contenedores">
                <div class="title-group">
                    <h1>COTIZACIÓN</h1>
                    <p>PRICER - Gestión de Contenedores</p>
                </div>
            </div>
            <div class="quote-info">
                <div class="quote-number">COT-0012</div>
                <div class="quote-date">
                    Fecha: 20 de Abril de 2026<br>
                    Validez: 30 días corridos
                </div>
            </div>
        </div>

        <div class="info-cards">
            <div class="info-card">
                <h3>Proveedor</h3>
                <p><strong>PRICER CONTENEDORES SPA</strong></p>
                <p>RUT: 76.666.087-8</p>
                <p>Av. Libertad Nº63, Viña del Mar, Chile</p>
                <p>📧 info@pricer.cl</p>
                <p>🌐 www.pricergroup.com</p>
            </div>
            <div class="info-card client">
                <h3>Cliente</h3>
                <p><strong>CITIKOLD CHILE S.P.A.</strong></p>
                <p>RUT: 77.517.274-6</p>
                <p>Avenida El Bosque Norte 0177, piso 18,<br>
                Of.1802<br>
                Las Condes, Chile</p>
                <p>📞 +56 97 160 6340</p>
            </div>
        </div>

        <h2 class="section-title"><span>1</span> Descripción del Servicio</h2>
        <div class="description-box">
            <h4>🎯 Objetivo</h4>
            <p>Implementar las adecuaciones solicitadas para el flujo de transición de operador, incluyendo ajustes de la aplicación y proceso de traspaso de TATC activos con trazabilidad local e integración con <strong>HERMES</strong>.</p>
        </div>
        <div class="description-box">
            <h4>📦 Alcance</h4>
            <ul>
                <li>Adecuación del modelo de datos para campos requeridos en integración.</li>
                <li>Ajustes de frontend y backend para ingreso y exposición de datos.</li>
                <li>Proceso de traspaso de TATC activos entre operadores.</li>
                <li>Registro local, envío API y seguimiento de resultados.</li>
            </ul>
        </div>

        <h2 class="section-title"><span>2</span> Servicios (Pago Único)</h2>
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">N°</th>
                    <th>Descripción del Servicio</th>
                    <th style="width: 120px;">Valor (CLP)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="item-number">1</span></td>
                    <td>
                        <div class="item-title">Modificación de API y Código Base de Ingreso TATC</div>
                        <div class="item-details">
                            • Ajustes de payload y mapeo de campos requeridos<br>
                            • Consultas relacionales (JOIN) para datos en tablas asociadas<br>
                            • Cambios en frontend/backend para ingreso y salida API
                        </div>
                    </td>
                    <td>$250.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">2</span></td>
                    <td>
                        <div class="item-title">Traspaso de TATC Activos entre Operadores</div>
                        <div class="item-details">
                            • Parametrización de nuevo código de operador<br>
                            • Carga/selección de TATC activos a traspasar<br>
                            • Registro local y envío de traspasos a HERMES<br>
                            • Monitoreo de resultados y reporte de ejecución
                        </div>
                    </td>
                    <td>$300.000</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2"><strong>Total Servicios</strong></td>
                    <td><strong>$550.000</strong></td>
                </tr>
            </tbody>
        </table>

        <h2 class="section-title"><span>3</span> Consideraciones Operativas</h2>
        <div class="description-box">
            <h4>⚙️ Coordinación para Traspaso</h4>
            <p>El flujo de traspaso entre operadores requiere coordinación previa entre las partes involucradas (incluyendo operador actual) y validación del procedimiento operativo con la contraparte técnica/regulatoria para asegurar consistencia de titularidad y trazabilidad en HERMES.</p>
        </div>

        <div class="total-box">
            <div>
                <div class="total-label">INVERSIÓN TOTAL</div>
                <div class="total-note">Pago único - valores no incluyen IVA</div>
            </div>
            <div style="text-align: right;">
                <div class="total-amount">$550.000</div>
                <div class="total-note">Pesos Chilenos (CLP)</div>
            </div>
        </div>

        <h2 class="section-title"><span>4</span> Condiciones Comerciales</h2>
        <div class="conditions-grid">
            <div class="condition-card">
                <h4>💳 Forma de Pago</h4>
                <ul>
                    <li><strong>50%</strong> al inicio</li>
                    <li><strong>50%</strong> contra entrega</li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>📅 Plazo Estimado</h4>
                <ul>
                    <li>Adecuaciones API: 5-10 días hábiles</li>
                    <li>Traspaso y validación: 5-10 días hábiles</li>
                    <li><strong>Total: 10-15 días hábiles</strong></li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p><strong>PRICER CONTENEDORES SPA</strong></p>
            <p>Gestión de Contenedores para Aduana de Chile</p>
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el 20 de Abril de 2026 | Cotización válida por 30 días</p>
            <p style="color: var(--primary); font-weight: 500;">www.pricergroup.com</p>
        </div>
    </div>
</body>
</html>
