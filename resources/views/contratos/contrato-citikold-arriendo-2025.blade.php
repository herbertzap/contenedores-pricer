<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Prestacion de Servicios - PRICER SPA / CITIKOLD CHILE S.P.A.</title>
    <style>
        :root {
            --primary: #FD5523;
            --accent: #2d3748;
            --text-dark: #1a202c;
            --text-light: #4a5568;
            --bg-light: #f7fafc;
            --border: #e2e8f0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 11pt;
            line-height: 1.7;
            color: var(--text-dark);
            background: #fff;
        }
        .container { max-width: 210mm; margin: 0 auto; padding: 20mm 25mm; }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--primary);
        }
        .header h1 { font-size: 18pt; color: var(--accent); margin-bottom: 10px; text-transform: uppercase; }
        .header h2 { font-size: 12pt; color: var(--text-light); font-weight: normal; }
        .parties { text-align: center; margin: 25px 0; padding: 20px; background: var(--bg-light); border-radius: 8px; }
        .parties h3 { font-size: 11pt; color: var(--primary); margin-bottom: 5px; }
        .intro { text-align: justify; margin: 25px 0; }
        .clause { margin: 25px 0; text-align: justify; }
        .clause h3 {
            font-size: 12pt;
            color: var(--accent);
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 1px solid var(--border);
            text-transform: uppercase;
        }
        .clause p { margin-bottom: 10px; }
        .clause ul, .clause ol { margin-left: 25px; margin-bottom: 10px; }
        .clause li { margin-bottom: 8px; }
        .highlight-box {
            background: #fff8f6;
            border-left: 4px solid var(--primary);
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 8px 8px 0;
        }
        .services-table { width: 100%; border-collapse: collapse; margin: 15px 0; font-size: 10pt; }
        .services-table th {
            background: var(--primary);
            color: white;
            padding: 10px;
            text-align: left;
            font-size: 9pt;
            text-transform: uppercase;
        }
        .services-table th:last-child { text-align: right; }
        .services-table td { padding: 10px; border-bottom: 1px solid var(--border); vertical-align: top; }
        .services-table td:last-child { text-align: right; font-weight: 500; white-space: nowrap; }
        .services-table tr:nth-child(even) { background: var(--bg-light); }
        .subtotal-row { background: #fff0ec !important; }
        .subtotal-row td { font-weight: 600; color: var(--primary); border-top: 2px solid var(--primary); }
        .total-box {
            background: linear-gradient(135deg, var(--primary) 0%, #ff7a50 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-box .amount { font-size: 24pt; font-weight: bold; }
        .total-box .label { font-size: 10pt; opacity: 0.9; }
        .renewal-box {
            background: #fff8f6;
            border: 2px dashed var(--primary);
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .renewal-box h4 { color: var(--primary); margin-bottom: 10px; }
        .renewal-box .value { font-size: 18pt; font-weight: 700; color: var(--accent); }
        .signatures { display: flex; justify-content: space-between; margin-top: 60px; padding-top: 30px; }
        .signature-box { width: 45%; text-align: center; }
        .signature-line { border-top: 1px solid var(--text-dark); margin-top: 80px; padding-top: 10px; font-size: 10pt; }
        .signature-box h4 { font-size: 10pt; color: var(--primary); margin-bottom: 5px; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid var(--border); font-size: 8pt; color: var(--text-light); }
        .page-break { page-break-before: always; }
        .anexo-header { background: var(--accent); color: white; padding: 15px; text-align: center; margin: 30px 0 20px; border-radius: 8px; }
        .anexo-header h2 { font-size: 14pt; margin: 0; }
        @media print { .container { padding: 15mm 20mm; } }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contrato de Prestacion de Servicios</h1>
            <h2>Licencia de Uso de Software - Modalidad Arriendo Anual</h2>
        </div>

        <div class="parties">
            <h3>ENTRE</h3>
            <p><strong>PRICER SPA</strong></p>
            <p>Y</p>
            <p><strong>CITIKOLD CHILE S.P.A.</strong></p>
        </div>

        <div class="intro">
            <p>En Santiago de Chile, a 09 de Febrero de 2025, entre:</p>
            <p style="margin: 15px 0;"><strong>a)</strong> <strong>PRICER SPA</strong>, sociedad del giro de servicios tecnologicos y desarrollo de software, RUT N 76.566.636-8, domiciliada en Av. El Retiro 1227, Bodega 163, Renca, Santiago, Chile (en adelante el "Prestador de Servicios" o "Proveedor"), por una parte; y por la otra;</p>
            <p style="margin: 15px 0;"><strong>b)</strong> <strong>CITIKOLD CHILE S.P.A.</strong>, sociedad del giro de servicios logisticos y contenedores, RUT N 77.517.274-6, domiciliada en Avenida El Bosque Norte 0177, piso 18, Of. 1802, Las Condes, Santiago, Chile, telefono +56 97 160 6340 (en adelante, el "Cliente"); y ambas conjuntamente denominadas como las "Partes", expresan que han convenido en las siguientes CONDICIONES GENERALES PARA LA PRESTACION DE SERVICIOS:</p>
        </div>

        <div class="clause">
            <h3>PRIMERO. Antecedentes</h3>
            <p><strong>1.1.</strong> Que el Cliente esta interesado en la contratacion del servicio de acceso y uso de la plataforma tecnologica denominada "CONTENEDORES PRICER", sistema de gestion de contenedores bajo el regimen de admision temporal ante la Aduana de Chile, incluyendo integracion con el sistema HERMES.</p>
            <p><strong>1.2.</strong> Que el Proveedor es una empresa especializada en desarrollo de software y soluciones tecnologicas para la gestion aduanera y logistica.</p>
            <p><strong>1.3.</strong> Que las partes estan interesadas en celebrar un contrato de prestacion de servicios bajo la modalidad de LICENCIA DE USO ANUAL.</p>
        </div>

        <div class="clause">
            <h3>SEGUNDO. Objeto del Contrato</h3>
            <p><strong>2.1.</strong> Por el presente instrumento, el Cliente le encarga al Prestador de Servicios, quien acepta, la prestacion de los servicios especificados en el Anexo N 1 - Condiciones Particulares de Prestacion de Servicios.</p>
            <p><strong>2.2.</strong> El Servicio consiste en el otorgamiento de una LICENCIA DE USO ANUAL del software "CONTENEDORES PRICER", junto con los servicios asociados de implementacion, mantencion, soporte tecnico y hosting en la nube.</p>
        </div>

        <div class="clause">
            <h3>TERCERO. Precio, Facturacion y Forma de Pago</h3>
            <p><strong>3.1.</strong> Las partes acuerdan que el precio a pagar por el Servicio durante el PRIMER ANO sera el siguiente:</p>
            
            <table class="services-table">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Valor (CLP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Servicios de Implementacion (Pago Unico)</strong></td>
                        <td>$850.000</td>
                    </tr>
                    <tr>
                        <td><strong>Licencia de Uso del Sistema (Anual)</strong></td>
                        <td>$1.800.000</td>
                    </tr>
                    <tr>
                        <td><strong>Mantencion y Soporte Tecnico (Anual)</strong></td>
                        <td>$450.000</td>
                    </tr>
                    <tr>
                        <td><strong>Hosting y Servicios Cloud (Anual)</strong></td>
                        <td>$390.000</td>
                    </tr>
                    <tr class="subtotal-row">
                        <td><strong>TOTAL PRIMER ANO (Neto)</strong></td>
                        <td><strong>$3.490.000</strong></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="total-box">
                <div>
                    <div class="label">INVERSION PRIMER ANO (NETO)</div>
                    <div class="label" style="margin-top: 5px;">+ IVA (19%): $663.100</div>
                </div>
                <div style="text-align: right;">
                    <div class="amount">$3.490.000</div>
                    <div class="label">TOTAL CON IVA: $4.153.100</div>
                </div>
            </div>
            
            <p><strong>3.2.</strong> El pago del primer ano se realizara de la siguiente forma:</p>
            <ul>
                <li><strong>50%</strong> al momento de la aceptacion del presente contrato.</li>
                <li><strong>50%</strong> contra entrega y puesta en marcha del sistema.</li>
            </ul>
        </div>

        <div class="clause">
            <h3>CUARTO. Renovacion Anual</h3>
            <p><strong>4.1.</strong> A partir del segundo ano, el Cliente debera pagar unicamente los servicios recurrentes:</p>
            
            <div class="renewal-box">
                <h4>Renovacion Anual (2do ano en adelante)</h4>
                <div class="value">$2.640.000 + IVA</div>
                <p style="font-size: 9pt; color: #718096; margin-top: 5px;">($3.142.400 con IVA)</p>
            </div>
            
            <p><strong>4.2.</strong> La renovacion se facturara anualmente, con vencimiento en la fecha de aniversario del contrato.</p>
        </div>

        <div class="clause">
            <h3>QUINTO. Obligaciones del Prestador de Servicios</h3>
            <ol type="a">
                <li><strong>Licencia de Uso:</strong> Otorgar al Cliente una licencia de uso del software durante la vigencia del contrato.</li>
                <li><strong>Implementacion:</strong> Realizar la configuracion inicial, migracion de datos y desarrollo de la API REST.</li>
                <li><strong>Hosting:</strong> Proveer servidor dedicado con disponibilidad garantizada del 99.5%.</li>
                <li><strong>Mantencion:</strong> Realizar actualizaciones del sistema y correccion de errores.</li>
                <li><strong>Soporte:</strong> Prestar servicio de soporte tecnico mediante sistema de tickets.</li>
                <li><strong>HERMES:</strong> Mantener la integracion activa con el sistema HERMES de la Aduana de Chile.</li>
            </ol>
        </div>

        <div class="clause">
            <h3>SEXTO. Obligaciones del Cliente</h3>
            <ol type="a">
                <li>Pagar integra y oportunamente el precio estipulado por los Servicios.</li>
                <li>Entregar toda la informacion necesaria para la migracion de datos.</li>
                <li>Designar un contacto responsable para la coordinacion del proyecto.</li>
                <li>Proporcionar logo y firma digital en alta resolucion.</li>
                <li>No compartir credenciales de acceso con terceros no autorizados.</li>
            </ol>
        </div>

        <div class="clause">
            <h3>SEPTIMO. Plazo de Implementacion</h3>
            <p>El plazo estimado para la implementacion completa del sistema es de 5 a 10 dias habiles.</p>
        </div>

        <div class="clause">
            <h3>OCTAVO. Acuerdo de Nivel de Servicio (SLA)</h3>
            <div class="highlight-box">
                <ul>
                    <li><strong>Disponibilidad del Sistema:</strong> 99.5% mensual</li>
                    <li><strong>Respuesta Inicial a Tickets:</strong> Maximo 4 horas habiles</li>
                    <li><strong>Respaldos:</strong> Diarios, con retencion de 30 dias</li>
                    <li><strong>Horario de Soporte:</strong> Lunes a Viernes, 9:00 a 18:00 hrs</li>
                </ul>
            </div>
        </div>

        <div class="clause">
            <h3>NOVENO. Vigencia y Termino del Contrato</h3>
            <p><strong>9.1.</strong> El presente Contrato tendra una vigencia de 12 meses contados desde la fecha de firma, renovable automaticamente por periodos iguales.</p>
            <p><strong>9.2.</strong> En caso de termino anticipado por parte del Cliente, no procedera devolucion de los montos ya pagados.</p>
            <p><strong>9.3.</strong> En caso de incumplimiento de pago por mas de 30 dias, el Prestador de Servicios podra suspender el acceso al sistema.</p>
        </div>

        <div class="clause">
            <h3>DECIMO. Confidencialidad y Proteccion de Datos</h3>
            <p>La informacion perteneciente a la base de datos del Cliente es confidencial y de su propiedad. El Proveedor nunca publicara ni hara uso de ella.</p>
        </div>

        <div class="clause">
            <h3>DECIMO PRIMERO. Propiedad Intelectual</h3>
            <p>El Prestador de Servicios mantiene todos los derechos de propiedad intelectual del software. Este contrato otorga unicamente una licencia de uso, no transfiere propiedad alguna sobre el software.</p>
        </div>

        <div class="clause">
            <h3>DECIMO SEGUNDO. Notificaciones</h3>
            <div class="highlight-box">
                <p><strong>Por parte del Cliente:</strong><br>
                CITIKOLD CHILE S.P.A.<br>
                Avenida El Bosque Norte 0177, piso 18, Of. 1802, Las Condes<br>
                Telefono: +56 97 160 6340</p>
            </div>
            <div class="highlight-box">
                <p><strong>Por parte del Prestador de Servicios:</strong><br>
                PRICER SPA<br>
                Av. El Retiro 1227, Bodega 163, Renca, Santiago<br>
                Email: contacto@pricergroup.com</p>
            </div>
        </div>

        <div class="clause">
            <h3>DECIMO TERCERO. Legislacion Aplicable</h3>
            <p>Todas las controversias derivadas del presente Contrato seran resueltas por los Tribunales Ordinarios de Justicia. Las partes fijan su domicilio en la ciudad de Santiago, Chile.</p>
        </div>

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

        <div class="page-break"></div>
        
        <div class="anexo-header">
            <h2>ANEXO N 1 - CONDICIONES PARTICULARES DE PRESTACION DE SERVICIOS</h2>
        </div>

        <div class="parties">
            <p>Contrato de Prestacion de Servicios entre</p>
            <p><strong>PRICER SPA</strong> y <strong>CITIKOLD CHILE S.P.A.</strong></p>
        </div>

        <div class="clause">
            <h3>PRIMERO. Servicios de Implementacion (Pago Unico)</h3>
            <table class="services-table">
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Descripcion del Servicio</th>
                        <th>Valor (CLP)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>1</strong></td>
                        <td>
                            <strong>Migracion de Datos y Configuracion Inicial</strong><br>
                            Importacion de datos historicos, configuracion del operador y datos maestros, configuracion de almacenes, parametrizacion para certificacion ante Aduana, capacitacion inicial.
                        </td>
                        <td>$350.000</td>
                    </tr>
                    <tr>
                        <td><strong>2</strong></td>
                        <td>
                            <strong>Desarrollo de API REST para Integracion Externa</strong><br>
                            Diseno y desarrollo de endpoints TATC/TSTC, sistema de autenticacion por Token Bearer, generacion de PDFs via API, integracion automatica con HERMES, documentacion tecnica.
                        </td>
                        <td>$500.000</td>
                    </tr>
                    <tr class="subtotal-row">
                        <td colspan="2"><strong>Subtotal Implementacion</strong></td>
                        <td><strong>$850.000</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clause">
            <h3>SEGUNDO. Servicios Recurrentes (Pago Anual)</h3>
            <table class="services-table">
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Descripcion del Servicio</th>
                        <th>Valor Anual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>3</strong></td>
                        <td>
                            <strong>Licencia de Uso del Sistema CONTENEDORES PRICER</strong><br>
                            Acceso ilimitado al sistema web, generacion ilimitada de TATC y TSTC, generacion de PDFs oficiales formato Aduana, integracion con sistema HERMES, control de plazos y alertas, reportes y exportaciones.
                        </td>
                        <td>$1.800.000</td>
                    </tr>
                    <tr>
                        <td><strong>4</strong></td>
                        <td>
                            <strong>Mantencion y Soporte Tecnico</strong><br>
                            Actualizaciones del sistema, correccion de errores, soporte via sistema de tickets, atencion en horario habil (Lun-Vie 9:00-18:00).
                        </td>
                        <td>$450.000</td>
                    </tr>
                    <tr>
                        <td><strong>5</strong></td>
                        <td>
                            <strong>Hosting y Servicios Cloud</strong><br>
                            Servidor dedicado en la nube, certificado SSL incluido, respaldos automaticos diarios, disponibilidad 99.5% garantizada, monitoreo 24/7.
                        </td>
                        <td>$390.000</td>
                    </tr>
                    <tr class="subtotal-row">
                        <td colspan="2"><strong>Subtotal Servicios Anuales</strong></td>
                        <td><strong>$2.640.000</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="clause">
            <h3>TERCERO. Resumen de Precios</h3>
            <div class="total-box">
                <div>
                    <div class="label">TOTAL PRIMER ANO</div>
                </div>
                <div style="text-align: right;">
                    <div class="amount">$3.490.000</div>
                    <div class="label">+ IVA = $4.153.100</div>
                </div>
            </div>
            <div class="renewal-box">
                <h4>Renovacion Anual (2do ano en adelante)</h4>
                <div class="value">$2.640.000 + IVA</div>
            </div>
        </div>

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

        <div class="footer">
            <p><strong>CONTRATO DE PRESTACION DE SERVICIOS - LICENCIA DE USO ANUAL</strong></p>
            <p>PRICER SPA - CITIKOLD CHILE S.P.A.</p>
            <p style="margin-top: 8px; color: #a0aec0;">Documento generado el 09 de Febrero de 2025</p>
        </div>
    </div>
</body>
</html>
