<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización COT-2025-001 - PRICER CONTENEDORES</title>
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
        
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: var(--text-dark);
            background: #fff;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm 20mm;
        }
        
        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 4px solid var(--primary);
            padding-bottom: 20px;
            margin-bottom: 30px;
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
            margin-bottom: 30px;
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
            margin: 30px 0 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border);
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
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #ffe5de;
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
            margin-bottom: 20px;
            font-size: 10pt;
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
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
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
            padding: 25px 30px;
            margin: 30px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            padding: 20px;
            margin: 20px 0;
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
            gap: 20px;
            margin: 20px 0;
        }
        
        .condition-card {
            background: var(--bg-light);
            border-radius: 8px;
            padding: 15px;
            border-top: 3px solid var(--primary);
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
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid var(--border);
        }
        
        .signature-box {
            text-align: center;
        }
        
        .signature-box h4 {
            font-size: 10pt;
            color: var(--primary);
            margin-bottom: 60px;
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
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            font-size: 8pt;
            color: var(--text-light);
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
            .container {
                padding: 10mm 15mm;
            }
            
            .page-break {
                page-break-before: always;
            }
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
                <div class="quote-number">COT-2025-001</div>
                <div class="quote-date">
                    Fecha: 21 de Enero de 2025<br>
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
                <p>📧 contacto@pricergroup.com</p>
                <p>🌐 www.pricergroup.com</p>
            </div>
            <div class="info-card client">
                <h3>Cliente</h3>
                <p><strong>[Nombre del Cliente]</strong></p>
                <p>RUT: [RUT del Cliente]</p>
                <p>[Dirección del Cliente]</p>
                <p>📧 [Email del Cliente]</p>
            </div>
        </div>

        <!-- Descripción del Proyecto -->
        <h2 class="section-title"><span>1</span> Descripción del Proyecto</h2>
        
        <div class="description-box">
            <h4>🎯 Objetivo</h4>
            <p>Proveer la <strong>LICENCIA DE USO DEL SOFTWARE CONTENEDORES PRICER</strong> para la gestión integral de contenedores bajo el régimen de admisión temporal ante la Aduana de Chile, incluyendo integración con el sistema <strong>HERMES</strong>. El software será instalado y desplegado en servidor del cliente, otorgando total autonomía y control sobre la infraestructura.</p>
        </div>

        <div class="description-box">
            <h4>📦 Alcance del Servicio</h4>
            <ul>
                <li><strong>Instalación y Despliegue:</strong> Configuración del servidor, instalación del software, despliegue en infraestructura del cliente</li>
                <li><strong>Migración de Datos:</strong> Traspaso completo de datos históricos (TATC, TSTC, prórrogas, traspasos y otros registros) al nuevo sistema</li>
                <li><strong>Configuración Inicial:</strong> Configuración del operador, carga de datos maestros, parametrización para certificación ante Aduana</li>
                <li><strong>TATC/TSTC:</strong> Registro, consulta, modificación y emisión de títulos de admisión y salida</li>
                <li><strong>Salidas:</strong> Gestión de internaciones, cancelaciones y traspasos</li>
                <li><strong>Control:</strong> Plazos, vencimientos, inventarios y fiscalización</li>
                <li><strong>API REST:</strong> Integración externa con autenticación por Token para generación masiva</li>
                <li><strong>HERMES:</strong> Envío automático de documentos a la Aduana de Chile</li>
                <li><strong>Validación Aduana:</strong> Generación de archivos y documentación para validación del sistema frente a Aduana</li>
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
                        <div class="item-title">Instalación y Despliegue en Servidor del Cliente</div>
                        <div class="item-details">
                            • Análisis de infraestructura y requisitos del servidor<br>
                            • Instalación del software CONTENEDORES PRICER<br>
                            • Configuración del servidor web (Apache/Nginx)<br>
                            • Configuración de base de datos (MySQL/MariaDB)<br>
                            • Configuración de PHP y extensiones necesarias<br>
                            • Configuración de certificados SSL<br>
                            • Optimización de rendimiento y seguridad<br>
                            • Documentación técnica de la instalación
                        </div>
                    </td>
                    <td>$550.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">2</span></td>
                    <td>
                        <div class="item-title">Migración de Datos Históricos y Configuración</div>
                        <div class="item-details">
                            • Análisis y mapeo de datos históricos del sistema anterior<br>
                            • Importación de datos históricos (TATC, TSTC, contenedores)<br>
                            • Migración de prórrogas y traspasos registrados<br>
                            • Validación e integridad de datos migrados<br>
                            • Configuración del operador y datos maestros<br>
                            • Configuración de almacenes y lugares de depósito<br>
                            • Parametrización para certificación ante Aduana<br>
                            • Capacitación inicial del sistema (4 horas)
                        </div>
                    </td>
                    <td>$650.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">3</span></td>
                    <td>
                        <div class="item-title">Configuración de API REST para Integración Externa</div>
                        <div class="item-details">
                            • Configuración de endpoints TATC/TSTC existentes<br>
                            • Configuración de sistema de autenticación por Token Bearer<br>
                            • Configuración de generación de PDFs vía API<br>
                            • Configuración de integración automática con HERMES<br>
                            • Entrega de documentación técnica (Swagger/OpenAPI)<br>
                            • Pruebas de integración y validación<br>
                            • Capacitación en uso de la API
                        </div>
                    </td>
                    <td>$600.000</td>
                </tr>
                <tr>
                    <td><span class="item-number">4</span></td>
                    <td>
                        <div class="item-title">Generación de Archivos para Validación ante Aduana</div>
                        <div class="item-details">
                            • Generación de documentación técnica del sistema<br>
                            • Manuales de usuario de todos los módulos<br>
                            • Procedimientos de operación del sistema<br>
                            • Procedimientos de respaldo de información<br>
                            • Procedimientos de cambio de claves<br>
                            • Evidencias de respaldos y rutinas<br>
                            • Documentación de integración HERMES<br>
                            • Preparación de archivos para presentación ante Aduana
                        </div>
                    </td>
                    <td>$500.000</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2"><strong>Subtotal Implementación</strong></td>
                    <td><strong>$2.300.000</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Licencia Perpetua -->
        <h2 class="section-title"><span>3</span> Licencia de Software (Pago Único - Perpetua)</h2>
        
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
                    <td><span class="item-number">5</span></td>
                    <td>
                        <div class="item-title">Licencia PERPETUA del Software CONTENEDORES PRICER</div>
                        <div class="item-details">
                            <strong>Licencia de uso PERPETUA del software Versión 1.0 para gestión de contenedores.</strong><br><br>
                            • Acceso ilimitado al sistema web<br>
                            • Generación ilimitada de TATC y TSTC<br>
                            • Generación de PDFs oficiales formato Aduana<br>
                            • Integración con sistema HERMES<br>
                            • Control de plazos, vencimientos y alertas<br>
                            • Reportes y exportaciones (Excel, CSV, PDF)<br>
                            • Módulo de consultas para Aduana<br>
                            • Sistema de tickets integrado<br>
                            • Gestión de usuarios y permisos<br>
                            • Código fuente del software (Versión 1.0)<br>
                            • Documentación técnica completa<br><br>
                            <strong>La licencia PERPETUA otorga el derecho de uso del software instalado en servidor del cliente de forma permanente, sin límite de tiempo, para la Versión 1.0 actual del sistema.</strong><br><br>
                            <em>Nota: Esta licencia cubre la versión actual del software. Actualizaciones mayores a versiones superiores pueden requerir licencias adicionales.</em>
                        </div>
                    </td>
                    <td>$11.500.000</td>
                </tr>
            </tbody>
        </table>

        <!-- Mantención Primer Año -->
        <h2 class="section-title"><span>4</span> Mantención y Soporte Técnico (Primer Año)</h2>
        
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
                        <div class="item-title">Mantención y Soporte Técnico (Primer Año)</div>
                        <div class="item-details">
                            <strong>Soporte técnico basado en sistema de tickets para el primer año.</strong><br><br>
                            <strong>Mantención Preventiva:</strong><br>
                            • Actualizaciones de seguridad del software<br>
                            • Corrección de errores reportados<br>
                            • Optimizaciones de rendimiento<br>
                            • Mejoras menores de funcionalidad<br>
                            • Actualizaciones de parches y correcciones<br><br>
                            <strong>Soporte Técnico:</strong><br>
                            • Sistema de tickets integrado en la plataforma<br>
                            • Creación y seguimiento de tickets de soporte<br>
                            • Respuesta inicial en horario hábil (Lun-Vie 9:00-18:00)<br>
                            • Resolución de incidencias técnicas<br>
                            • Asesoría en uso del sistema<br>
                            • Documentación actualizada<br>
                            • Capacitación adicional si se requiere<br><br>
                            <strong>Funcionamiento del Sistema de Tickets:</strong><br>
                            • Los usuarios pueden crear tickets directamente desde el sistema<br>
                            • Cada ticket es rastreado y tiene un número único<br>
                            • Notificaciones automáticas de cambios de estado<br>
                            • Historial completo de interacciones<br>
                            • Priorización según urgencia e impacto<br>
                            • SLA de respuesta según tipo de ticket<br>
                            • Resolución garantizada según niveles de servicio<br><br>
                            <em>Este servicio puede renovarse anualmente si el cliente lo requiere.</em>
                        </div>
                    </td>
                    <td>$1.200.000</td>
                </tr>
                <tr class="subtotal-row">
                    <td colspan="2"><strong>Subtotal Mantención Primer Año</strong></td>
                    <td><strong>$1.200.000</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="total-box">
            <div>
                <div class="total-label">INVERSIÓN TOTAL</div>
                <div class="total-note">Valores no incluyen IVA</div>
            </div>
            <div style="text-align: right;">
                <div class="total-amount">$15.000.000</div>
                <div class="total-note">Pesos Chilenos (CLP)</div>
            </div>
        </div>

        <!-- Desglose del Total -->
        <div class="renewal-box">
            <h4>💰 Desglose de la Inversión</h4>
            <div class="renewal-items">
                <div class="renewal-item">
                    <div class="label">Licencia Perpetua</div>
                    <div class="value">$11.500.000</div>
                </div>
                <div class="renewal-item">
                    <div class="label">Implementación</div>
                    <div class="value">$2.300.000</div>
                </div>
                <div class="renewal-item">
                    <div class="label">Mantención 1° Año</div>
                    <div class="value">$1.200.000</div>
                </div>
            </div>
            <div class="renewal-total">
                <div class="label">Total Inversión</div>
                <div class="value">$15.000.000</div>
            </div>
        </div>

        <!-- Servicio Aparte - Hosting -->
        <div class="description-box" style="margin-top: 20px; border-left: 4px solid var(--accent);">
            <h4>☁️ Hosting y Servicios Cloud (Servicio Aparte - Opcional)</h4>
            <p style="margin-bottom: 10px;"><strong>Este servicio es independiente y se cotiza aparte de los $15.000.000.</strong></p>
            <p style="margin-bottom: 10px;">Si el cliente requiere hosting en nuestros servidores, se aplica el siguiente costo:</p>
            <table style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th style="width: 120px; text-align: right;">Valor Anual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Hosting y Servicios Cloud</strong><br>
                            • Servidor dedicado en la nube<br>
                            • Certificado SSL incluido<br>
                            • Respaldos automáticos diarios<br>
                            • Disponibilidad 99.5% garantizada<br>
                            • Monitoreo 24/7<br>
                            • Mantención de infraestructura
                        </td>
                        <td style="text-align: right; font-weight: 600;">$500.000</td>
                    </tr>
                </tbody>
            </table>
            <p style="margin-top: 10px; font-size: 9pt; color: var(--text-light);">
                <em><strong>Nota:</strong> Si el cliente instala en su propio servidor, este servicio no aplica. Este servicio puede renovarse anualmente si se requiere.</em>
            </p>
        </div>

        <!-- Nota sobre Renovaciones -->
        <div class="description-box" style="margin-top: 20px;">
            <h4>📝 Notas Importantes</h4>
            <ul>
                <li><strong>Licencia Perpetua:</strong> La licencia del software Versión 1.0 es PERPETUA. El cliente adquiere el derecho de uso permanente sin límite de tiempo.</li>
                <li><strong>Mantención:</strong> La mantención y soporte técnico del primer año está incluida. Puede renovarse anualmente si el cliente lo requiere.</li>
                <li><strong>Hosting:</strong> El servicio de hosting es independiente y se cotiza aparte. Solo aplica si el cliente requiere hosting en nuestros servidores.</li>
                <li><strong>Actualizaciones:</strong> La licencia perpetua cubre la Versión 1.0 actual. Actualizaciones mayores a versiones superiores pueden requerir licencias adicionales.</li>
                <li><strong>Proceso de Validación ante Aduana:</strong> El proceso de validación del sistema ante Aduana tiene una duración estimada de <strong>1 a 2 meses</strong>, contados desde la fecha de envío de la documentación completa. Este proceso se inicia <strong>después</strong> de completar la importación de datos operacionales del cliente, que incluye el traspaso de todos los registros históricos al nuevo sistema (TATC, TSTC, prórrogas, traspasos y otros datos). La documentación para validación se genera y envía una vez finalizada la migración de datos y la configuración inicial del sistema.</li>
            </ul>
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
                    <li>Instalación y despliegue: 3-5 días hábiles</li>
                    <li>Migración de datos: 2-5 días hábiles</li>
                    <li>Documentación Aduana: 3-5 días hábiles</li>
                    <li><strong>Total: 10-15 días hábiles</strong></li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>📋 Requisitos del Cliente</h4>
                <ul>
                    <li>Servidor con requisitos técnicos especificados</li>
                    <li>Información completa del operador</li>
                    <li>Datos históricos en formato digital</li>
                    <li>Contacto técnico designado</li>
                    <li>Logo y firma digital (alta resolución)</li>
                    <li>Acceso remoto al servidor para instalación</li>
                </ul>
            </div>
            <div class="condition-card">
                <h4>✅ SLA Garantizado</h4>
                <ul>
                    <li>Respuesta inicial tickets: <strong>4 horas hábiles</strong></li>
                    <li>Resolución crítica: <strong>24 horas</strong></li>
                    <li>Resolución normal: <strong>48 horas hábiles</strong></li>
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
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el 21 de Enero de 2025 | Cotización válida por 30 días</p>
            <p style="color: var(--primary); font-weight: 500;">www.pricergroup.com</p>
        </div>
    </div>
</body>
</html>
