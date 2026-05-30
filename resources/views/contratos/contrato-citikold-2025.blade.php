<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Prestación de Servicios - PRICER SPA / CITIKOLD CHILE S.P.A.</title>
    <style>
        :root {
            --primary: #FD5523;
            --accent: #2d3748;
            --text-dark: #1a202c;
            --text-light: #4a5568;
            --bg-light: #f7fafc;
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
            line-height: 1.7;
            color: var(--text-dark);
            background: #fff;
        }
        
        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 20mm 25mm;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary);
        }
        
        .header h1 {
            font-size: 18pt;
            color: var(--accent);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            font-size: 12pt;
            color: var(--text-light);
            font-weight: normal;
        }
        
        .parties {
            text-align: center;
            margin: 25px 0;
            padding: 20px;
            background: var(--bg-light);
            border-radius: 8px;
        }
        
        .parties h3 {
            font-size: 11pt;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .parties p {
            font-size: 10pt;
            color: var(--text-light);
        }
        
        .intro {
            text-align: justify;
            margin: 25px 0;
        }
        
        .clause {
            margin: 25px 0;
            text-align: justify;
        }
        
        .clause h3 {
            font-size: 12pt;
            color: var(--accent);
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--border);
            text-transform: uppercase;
        }
        
        .clause p {
            margin-bottom: 10px;
        }
        
        .clause ul, .clause ol {
            margin-left: 25px;
            margin-bottom: 10px;
        }
        
        .clause li {
            margin-bottom: 8px;
        }
        
        .sub-clause {
            margin: 15px 0 15px 20px;
        }
        
        .sub-clause h4 {
            font-size: 11pt;
            color: var(--primary);
            margin-bottom: 8px;
        }
        
        .highlight-box {
            background: #fff8f6;
            border-left: 4px solid var(--primary);
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .services-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 10pt;
        }
        
        .services-table th {
            background: var(--primary);
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 9pt;
            text-transform: uppercase;
        }
        
        .services-table td {
            padding: 10px;
            border-bottom: 1px solid var(--border);
            vertical-align: top;
        }
        
        .services-table tr:nth-child(even) {
            background: var(--bg-light);
        }
        
        .total-box {
            background: linear-gradient(135deg, var(--primary) 0%, #ff7a50 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            text-align: center;
        }
        
        .total-box .amount {
            font-size: 24pt;
            font-weight: bold;
        }
        
        .total-box .label {
            font-size: 10pt;
            opacity: 0.9;
        }
        
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            padding-top: 30px;
        }
        
        .signature-box {
            width: 45%;
            text-align: center;
        }
        
        .signature-line {
            border-top: 1px solid var(--text-dark);
            margin-top: 80px;
            padding-top: 10px;
            font-size: 10pt;
        }
        
        .signature-box h4 {
            font-size: 10pt;
            color: var(--primary);
            margin-bottom: 5px;
        }
        
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            font-size: 8pt;
            color: var(--text-light);
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .anexo-header {
            background: var(--accent);
            color: white;
            padding: 15px;
            text-align: center;
            margin: 30px 0 20px;
            border-radius: 8px;
        }
        
        .anexo-header h2 {
            font-size: 14pt;
            margin: 0;
        }
        
        @media print {
            .container {
                padding: 15mm 20mm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado -->
        <div class="header">
            <h1>Contrato de Prestación de Servicios</h1>
            <h2>Condiciones Generales para la Prestación de Servicios de Software</h2>
        </div>

        <!-- Partes -->
        <div class="parties">
            <h3>ENTRE</h3>
            <p><strong>PRICER SPA</strong></p>
            <p>Y</p>
            <p><strong>CITIKOLD CHILE S.P.A.</strong></p>
        </div>

        <!-- Introducción -->
        <div class="intro">
            <p>En Santiago de Chile, a {{ date('d') }} de {{ strftime('%B') }} de {{ date('Y') }}, entre:</p>
            
            <p style="margin: 15px 0;"><strong>a)</strong> <strong>PRICER SPA</strong>, sociedad del giro de servicios tecnológicos y desarrollo de software, RUT N° <strong>76.566.636-8</strong>, domiciliada en Av. El Retiro 1227, Bodega 163, Renca, Santiago, Chile (en adelante e indistintamente, el "<strong>Prestador de Servicios</strong>" o "<strong>Proveedor</strong>"), por una parte; y por la otra;</p>
            
            <p style="margin: 15px 0;"><strong>b)</strong> <strong>CITIKOLD CHILE S.P.A.</strong>, sociedad del giro de servicios logísticos y contenedores, RUT N° <strong>77.517.274-6</strong>, domiciliada en Avenida El Bosque Norte 0177, piso 18, Of. 1802, Las Condes, Santiago, Chile, teléfono +56 97 160 6340 (en adelante, el "<strong>Cliente</strong>"); y ambas conjuntamente denominadas como las "<strong>Partes</strong>", expresan que han convenido en las siguientes <strong>CONDICIONES GENERALES PARA LA PRESTACIÓN DE SERVICIOS</strong>:</p>
        </div>

        <!-- CLÁUSULA PRIMERA -->
        <div class="clause">
            <h3>PRIMERO. Antecedentes</h3>
            <p><strong>1.1.</strong> Que el Cliente está interesado en la contratación del servicio integral de la plataforma tecnológica denominada "<strong>CONTENEDORES PRICER</strong>", sistema de gestión de contenedores bajo el régimen de admisión temporal ante la Aduana de Chile, incluyendo integración con el sistema <strong>HERMES</strong>.</p>
            <p><strong>1.2.</strong> Que el Proveedor es una empresa especializada en desarrollo de software y soluciones tecnológicas para la gestión aduanera y logística.</p>
            <p><strong>1.3.</strong> Que las partes están interesadas en celebrar un contrato de prestación de servicios, en virtud del cual el Proveedor otorgue al Cliente el derecho de uso perpetuo del sistema y entregue soporte y asistencia en el uso del mismo.</p>
        </div>

        <!-- CLÁUSULA SEGUNDA -->
        <div class="clause">
            <h3>SEGUNDO. Objeto del Contrato</h3>
            <p><strong>2.1.</strong> Por el presente instrumento, el Cliente le encarga al Prestador de Servicios, quien acepta, la prestación de los servicios especificados en el <strong>Anexo N° 1 - Condiciones Particulares de Prestación de Servicios</strong>, en los términos y condiciones indicados en este instrumento (en adelante el "<strong>Servicio</strong>").</p>
            <p><strong>2.2.</strong> Las presentes CONDICIONES GENERALES PARA LA PRESTACIÓN DE SERVICIOS en conjunto con el ANEXO N° 1 - CONDICIONES PARTICULARES DE PRESTACIÓN DE SERVICIOS y los demás Anexos del presente contrato, forman un documento único para todos los efectos legales a que haya lugar (en adelante el "<strong>Contrato</strong>").</p>
        </div>

        <!-- CLÁUSULA TERCERA -->
        <div class="clause">
            <h3>TERCERO. Precio, Facturación y Forma de Pago</h3>
            <p>Las partes acuerdan que el precio a pagar por el Servicio será el indicado en el Anexo N° 1. El precio total asciende a:</p>
            
            <div class="total-box">
                <div class="label">PRECIO TOTAL NETO</div>
                <div class="amount">$80.000.000 CLP</div>
                <div class="label" style="margin-top: 10px;">IVA (19%): $15.200.000 | TOTAL CON IVA: $95.200.000 CLP</div>
            </div>
            
            <p><strong>3.1.</strong> El pago se realizará de la siguiente forma:</p>
            <ul>
                <li><strong>50% ($40.000.000 + IVA)</strong> al momento de la aceptación del presente contrato.</li>
                <li><strong>50% ($40.000.000 + IVA)</strong> contra entrega y puesta en marcha del sistema.</li>
            </ul>
            <p><strong>3.2.</strong> Los pagos deberán realizarse mediante transferencia bancaria electrónica a la cuenta que el Prestador de Servicios indique en la factura correspondiente.</p>
        </div>

        <!-- CLÁUSULA CUARTA -->
        <div class="clause">
            <h3>CUARTO. Impuestos</h3>
            <p>Los impuestos, derechos, cargos e imposiciones que se relacionen, directa o indirectamente, con este Contrato serán de cargo de cada parte, según corresponda. Los valores y precios expresados en el presente Contrato y sus anexos no incluyen tributos y cargas asociados, tales como el IVA, el cual será agregado a cada factura según la legislación vigente.</p>
        </div>

        <!-- CLÁUSULA QUINTA -->
        <div class="clause">
            <h3>QUINTO. Obligaciones del Prestador de Servicios</h3>
            <p>Por medio del presente instrumento, el Prestador de Servicios se obliga a lo siguiente:</p>
            <ol type="a">
                <li><strong>Licencia de Software:</strong> Otorgar al Cliente una licencia PERPETUA de uso del software "CONTENEDORES PRICER" versión 1.0, incluyendo el código fuente.</li>
                <li><strong>Instalación:</strong> Realizar la instalación y despliegue del software en el servidor designado por el Cliente.</li>
                <li><strong>Migración de Datos:</strong> Realizar la migración completa de datos históricos del sistema anterior del Cliente (TATC, TSTC, prórrogas, traspasos y otros registros).</li>
                <li><strong>Configuración:</strong> Configurar el sistema según los requerimientos del Cliente, incluyendo la integración con HERMES y la API REST.</li>
                <li><strong>Capacitación:</strong> Proveer 3 sesiones de capacitación online de 1 hora cada una, además de tutoriales en video accesibles desde la plataforma.</li>
                <li><strong>Documentación:</strong> Entregar toda la documentación técnica y manuales de usuario necesarios para la validación ante Aduana.</li>
                <li><strong>Soporte:</strong> Prestar servicio de mantención y soporte técnico durante el primer año, mediante sistema de tickets con los tiempos de respuesta acordados.</li>
                <li><strong>Calidad:</strong> Prestar el Servicio utilizando personal idóneo y calificado, de acuerdo con las necesidades del Cliente y lo establecido en el presente Contrato.</li>
            </ol>
        </div>

        <!-- CLÁUSULA SEXTA -->
        <div class="clause">
            <h3>SEXTO. Obligaciones del Cliente</h3>
            <p>Por el presente instrumento, el Cliente se obliga para con el Prestador de Servicios a:</p>
            <ol type="a">
                <li>Pagar íntegra y oportunamente el precio estipulado por los Servicios conforme con lo establecido en el presente Contrato.</li>
                <li>Proveer un servidor con los requisitos técnicos especificados por el Prestador de Servicios.</li>
                <li>Entregar toda la información necesaria para la migración de datos y configuración del sistema.</li>
                <li>Designar un contacto técnico responsable para la coordinación del proyecto.</li>
                <li>Proporcionar acceso remoto al servidor para la instalación y mantención del software.</li>
                <li>Mantener las condiciones necesarias para que el Prestador de Servicios pueda cumplir con sus obligaciones.</li>
            </ol>
        </div>

        <!-- CLÁUSULA SÉPTIMA -->
        <div class="clause">
            <h3>SÉPTIMO. Plazo de Implementación</h3>
            <p><strong>7.1.</strong> El plazo estimado para la implementación completa del sistema es de <strong>10 a 15 días hábiles</strong>, distribuidos de la siguiente manera:</p>
            <ul>
                <li>Instalación y despliegue: 3-5 días hábiles</li>
                <li>Migración de datos: 2-5 días hábiles</li>
                <li>Documentación para Aduana: 3-5 días hábiles</li>
            </ul>
            <p><strong>7.2.</strong> Las capacitaciones deberán coordinarse dentro de los primeros 60 días desde la puesta en marcha del sistema.</p>
            <p><strong>7.3.</strong> El proceso de validación ante Aduana tiene una duración estimada de 1 a 2 meses, contados desde la fecha de envío de la documentación completa.</p>
        </div>

        <!-- CLÁUSULA OCTAVA -->
        <div class="clause">
            <h3>OCTAVO. Acuerdo de Nivel de Servicio (SLA)</h3>
            <p><strong>8.1.</strong> El Prestador de Servicios se compromete a los siguientes tiempos de respuesta para el sistema de tickets:</p>
            
            <div class="highlight-box">
                <ul>
                    <li><strong>Tickets URGENTES:</strong> Respuesta dentro de las primeras <strong>2 horas hábiles</strong></li>
                    <li><strong>Tickets NORMALES:</strong> Respuesta dentro de <strong>4 a 6 horas hábiles</strong></li>
                    <li><strong>Resolución Crítica:</strong> Máximo <strong>24 horas</strong></li>
                    <li><strong>Resolución Normal:</strong> Máximo <strong>48 horas hábiles</strong></li>
                </ul>
            </div>
            
            <p><strong>8.2.</strong> Las averías o el mal funcionamiento del sistema se comunicarán al Prestador de Servicios a través del sistema de tickets integrado en la plataforma.</p>
        </div>

        <!-- CLÁUSULA NOVENA -->
        <div class="clause">
            <h3>NOVENO. Relación entre las Partes</h3>
            <p>El Prestador de Servicios declara tener la capacidad para prestar el Servicio de manera autónoma e independiente y que nada en este contrato es constitutivo de una relación societaria entre las Partes. Las Partes declaran que el Cliente no tiene ni tendrá vínculo de subordinación o dependencia ni responsabilidad alguna, de carácter laboral ni de cualquier otro orden respecto de los trabajadores del Prestador de Servicios.</p>
        </div>

        <!-- CLÁUSULA DÉCIMA -->
        <div class="clause">
            <h3>DÉCIMO. Vigencia y Término del Contrato</h3>
            <p><strong>10.1.</strong> La licencia del software otorgada es de carácter <strong>PERPETUO</strong>, por lo que el Cliente adquiere el derecho de uso permanente del software versión 1.0, sin límite de tiempo.</p>
            <p><strong>10.2.</strong> El servicio de mantención y soporte técnico incluido tiene una vigencia de <strong>12 meses</strong> desde la puesta en marcha del sistema, pudiendo renovarse anualmente según acuerdo de las partes.</p>
            <p><strong>10.3.</strong> En caso de incumplimiento de una parte de cualquiera de las obligaciones establecidas en el presente Contrato, la otra parte quedará facultada para poner término al mismo en forma inmediata, bastando para ello una notificación por escrito.</p>
        </div>

        <!-- CLÁUSULA DÉCIMO PRIMERA -->
        <div class="clause">
            <h3>DÉCIMO PRIMERO. Confidencialidad y Protección de Datos</h3>
            <p><strong>11.1.</strong> El Prestador de Servicios se obliga a mantener las condiciones y términos de este Contrato en reserva, no pudiendo dar a conocer su existencia y términos a ningún tercero ajeno al mismo, salvo consentimiento previo del Cliente.</p>
            <p><strong>11.2.</strong> La información perteneciente a la base de datos del Cliente es confidencial y de su propiedad, y el Proveedor nunca publicará ni hará uso de ella mencionando o comentando puntualmente alguno de estos registros.</p>
            <p><strong>11.3.</strong> Las Partes se obligan a mantener en estricta confidencialidad y a no revelar a ningún tercero, cualquier información sensible, comercial, financiera o técnica que sea compartida con motivo del presente Contrato.</p>
        </div>

        <!-- CLÁUSULA DÉCIMO SEGUNDA -->
        <div class="clause">
            <h3>DÉCIMO SEGUNDO. Propiedad Intelectual e Industrial</h3>
            <p><strong>12.1.</strong> El Prestador de Servicios posee los derechos de propiedad intelectual e industrial del software "CONTENEDORES PRICER", incluyendo pero no limitado a: nombre del sistema, interfaz de usuario, códigos fuente, algoritmos y documentación.</p>
            <p><strong>12.2.</strong> Con la adquisición de la licencia perpetua, el Cliente recibe el código fuente de la versión 1.0 del software para su uso interno. El Cliente no podrá comercializar, sublicenciar o distribuir el software a terceros.</p>
            <p><strong>12.3.</strong> El Cliente será el único responsable por la información y contenido ingresado al sistema.</p>
        </div>

        <!-- CLÁUSULA DÉCIMO TERCERA -->
        <div class="clause">
            <h3>DÉCIMO TERCERO. Caso Fortuito o Fuerza Mayor</h3>
            <p>Ninguna falla, atraso u omisión para llevar a cabo u observar cualquiera de los términos y estipulaciones del presente Contrato dará lugar a reclamo de alguna de las partes contra la otra, si aquella es causada o surge por motivos de Fuerza Mayor o Caso Fortuito, tales como: terremotos, incendios, inundaciones, epidemias, actos de autoridad, guerra civil, insurrecciones o cualquier otro evento imprevisto al que no es posible resistir.</p>
        </div>

        <!-- CLÁUSULA DÉCIMO CUARTA -->
        <div class="clause">
            <h3>DÉCIMO CUARTO. Notificaciones</h3>
            <p>Para todos los efectos legales y convencionales derivados de este contrato, los avisos y notificaciones que deban efectuarse por o a las partes, se entenderán válidamente cumplidos si se dirigen a:</p>
            
            <div class="highlight-box">
                <p><strong>Por parte del Cliente:</strong><br>
                CITIKOLD CHILE S.P.A.<br>
                Avenida El Bosque Norte 0177, piso 18, Of. 1802, Las Condes<br>
                Teléfono: +56 97 160 6340</p>
            </div>
            
            <div class="highlight-box">
                <p><strong>Por parte del Prestador de Servicios:</strong><br>
                PRICER SPA<br>
                Av. El Retiro 1227, Bodega 163, Renca, Santiago<br>
                Email: contacto@pricergroup.com</p>
            </div>
        </div>

        <!-- CLÁUSULA DÉCIMO QUINTA -->
        <div class="clause">
            <h3>DÉCIMO QUINTO. Legislación Aplicable y Resolución de Conflictos</h3>
            <p><strong>15.1.</strong> Todas las dudas y dificultades que se susciten entre las Partes con motivo del presente Contrato y sus anexos, serán resueltas por los Tribunales Ordinarios de Justicia.</p>
            <p><strong>15.2.</strong> Para todos los efectos que se deriven de este Contrato, las partes fijan su domicilio en la ciudad y comuna de Santiago, Chile.</p>
        </div>

        <!-- CLÁUSULA DÉCIMO SEXTA -->
        <div class="clause">
            <h3>DÉCIMO SEXTO. Copias</h3>
            <p>El presente documento se suscribe en dos copias quedando una en poder de cada una de las Partes. El presente documento contiene las CONDICIONES GENERALES PARA LA PRESTACIÓN DE SERVICIOS, las cuales se entienden aceptadas por el Cliente por el hecho de firmar el presente instrumento junto con el Anexo N° 1.</p>
        </div>

        <!-- Firmas -->
        <div class="signatures">
            <div class="signature-box">
                <h4>POR EL CLIENTE</h4>
                <div class="signature-line">
                    <strong>CITIKOLD CHILE S.P.A.</strong><br>
                    RUT: 77.517.274-6<br>
                    Nombre: _______________________<br>
                    Cargo: _______________________
                </div>
            </div>
            <div class="signature-box">
                <h4>POR EL PRESTADOR DE SERVICIOS</h4>
                <div class="signature-line">
                    <strong>PRICER SPA</strong><br>
                    RUT: 76.566.636-8<br>
                    Representante Legal
                </div>
            </div>
        </div>

        <!-- ANEXO 1 -->
        <div class="page-break"></div>
        
        <div class="anexo-header">
            <h2>ANEXO N° 1 - CONDICIONES PARTICULARES DE PRESTACIÓN DE SERVICIOS</h2>
        </div>

        <div class="parties">
            <p>Contrato de Prestación de Servicios entre</p>
            <p><strong>PRICER SPA</strong> y <strong>CITIKOLD CHILE S.P.A.</strong></p>
        </div>

        <div class="clause">
            <h3>PRIMERO. Descripción de los Servicios Contratados</h3>
            <p>Por el presente instrumento, el Cliente contrata el servicio integral de la plataforma "<strong>CONTENEDORES PRICER</strong>", que consiste en un sistema de gestión de contenedores bajo el régimen de admisión temporal ante la Aduana de Chile.</p>
            
            <p style="margin-top: 15px;">El Servicio incluye los siguientes componentes:</p>
            
            <table class="services-table">
                <thead>
                    <tr>
                        <th style="width: 40px;">N°</th>
                        <th>Descripción del Servicio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>1</strong></td>
                        <td>
                            <strong>Licencia PERPETUA del Software CONTENEDORES PRICER</strong><br>
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
                            • Documentación técnica completa
                        </td>
                    </tr>
                    <tr>
                        <td><strong>2</strong></td>
                        <td>
                            <strong>Instalación y Despliegue en Servidor del Cliente</strong><br>
                            • Análisis de infraestructura y requisitos del servidor<br>
                            • Instalación del software CONTENEDORES PRICER<br>
                            • Configuración del servidor web (Apache/Nginx)<br>
                            • Configuración de base de datos (MySQL/MariaDB)<br>
                            • Configuración de PHP y extensiones necesarias<br>
                            • Configuración de certificados SSL<br>
                            • Optimización de rendimiento y seguridad<br>
                            • Documentación técnica de la instalación
                        </td>
                    </tr>
                    <tr>
                        <td><strong>3</strong></td>
                        <td>
                            <strong>Migración de Datos Históricos y Configuración</strong><br>
                            • Análisis y mapeo de datos históricos del sistema anterior<br>
                            • Importación de datos históricos (TATC, TSTC, contenedores)<br>
                            • Migración de prórrogas y traspasos registrados<br>
                            • Validación e integridad de datos migrados<br>
                            • Configuración del operador y datos maestros<br>
                            • Configuración de almacenes y lugares de depósito<br>
                            • Parametrización para certificación ante Aduana
                        </td>
                    </tr>
                    <tr>
                        <td><strong>4</strong></td>
                        <td>
                            <strong>Configuración de API REST para Integración Externa</strong><br>
                            • Configuración de endpoints TATC/TSTC<br>
                            • Configuración de sistema de autenticación por Token Bearer<br>
                            • Configuración de generación de PDFs vía API<br>
                            • Configuración de integración automática con HERMES<br>
                            • Entrega de documentación técnica (Swagger/OpenAPI)<br>
                            • Pruebas de integración y validación
                        </td>
                    </tr>
                    <tr>
                        <td><strong>5</strong></td>
                        <td>
                            <strong>Generación de Archivos para Validación ante Aduana</strong><br>
                            • Generación de documentación técnica del sistema<br>
                            • Manuales de usuario de todos los módulos<br>
                            • Procedimientos de operación del sistema<br>
                            • Procedimientos de respaldo de información<br>
                            • Procedimientos de cambio de claves<br>
                            • Evidencias de respaldos y rutinas<br>
                            • Documentación de integración HERMES<br>
                            • Preparación de archivos para presentación ante Aduana
                        </td>
                    </tr>
                    <tr>
                        <td><strong>6</strong></td>
                        <td>
                            <strong>Capacitación y Material de Aprendizaje</strong><br>
                            <em>Capacitaciones Online en Vivo:</em><br>
                            • 3 sesiones de capacitación online de 1 hora cada una<br>
                            • Sesión 1: Funcionamiento general del sistema y navegación<br>
                            • Sesión 2: Gestión de TATC, TSTC y operaciones con HERMES<br>
                            • Sesión 3: Reportes, consultas y administración del sistema<br>
                            • Sesiones realizadas vía Google Meet o Zoom<br>
                            • Posibilidad de grabar las sesiones para consulta posterior<br><br>
                            <em>Tutoriales en Video:</em><br>
                            • Biblioteca de tutoriales en video disponible directamente en la plataforma<br>
                            • Videos paso a paso de todas las funcionalidades del sistema<br>
                            • Acceso permanente desde el menú de ayuda del sistema
                        </td>
                    </tr>
                    <tr>
                        <td><strong>7</strong></td>
                        <td>
                            <strong>Mantención y Soporte Técnico (Primer Año Incluido)</strong><br>
                            <em>Mantención Preventiva:</em><br>
                            • Actualizaciones de seguridad del software<br>
                            • Corrección de errores reportados<br>
                            • Optimizaciones de rendimiento<br>
                            • Mejoras menores de funcionalidad<br>
                            • Actualizaciones de parches y correcciones<br><br>
                            <em>Sistema de Tickets:</em><br>
                            • Sistema de tickets integrado directamente en la plataforma<br>
                            • Creación y seguimiento de tickets desde el sistema<br>
                            • Tickets URGENTES: Respuesta en 2 horas hábiles<br>
                            • Tickets NORMALES: Respuesta en 4-6 horas hábiles<br>
                            • Resolución crítica: 24 horas<br>
                            • Resolución normal: 48 horas hábiles
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clause">
            <h3>SEGUNDO. Prestaciones Excluidas</h3>
            <p><strong>2.1.</strong> Las Partes dejan constancia que los siguientes servicios se encuentran expresamente excluidos del presente Contrato:</p>
            <ul>
                <li>Hosting y servicios de infraestructura en la nube (servicio opcional cotizado aparte)</li>
                <li>Actualizaciones mayores a versiones superiores del software (versiones 2.0 en adelante)</li>
                <li>Desarrollo de nuevas funcionalidades no contempladas en la versión 1.0</li>
                <li>Mantención de hardware o equipos del Cliente</li>
                <li>Servicio de soporte después del primer año (renovable)</li>
            </ul>
            <p><strong>2.2.</strong> El Prestador de Servicios no se hará responsable en caso de que un tercero irrumpiera en los servidores del Cliente, y esto se tradujera en pérdida o eliminación de información.</p>
        </div>

        <div class="clause">
            <h3>TERCERO. Precio del Servicio</h3>
            <p><strong>3.1.</strong> Por los Servicios que por este instrumento se contratan, el Prestador de Servicios tendrá derecho a percibir una suma equivalente a <strong>OCHENTA MILLONES DE PESOS CHILENOS ($80.000.000 CLP)</strong>, más IVA.</p>
            
            <div class="total-box">
                <div class="label">PRECIO NETO</div>
                <div class="amount">$80.000.000 CLP</div>
                <div class="label" style="margin-top: 5px;">IVA (19%): $15.200.000 CLP</div>
                <div class="label"><strong>TOTAL CON IVA: $95.200.000 CLP</strong></div>
            </div>
            
            <p><strong>3.2.</strong> El precio se pagará en 2 (dos) cuotas de la siguiente manera:</p>
            <ol type="a">
                <li>Un anticipo ascendente al <strong>50%</strong> del precio ($40.000.000 + IVA = $47.600.000) que se pagará al momento de la aceptación del presente Contrato.</li>
                <li>El saldo restante del <strong>50%</strong> del precio ($40.000.000 + IVA = $47.600.000) será pagado contra entrega y puesta en marcha del sistema.</li>
            </ol>
        </div>

        <div class="clause">
            <h3>CUARTO. Requisitos Técnicos del Servidor</h3>
            <p>El Cliente deberá proveer un servidor que cumpla con los siguientes requisitos mínimos:</p>
            <ul>
                <li>Sistema Operativo: Linux (Ubuntu 20.04+ o CentOS 8+)</li>
                <li>Procesador: 2 cores mínimo</li>
                <li>Memoria RAM: 4 GB mínimo</li>
                <li>Almacenamiento: 50 GB mínimo</li>
                <li>PHP 8.1 o superior</li>
                <li>MySQL 8.0 o MariaDB 10.5+</li>
                <li>Certificado SSL válido</li>
                <li>Acceso SSH para instalación</li>
            </ul>
        </div>

        <!-- Firmas Anexo -->
        <div class="signatures">
            <div class="signature-box">
                <h4>POR EL CLIENTE</h4>
                <div class="signature-line">
                    <strong>CITIKOLD CHILE S.P.A.</strong><br>
                    RUT: 77.517.274-6
                </div>
            </div>
            <div class="signature-box">
                <h4>POR EL PRESTADOR DE SERVICIOS</h4>
                <div class="signature-line">
                    <strong>PRICER SPA</strong><br>
                    RUT: 76.566.636-8
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>CONTRATO DE PRESTACIÓN DE SERVICIOS</strong></p>
            <p>PRICER SPA - CITIKOLD CHILE S.P.A.</p>
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el {{ date('d/m/Y') }}</p>
        </div>
    </div>
</body>
</html>
