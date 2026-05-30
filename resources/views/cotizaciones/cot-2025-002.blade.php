<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización COT-2025-002 - PRICER CONTENEDORES</title>
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
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
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
        
        /* Total Box */
        .total-box {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-radius: 8px;
            padding: 25px 30px;
            margin: 30px 0;
        }
        
        .total-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .total-label {
            font-size: 14pt;
            font-weight: 500;
            color: white;
        }
        
        .total-amount {
            font-size: 32pt;
            font-weight: 700;
            color: white;
        }
        
        .total-note {
            font-size: 10pt;
            opacity: 0.9;
            color: white;
        }
        
        .total-iva {
            border-top: 1px solid rgba(255,255,255,0.3);
            padding-top: 15px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .iva-details {
            font-size: 11pt;
        }
        
        .iva-total {
            font-size: 18pt;
            font-weight: 700;
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
        
        /* Highlight Box */
        .highlight-box {
            background: #e8f5e9;
            border: 2px solid #4caf50;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
        
        .highlight-box h5 {
            color: #2e7d32;
            margin-bottom: 8px;
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
                <div class="quote-number">COT-2025-002</div>
                <div class="quote-date">
                    Fecha: 09 de Febrero de 2025<br>
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
                <p><strong>CITIKOLD CHILE S.P.A.</strong></p>
                <p>RUT: 77.517.274-6</p>
                <p>Avenida El Bosque Norte 0177, piso 18, Of.1802</p>
                <p>Las Condes, Chile</p>
                <p>📞 +56 97 160 6340</p>
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

        <!-- Servicios Incluidos -->
        <h2 class="section-title"><span>2</span> Servicios Incluidos</h2>
        
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">N°</th>
                    <th>Descripción del Servicio</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="item-number">1</span></td>
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
                            <em>La licencia PERPETUA otorga el derecho de uso permanente, sin límite de tiempo.</em>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="item-number">2</span></td>
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
                </tr>
                <tr>
                    <td><span class="item-number">3</span></td>
                    <td>
                        <div class="item-title">Migración de Datos Históricos y Configuración</div>
                        <div class="item-details">
                            • Análisis y mapeo de datos históricos del sistema anterior<br>
                            • Importación de datos históricos (TATC, TSTC, contenedores)<br>
                            • Migración de prórrogas y traspasos registrados<br>
                            • Validación e integridad de datos migrados<br>
                            • Configuración del operador y datos maestros<br>
                            • Configuración de almacenes y lugares de depósito<br>
                            • Parametrización para certificación ante Aduana
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="item-number">4</span></td>
                    <td>
                        <div class="item-title">Configuración de API REST para Integración Externa</div>
                        <div class="item-details">
                            • Configuración de endpoints TATC/TSTC existentes<br>
                            • Configuración de sistema de autenticación por Token Bearer<br>
                            • Configuración de generación de PDFs vía API<br>
                            • Configuración de integración automática con HERMES<br>
                            • Entrega de documentación técnica (Swagger/OpenAPI)<br>
                            • Pruebas de integración y validación
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="item-number">5</span></td>
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
                </tr>
                <tr>
                    <td><span class="item-number">6</span></td>
                    <td>
                        <div class="item-title">Capacitación y Material de Aprendizaje</div>
                        <div class="item-details">
                            <strong>Capacitaciones Online en Vivo:</strong><br>
                            • <strong>3 sesiones de capacitación online de 1 hora cada una</strong><br>
                            • Sesión 1: Funcionamiento general del sistema y navegación<br>
                            • Sesión 2: Gestión de TATC, TSTC y operaciones con HERMES<br>
                            • Sesión 3: Reportes, consultas y administración del sistema<br>
                            • Sesiones realizadas vía Google Meet o Zoom<br>
                            • Posibilidad de grabar las sesiones para consulta posterior<br><br>
                            <strong>Tutoriales en Video:</strong><br>
                            • Biblioteca de tutoriales en video disponible directamente en la plataforma<br>
                            • Videos paso a paso de todas las funcionalidades del sistema<br>
                            • Acceso permanente desde el menú de ayuda del sistema
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><span class="item-number">7</span></td>
                    <td>
                        <div class="item-title">Mantención y Soporte Técnico (Primer Año Incluido)</div>
                        <div class="item-details">
                            <strong>Mantención Preventiva:</strong><br>
                            • Actualizaciones de seguridad del software<br>
                            • Corrección de errores reportados<br>
                            • Optimizaciones de rendimiento<br>
                            • Mejoras menores de funcionalidad<br>
                            • Actualizaciones de parches y correcciones<br><br>
                            <strong>Sistema de Tickets con Tiempos de Respuesta Garantizados:</strong><br>
                            • Sistema de tickets integrado directamente en la plataforma<br>
                            • Creación y seguimiento de tickets desde el sistema<br>
                            • Cada ticket tiene número único y trazabilidad completa<br>
                            • Notificaciones automáticas de cambios de estado<br><br>
                            <div class="highlight-box">
                                <h5>⏱️ Tiempos de Respuesta Garantizados (SLA)</h5>
                                <ul style="margin-left: 20px; margin-top: 10px;">
                                    <li><strong style="color: #c62828;">Tickets URGENTES:</strong> Respuesta dentro de las primeras <strong>2 horas hábiles</strong></li>
                                    <li><strong style="color: #f57c00;">Tickets NORMALES:</strong> Respuesta dentro de <strong>4 a 6 horas hábiles</strong></li>
                                    <li><strong>Resolución Crítica:</strong> Máximo 24 horas</li>
                                    <li><strong>Resolución Normal:</strong> Máximo 48 horas hábiles</li>
                                </ul>
                            </div>
                            • Asesoría en uso del sistema<br>
                            • Documentación actualizada<br><br>
                            <em>Este servicio puede renovarse anualmente si el cliente lo requiere.</em>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Total -->
        <div class="total-box">
            <div class="total-content">
                <div>
                    <div class="total-label">INVERSIÓN TOTAL (NETO)</div>
                </div>
                <div style="text-align: right;">
                    <div class="total-amount">$80.000.000</div>
                    <div class="total-note">Pesos Chilenos (CLP)</div>
                </div>
            </div>
            <div class="total-iva">
                <div class="iva-details">
                    <div>IVA (19%): $15.200.000</div>
                </div>
                <div>
                    <div class="iva-total">TOTAL CON IVA: $95.200.000</div>
                </div>
            </div>
        </div>

        <!-- Servicio Aparte - Hosting -->
        <div class="description-box" style="margin-top: 20px; border-left: 4px solid var(--accent);">
            <h4>☁️ Hosting y Servicios Cloud (Servicio Aparte - Opcional)</h4>
            <p style="margin-bottom: 10px;"><strong>Este servicio es independiente y se cotiza aparte.</strong></p>
            <p style="margin-bottom: 10px;">Si el cliente requiere hosting en nuestros servidores, se aplica el siguiente costo:</p>
            <table style="margin-top: 15px;">
                <thead>
                    <tr>
                        <th>Descripción</th>
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
                            • Mantención de infraestructura<br><br>
                            <em>Valor anual a convenir según requerimientos específicos.</em>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p style="margin-top: 10px; font-size: 9pt; color: var(--text-light);">
                <em><strong>Nota:</strong> Si el cliente instala en su propio servidor, este servicio no aplica.</em>
            </p>
        </div>

        <!-- Notas Importantes -->
        <div class="description-box" style="margin-top: 20px;">
            <h4>📝 Notas Importantes</h4>
            <ul>
                <li><strong>Licencia Perpetua:</strong> La licencia del software Versión 1.0 es PERPETUA. El cliente adquiere el derecho de uso permanente sin límite de tiempo.</li>
                <li><strong>Mantención:</strong> La mantención y soporte técnico del primer año está incluida. Puede renovarse anualmente si el cliente lo requiere.</li>
                <li><strong>Capacitaciones:</strong> Las 3 sesiones de capacitación online deben coordinarse dentro de los primeros 60 días desde la puesta en marcha.</li>
                <li><strong>Tutoriales en Video:</strong> Acceso permanente a la biblioteca de tutoriales desde la plataforma.</li>
                <li><strong>Hosting:</strong> El servicio de hosting es independiente y se cotiza aparte. Solo aplica si el cliente requiere hosting en nuestros servidores.</li>
                <li><strong>Actualizaciones:</strong> La licencia perpetua cubre la Versión 1.0 actual. Actualizaciones mayores a versiones superiores pueden requerir licencias adicionales.</li>
                <li><strong>Proceso de Validación ante Aduana:</strong> El proceso de validación del sistema ante Aduana tiene una duración estimada de <strong>1 a 2 meses</strong>, contados desde la fecha de envío de la documentación completa.</li>
            </ul>
        </div>

        <!-- Condiciones -->
        <h2 class="section-title"><span>3</span> Condiciones Comerciales</h2>
        
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
                    <li>Tickets URGENTES: <strong>2 horas</strong></li>
                    <li>Tickets NORMALES: <strong>4-6 horas</strong></li>
                    <li>Resolución crítica: <strong>24 horas</strong></li>
                    <li>Resolución normal: <strong>48 horas hábiles</strong></li>
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
            <div class="logo-container" style="display: inline-block; margin-bottom: 10px;">
                <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contendores-ng.jpeg" alt="Pricer Contenedores" style="height: 55px;">
            </div>
            <p><strong>PRICER CONTENEDORES SPA</strong></p>
            <p>Gestión de Contenedores para Aduana de Chile</p>
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el 09 de Febrero de 2025 | Cotización válida por 30 días</p>
            <p style="color: var(--primary); font-weight: 500;">www.pricergroup.com</p>
        </div>
    </div>
</body>
</html>
