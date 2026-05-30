<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización COT-010 - PRICER CONTENEDORES</title>
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        @page {
            margin: 10mm 10mm;
        }

        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 10pt;
            line-height: 1.45;
            color: var(--text-dark);
            background: #fff;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 8mm 10mm;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 4px solid var(--primary);
            padding-bottom: 14px;
            margin-bottom: 18px;
            page-break-inside: avoid;
        }
        
        .logo-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .logo-section img {
            height: 65px;
            width: auto;
        }
        
        .logo-section .title-group h1 {
            font-size: 22pt;
            color: var(--primary);
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        
        .logo-section .title-group p {
            color: var(--text-light);
            font-size: 10pt;
        }
        
        .quote-info {
            text-align: right;
        }
        
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
        
        .quote-date {
            font-size: 10pt;
            color: var(--text-light);
        }
        
        /* Info Cards */
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
        
        .info-card.client {
            border-left-color: var(--accent);
        }
        
        .info-card h3 {
            font-size: 9pt;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            margin-bottom: 12px;
        }
        
        .info-card p {
            font-size: 10pt;
            margin-bottom: 4px;
        }
        
        .info-card strong {
            color: var(--primary);
        }
        
        .info-card.client strong {
            color: var(--accent);
        }
        
        /* Section Titles */
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
        
        /* Description Box */
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
        
        .description-box p {
            color: var(--text-dark);
        }
        
        .description-box ul {
            margin-left: 20px;
            color: var(--text-light);
        }
        
        .description-box li {
            margin-bottom: 5px;
        }
        
        .description-box li strong {
            color: var(--primary);
        }
        
        /* Tables */
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
        
        th:last-child {
            text-align: right;
        }
        
        td {
            padding: 8px 10px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }

        tr {
            page-break-inside: avoid;
        }
        
        td:last-child {
            text-align: right;
            white-space: nowrap;
            font-weight: 500;
        }
        
        tr:nth-child(even) {
            background: var(--bg-light);
        }
        
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
        
        .item-title {
            font-weight: 600;
            color: var(--accent);
            margin-bottom: 6px;
        }
        
        .item-details {
            color: var(--text-light);
            font-size: 9pt;
            line-height: 1.5;
        }
        
        .subtotal-row {
            background: #fff0ec !important;
        }
        
        .subtotal-row td {
            font-weight: 600;
            color: var(--primary);
            border-top: 2px solid var(--primary);
        }
        
        /* Total Box */
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
        
        .total-label {
            font-size: 12pt;
            font-weight: 500;
            color: white;
        }
        
        .total-amount {
            font-size: 28pt;
            font-weight: 700;
            color: white;
        }
        
        .total-note {
            font-size: 9pt;
            opacity: 0.9;
            margin-top: 5px;
            color: white;
        }
        
        /* Renewal Box */
        .renewal-box {
            background: var(--bg-warm);
            border: 2px dashed var(--primary);
            border-radius: 8px;
            padding: 14px;
            margin: 12px 0;
            page-break-inside: avoid;
        }
        
        .renewal-box h4 {
            color: var(--primary);
            margin-bottom: 15px;
            font-size: 11pt;
        }
        
        .renewal-items {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .renewal-item {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 6px;
            border: 1px solid var(--border);
        }
        
        .renewal-item .label {
            font-size: 8pt;
            color: var(--text-light);
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        
        .renewal-item .value {
            font-size: 12pt;
            font-weight: 600;
            color: var(--accent);
        }
        
        .renewal-total {
            text-align: center;
            padding-top: 15px;
            border-top: 2px solid var(--primary);
        }
        
        .renewal-total .label {
            font-size: 9pt;
            color: var(--text-light);
        }
        
        .renewal-total .value {
            font-size: 18pt;
            font-weight: 700;
            color: var(--primary);
        }
        
        /* Conditions */
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
        
        .condition-card h4 {
            color: var(--primary);
            font-size: 10pt;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .condition-card ul {
            margin-left: 20px;
            font-size: 9pt;
            color: var(--text-light);
        }
        
        .condition-card li {
            margin-bottom: 4px;
        }
        
        .condition-card strong {
            color: var(--primary);
        }
        
        /* Signatures */
        .signatures {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-top: 20px;
            padding-top: 14px;
            border-top: 2px solid var(--border);
            page-break-inside: avoid;
        }
        
        .signature-box {
            text-align: center;
        }
        
        .signature-box h4 {
            font-size: 10pt;
            color: var(--primary);
            margin-bottom: 24px;
        }
        
        .signature-line {
            border-top: 1px solid var(--text-dark);
            padding-top: 10px;
            font-size: 9pt;
            color: var(--text-light);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid var(--border);
            font-size: 8pt;
            color: var(--text-light);
            page-break-inside: avoid;
            page-break-before: auto;
        }
        
        .footer .logo-container {
            background: #062E39;
            padding: 0px 5px;
            border-radius: 8px;
            display: inline-block;
            margin-bottom: 10px;
        }
        
        .footer .logo-container img {
            height: 55px;
            opacity: 1;
        }
        
        /* Print Styles */
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
            .renewal-box,
            .signatures,
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
        
        /* Contingency Badge */
        .contingency-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 8pt;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 8px;
        }
        
        /* Pricer Brand Accent */
        .brand-accent {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            height: 4px;
            width: 100%;
            margin-bottom: 20px;
            border-radius: 2px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Brand Accent Line -->
        <div class="brand-accent"></div>
        
        <!-- Header -->
        <div class="header">
            <div class="logo-section">
                <div class="logo-container">
                    <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg" alt="Pricer Contenedores">
                </div>
                <div class="title-group">
                    <h1>COTIZACIÓN</h1>
                    <p>PRICER - Gestión de Contenedores</p>
                </div>
            </div>
            <div class="quote-info">
                <div class="quote-number">COT-010</div>
                <div class="quote-date">
                    Fecha: 20 de Abril de 2026<br>
                    Validez: 30 días corridos
                </div>
            </div>
        </div>

        <!-- Info Cards -->
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

        <!-- Descripción del Proyecto -->
        <h2 class="section-title"><span>1</span> Descripción del Proyecto</h2>
        
        <div class="description-box">
            <h4>🎯 Objetivo</h4>
            <p>Proveer acceso al <strong>SISTEMA CONTENEDORES PRICER</strong> para la gestión integral de contenedores bajo el régimen de admisión temporal ante la Aduana de Chile, incluyendo integración con el sistema <strong>HERMES</strong>.</p>
        </div>

        <div class="description-box">
            <h4>📦 Alcance del Servicio</h4>
            <ul>
                <li><strong>Implementación:</strong> Configuración del operador, carga de datos maestros, migración de datos históricos</li>
                <li><strong>TATC/TSTC:</strong> Registro, consulta, modificación y emisión de títulos de admisión y salida</li>
                <li><strong>Salidas:</strong> Gestión de internaciones, cancelaciones y traspasos</li>
                <li><strong>Control:</strong> Plazos, vencimientos, inventarios y fiscalización</li>
                <li><strong>API REST:</strong> Integración externa con autenticación por Token para generación masiva</li>
                <li><strong>HERMES:</strong> Envío automático de documentos a la Aduana de Chile</li>
            </ul>
        </div>

        <!-- Detalle de Implementación -->
        <h2 class="section-title"><span>2</span> Servicios de Implementación (Pago Único)</h2>
        
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
                        <div class="item-title">Migración de Datos y Configuración Inicial</div>
                        <div class="item-details">
                            • Importación de datos históricos (TATC, TSTC, contenedores)<br>
                            • Configuración del operador y datos maestros<br>
                            • Configuración de almacenes y lugares de depósito<br>
                            • Parametrización para certificación ante Aduana<br>
                            • Capacitación inicial del sistema
                        </div>
                    </td>
                    <td>$350.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">2</span></td>
                    <td>
                        <div class="item-title">Desarrollo de API REST para Integración Externa</div>
                        <div class="item-details">
                            • Diseño y desarrollo de endpoints TATC/TSTC<br>
                            • Sistema de autenticación por Token Bearer<br>
                            • Generación de PDFs vía API<br>
                            • Integración automática con HERMES<br>
                            • Documentación técnica (Swagger/OpenAPI)
                        </div>
                    </td>
                    <td>$500.000</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2"><strong>Subtotal Implementación</strong></td>
                    <td><strong>$850.000</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Servicios Anuales -->
        <h2 class="section-title"><span>3</span> Servicios Recurrentes (Pago Anual)</h2>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">N°</th>
                    <th>Descripción del Servicio</th>
                    <th style="width: 120px;">Valor Anual</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="item-number">3</span></td>
                    <td>
                        <div class="item-title">Licencia de Uso del Sistema PRICER CONTENEDORES</div>
                        <div class="item-details">
                            • Acceso ilimitado al sistema web<br>
                            • Generación ilimitada de TATC y TSTC<br>
                            • Generación de PDFs oficiales formato Aduana<br>
                            • Integración con sistema HERMES<br>
                            • Control de plazos, vencimientos y alertas<br>
                            • Reportes y exportaciones (Excel, CSV, PDF)
                        </div>
                    </td>
                    <td>$1.800.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">4</span></td>
                    <td>
                        <div class="item-title">Mantención y Soporte Técnico</div>
                        <div class="item-details">
                            • Actualizaciones del sistema<br>
                            • Corrección de errores<br>
                            • Atención 24/7 para urgencias (vía correo o WhatsApp)<br>
                            • Soporte vía sistema de tickets con 3 niveles (leve, moderado, urgente)<br>
                            • Tiempo máximo de respuesta inicial: 1 hora<br>
                            • En cada respuesta se informará tiempo estimado de solución
                        </div>
                    </td>
                    <td>$700.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">5</span></td>
                    <td>
                        <div class="item-title">Hosting y Servicios Cloud</div>
                        <div class="item-details">
                            • Servidor dedicado en la nube<br>
                            • Certificado SSL incluido<br>
                            • Respaldos automáticos diarios<br>
                            • Disponibilidad objetivo 100%<br>
                            • Servidores espejo en región alternativa para continuidad operativa<br>
                            • Monitoreo 24/7
                        </div>
                    </td>
                    <td>$600.000</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2"><strong>Subtotal Servicios Anuales</strong></td>
                    <td><strong>$3.100.000</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Contingencia -->
        <h2 class="section-title"><span>4</span> Servicio de Contingencia</h2>
        
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
                    <td><span class="item-number">6</span></td>
                    <td>
                        <span class="contingency-badge">⚡ Servicio Especial</span>
                        <div class="item-title">Uso de Contingencia - Operador S46</div>
                        <div class="item-details">
                            Durante el proceso de certificación ante Aduana, el cliente podrá emitir 
                            TATC y TSTC utilizando el código de operador autorizado <strong>S46</strong> 
                            (Contenedores Tomás Dagnino Vicencio E.I.R.L)<br><br>
                            <strong>Incluye:</strong><br>
                            • Emisión de TATC bajo código S46<br>
                            • Emisión de TSTC bajo código S46<br>
                            • Envío a HERMES con credenciales certificadas<br>
                            • Responsabilidad legal durante contingencia<br>
                            • Traspaso posterior a código propio del cliente<br><br>
                            <em>Vigencia: Hasta obtención de certificación propia (máx. 6 meses)</em>
                        </div>
                    </td>
                    <td>$500.000</td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="total-box">
            <div>
                <div class="total-label">INVERSIÓN TOTAL PRIMER AÑO</div>
                <div class="total-note">Valores no incluyen IVA</div>
            </div>
            <div style="text-align: right;">
                <div class="total-amount">$4.450.000</div>
                <div class="total-note">Pesos Chilenos (CLP)</div>
            </div>
        </div>

        <!-- Renovación -->
        <div class="renewal-box">
            <h4>🔄 Renovación Anual (A partir del 2° año)</h4>
            <div class="renewal-items">
                <div class="renewal-item">
                    <div class="label">Licencia</div>
                    <div class="value">$1.800.000</div>
                </div>
                <div class="renewal-item">
                    <div class="label">Mantención</div>
                    <div class="value">$700.000</div>
                </div>
                <div class="renewal-item">
                    <div class="label">Hosting</div>
                    <div class="value">$600.000</div>
                </div>
            </div>
            <div class="renewal-total">
                <div class="label">Total Renovación Anual</div>
                <div class="value">$3.100.000</div>
            </div>
        </div>

        <!-- Condiciones -->
        <h2 class="section-title"><span>5</span> Condiciones Comerciales</h2>
        
        <div class="conditions-grid">
            <div class="condition-card">
                <h4>💳 Forma de Pago</h4>
                <ul>
                    <li><strong>50%</strong> al momento de aceptación</li>
                    <li><strong>50%</strong> contra entrega y puesta en marcha</li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>📅 Plazo de Implementación</h4>
                <ul>
                    <li>Configuración inicial: 2-5 días hábiles</li>
                    <li>Configuración inicial: 2-5 días hábiles</li>
                    <li>Desarrollo API: 5-10 días hábiles</li>
                    <li><strong>Total: 5-10 días hábiles</strong></li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>📋 Requisitos del Cliente</h4>
                <ul>
                    <li>Información completa del operador</li>
                    <li>Datos históricos en formato digital</li>
                    <li>Contacto técnico designado</li>
                    <li>Logo y firma digital (alta resolución)</li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>✅ SLA Garantizado</h4>
                <ul>
                    <li>Disponibilidad objetivo: <strong>100%</strong></li>
                    <li>Respuesta inicial tickets: <strong>máximo 1 hora</strong></li>
                    <li>Respaldos: diarios (30 días retención)</li>
                </ul>
            </div>
        </div>

        <!-- Firmas -->
        <div class="signatures">
            <div class="signature-box">
                <h4>ACEPTACIÓN DEL CLIENTE</h4>
                <div class="signature-line">
                    Nombre y Firma<br>
                    Fecha: ____/____/________
                </div>
            </div>
            <div class="signature-box">
                <h4>ACEPTACIÓN DEL PROVEEDOR</h4>
                <div class="signature-line">
                    PRICER CONTENEDORES SPA<br>
                    Representante Legal
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="logo-container" style="display: inline-block; padding: 0px 5px; margin-bottom: 10px;">
                <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg" alt="Pricer Contenedores" style="height: 55px;">
            </div>
            <p><strong>PRICER CONTENEDORES SPA</strong></p>
            <p>Gestión de Contenedores para Aduana de Chile</p>
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el 20 de Abril de 2026 | Cotización válida por 30 días</p>
            <p style="color: var(--primary); font-weight: 500;">www.pricergroup.com</p>
        </div>
    </div>
</body>
</html>
