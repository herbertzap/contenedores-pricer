<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API V1 - Documentacion para Clientes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 11px;
            line-height: 1.5;
            color: #333;
            padding: 20px 30px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #1a5276;
        }
        
        .header img {
            max-width: 200px;
            margin-bottom: 15px;
        }
        
        .header h1 {
            color: #1a5276;
            font-size: 22px;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #2980b9;
            font-size: 14px;
            font-weight: normal;
        }
        
        .header-info {
            margin-top: 15px;
            font-size: 10px;
            color: #666;
        }
        
        h2 {
            color: #1a5276;
            font-size: 16px;
            margin: 25px 0 15px 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #3498db;
        }
        
        h3 {
            color: #2980b9;
            font-size: 13px;
            margin: 20px 0 10px 0;
        }
        
        h4 {
            color: #34495e;
            font-size: 11px;
            margin: 15px 0 8px 0;
        }
        
        p {
            margin-bottom: 10px;
            text-align: justify;
        }
        
        .important-box {
            background: #fef9e7;
            border-left: 4px solid #f39c12;
            padding: 12px 15px;
            margin: 15px 0;
            font-size: 10px;
        }
        
        .important-box strong {
            color: #d35400;
        }
        
        .endpoint {
            background: #eaf2f8;
            border-left: 4px solid #3498db;
            padding: 10px 15px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 10px;
        }
        
        .method {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 9px;
            margin-right: 10px;
        }
        
        .method-get { background: #27ae60; color: white; }
        .method-post { background: #3498db; color: white; }
        .method-put { background: #f39c12; color: white; }
        
        pre {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 12px;
            border-radius: 4px;
            font-size: 9px;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
            margin: 10px 0;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 10px;
        }
        
        th {
            background: #1a5276;
            color: white;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .code-inline {
            background: #ecf0f1;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
            font-size: 9px;
            color: #c0392b;
        }
        
        .section {
            page-break-inside: avoid;
        }
        
        .toc {
            background: #f8f9fa;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        
        .toc h3 {
            margin-top: 0;
            color: #1a5276;
        }
        
        .toc ul {
            list-style: none;
            padding-left: 0;
        }
        
        .toc li {
            padding: 5px 0;
            border-bottom: 1px dotted #ddd;
        }
        
        .toc li:last-child {
            border-bottom: none;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #1a5276;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .note {
            background: #e8f6f3;
            border-left: 4px solid #1abc9c;
            padding: 10px 15px;
            margin: 10px 0;
            font-size: 10px;
        }
        
        .error-box {
            background: #fdedec;
            border-left: 4px solid #e74c3c;
            padding: 10px 15px;
            margin: 10px 0;
            font-size: 10px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contenedores.png" alt="PRICER">
        <h1>API V1 - Documentacion para Clientes</h1>
        <h2>CONTENEDORES PRICER - Integracion Externa</h2>
        <div class="header-info">
            <strong>Version:</strong> 1.0.0 | 
            <strong>Base URL:</strong> https://contenedores.pricer.cl/api/v1 | 
            <strong>Fecha:</strong> Febrero 2025
        </div>
    </div>

    <!-- AUTENTICACION -->
    <h2>Autenticacion</h2>
    <p>Todas las consultas a la API requieren un <strong>Token de Acceso</strong> que debe incluirse en el header de cada peticion:</p>
    
    <pre>Authorization: Bearer {su_token}</pre>
    
    <div class="important-box">
        <strong>Importante:</strong> El token es proporcionado directamente por PRICER. No existe un endpoint publico para obtener tokens. Contacte a su ejecutivo para solicitar sus credenciales de acceso.
    </div>
    
    <h3>Validacion de Datos</h3>
    <p>El sistema valida automaticamente que los contenedores consultados correspondan al operador asociado al token. Solo podra consultar, crear o modificar registros de contenedores asignados a su operador.</p>

    <!-- INDICE -->
    <div class="toc">
        <h3>Indice de Contenidos</h3>
        <ul>
            <li><strong>1.</strong> TATC - Titulo de Admision Temporal (Obtener, Crear, Editar)</li>
            <li><strong>2.</strong> TSTC - Titulo de Salida Temporal (Obtener, Crear, Editar)</li>
            <li><strong>3.</strong> Salidas (Listar, Obtener)</li>
            <li><strong>4.</strong> Prorrogas (Listar, Solicitar)</li>
            <li><strong>5.</strong> Errores y Codigos de Respuesta</li>
        </ul>
    </div>

    <div class="page-break"></div>

    <!-- TATC -->
    <h2>1. TATC - Titulo de Admision Temporal</h2>
    
    <div class="section">
        <h3>1.1 Obtener TATC</h3>
        <p>Obtiene informacion de un TATC por numero de contenedor o numero de TATC.</p>
        
        <div class="endpoint">
            <span class="method method-get">GET</span>
            <strong>/api/v1/tatc/{identificador}</strong>
        </div>
        
        <p><strong>Parametro:</strong> <span class="code-inline">identificador</span> - Numero de TATC o numero de contenedor</p>
        
        <h4>Response:</h4>
        <pre>{
  "success": true,
  "data": {
    "tatc": {
      "numero_tatc": "2024342460000123",
      "numero_contenedor": "MSCU1234567",
      "tipo_contenedor": "42G1",
      "estado": "Aprobado",
      "fecha_emision_tatc": "2024-12-26T15:00:00.000000Z"
    },
    "fecha_vencimiento": "2025-12-26",
    "dias_restantes": 365
  }
}</pre>
    </div>

    <div class="section">
        <h3>1.2 Crear TATC</h3>
        <p>Crea un nuevo TATC y lo envia automaticamente a HERMES.</p>
        
        <div class="endpoint">
            <span class="method method-post">POST</span>
            <strong>/api/v1/tatc</strong>
        </div>
        
        <h4>Campos Requeridos:</h4>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>numero_contenedor</td><td>string</td><td>Numero del contenedor (ej: MSCU1234567)</td></tr>
            <tr><td>tipo_contenedor</td><td>string</td><td>Codigo ISO (ej: 42G1, 45G1)</td></tr>
            <tr><td>tipo_ingreso</td><td>string</td><td>"desembarque", "traspaso" o "reingreso"</td></tr>
            <tr><td>aduana_ingreso</td><td>string</td><td>Codigo de aduana (ej: 34)</td></tr>
            <tr><td>ingreso_pais</td><td>datetime</td><td>Fecha/hora ingreso al pais</td></tr>
            <tr><td>ingreso_deposito</td><td>datetime</td><td>Fecha/hora ingreso al deposito</td></tr>
        </table>

        <h4>Request:</h4>
        <pre>{
  "numero_contenedor": "MSCU1234567",
  "tipo_contenedor": "42G1",
  "tipo_ingreso": "desembarque",
  "aduana_ingreso": "34",
  "ingreso_pais": "2024-12-26T10:30:00",
  "ingreso_deposito": "2024-12-26T14:00:00"
}</pre>

        <h4>Response (201):</h4>
        <pre>{
  "success": true,
  "message": "TATC creado correctamente",
  "data": {
    "tatc_id": 123,
    "numero_tatc": "2024342460000123",
    "numero_contenedor": "MSCU1234567",
    "estado": "Aprobado",
    "fecha_vencimiento": "2025-12-26"
  }
}</pre>
    </div>

    <div class="section">
        <h3>1.3 Editar TATC</h3>
        <p>Actualiza los datos de un TATC existente.</p>
        
        <div class="endpoint">
            <span class="method method-put">PUT</span>
            <strong>/api/v1/tatc/{identificador}</strong>
        </div>
        
        <h4>Campos Editables:</h4>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>ubicacion_fisica</td><td>string</td><td>Ubicacion en deposito</td></tr>
            <tr><td>comentario</td><td>string</td><td>Observaciones</td></tr>
            <tr><td>tara_contenedor</td><td>string</td><td>Tara del contenedor</td></tr>
            <tr><td>valor_fob</td><td>numeric</td><td>Valor FOB</td></tr>
        </table>

        <h4>Response:</h4>
        <pre>{
  "success": true,
  "message": "TATC actualizado correctamente",
  "data": {
    "tatc_id": 123,
    "numero_tatc": "2024342460000123",
    "ubicacion_fisica": "Zona B, Fila 3"
  }
}</pre>
    </div>

    <div class="page-break"></div>

    <!-- TSTC -->
    <h2>2. TSTC - Titulo de Salida Temporal</h2>
    
    <div class="section">
        <h3>2.1 Obtener TSTC</h3>
        <p>Obtiene informacion de un TSTC por numero de contenedor o numero de TSTC.</p>
        
        <div class="endpoint">
            <span class="method method-get">GET</span>
            <strong>/api/v1/tstc/{identificador}</strong>
        </div>
        
        <h4>Response:</h4>
        <pre>{
  "success": true,
  "data": {
    "tstc": {
      "numero_tstc": "2024342460000050",
      "numero_contenedor": "MSCU1234567",
      "tipo_contenedor": "42G1",
      "aduana_salida": "34",
      "destino_contenedor": "China",
      "estado": "Aprobado"
    }
  }
}</pre>
    </div>

    <div class="section">
        <h3>2.2 Crear TSTC</h3>
        <p>Crea un nuevo TSTC y lo envia automaticamente a HERMES.</p>
        
        <div class="endpoint">
            <span class="method method-post">POST</span>
            <strong>/api/v1/tstc</strong>
        </div>
        
        <h4>Campos Requeridos:</h4>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>numero_contenedor</td><td>string</td><td>Numero del contenedor</td></tr>
            <tr><td>tipo_contenedor</td><td>string</td><td>Codigo ISO del tipo</td></tr>
            <tr><td>aduana_salida</td><td>string</td><td>Codigo de aduana de salida</td></tr>
            <tr><td>destino_contenedor</td><td>string</td><td>Pais destino</td></tr>
            <tr><td>fecha_salida_pais</td><td>datetime</td><td>Fecha/hora de salida</td></tr>
        </table>

        <h4>Response (201):</h4>
        <pre>{
  "success": true,
  "message": "TSTC creado correctamente",
  "data": {
    "tstc_id": 50,
    "numero_tstc": "2024342460000050",
    "numero_contenedor": "MSCU1234567",
    "estado": "Aprobado"
  }
}</pre>
    </div>

    <div class="section">
        <h3>2.3 Editar TSTC</h3>
        <p>Actualiza los datos de un TSTC existente.</p>
        
        <div class="endpoint">
            <span class="method method-put">PUT</span>
            <strong>/api/v1/tstc/{identificador}</strong>
        </div>
        
        <h4>Campos Editables:</h4>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>destino_contenedor</td><td>string</td><td>Pais destino</td></tr>
            <tr><td>valor_fob</td><td>numeric</td><td>Valor FOB</td></tr>
            <tr><td>tara_contenedor</td><td>string</td><td>Tara del contenedor</td></tr>
            <tr><td>comentario</td><td>string</td><td>Observaciones</td></tr>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- SALIDAS -->
    <h2>3. Salidas</h2>
    
    <div class="section">
        <h3>3.1 Listar Salidas</h3>
        <p>Obtiene el listado de salidas registradas.</p>
        
        <div class="endpoint">
            <span class="method method-get">GET</span>
            <strong>/api/v1/salidas</strong>
        </div>
        
        <h4>Parametros de Query (opcionales):</h4>
        <table>
            <tr><th>Parametro</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>numero_contenedor</td><td>string</td><td>Filtrar por contenedor</td></tr>
            <tr><td>tipo_salida</td><td>string</td><td>internacion, cancelacion, traspaso</td></tr>
            <tr><td>fecha_desde</td><td>date</td><td>Fecha inicio (YYYY-MM-DD)</td></tr>
            <tr><td>fecha_hasta</td><td>date</td><td>Fecha fin (YYYY-MM-DD)</td></tr>
        </table>

        <h4>Response:</h4>
        <pre>{
  "success": true,
  "data": {
    "data": [
      {
        "numero_salida": "SAL-2024-000200",
        "numero_contenedor": "MSCU1234567",
        "fecha_salida": "2024-12-28",
        "tipo_salida": "internacion",
        "estado": "Aprobado"
      }
    ],
    "total": 50
  }
}</pre>
    </div>

    <div class="section">
        <h3>3.2 Obtener Salida</h3>
        <p>Obtiene el detalle de una salida especifica.</p>
        
        <div class="endpoint">
            <span class="method method-get">GET</span>
            <strong>/api/v1/salidas/{id}</strong>
        </div>
    </div>

    <!-- PRORROGAS -->
    <h2>4. Prorrogas</h2>
    
    <div class="section">
        <h3>4.1 Listar Prorrogas</h3>
        <p>Obtiene el listado de prorrogas solicitadas.</p>
        
        <div class="endpoint">
            <span class="method method-get">GET</span>
            <strong>/api/v1/prorrogas</strong>
        </div>
        
        <h4>Parametros de Query (opcionales):</h4>
        <table>
            <tr><th>Parametro</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>estado</td><td>string</td><td>Pendiente, Aprobada, Rechazada</td></tr>
            <tr><td>fecha_desde</td><td>date</td><td>Fecha inicio (YYYY-MM-DD)</td></tr>
            <tr><td>fecha_hasta</td><td>date</td><td>Fecha fin (YYYY-MM-DD)</td></tr>
        </table>
    </div>

    <div class="section">
        <h3>4.2 Solicitar Prorroga</h3>
        <p>Solicita una prorroga para un TATC proximo a vencer.</p>
        
        <div class="endpoint">
            <span class="method method-post">POST</span>
            <strong>/api/v1/prorrogas</strong>
        </div>
        
        <h4>Campos Requeridos:</h4>
        <table>
            <tr><th>Campo</th><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>numero_contenedor</td><td>string</td><td>Numero del contenedor</td></tr>
            <tr><td>motivo</td><td>string</td><td>Motivo de la solicitud</td></tr>
            <tr><td>dias_solicitados</td><td>int</td><td>Dias solicitados (max 365, opcional)</td></tr>
        </table>

        <div class="note">
            <strong>Nota:</strong> Solo se puede solicitar prorroga cuando el TATC esta a 30 dias de vencer y no tiene prorroga previa.
        </div>

        <h4>Response (201):</h4>
        <pre>{
  "success": true,
  "message": "Prorroga solicitada correctamente",
  "data": {
    "prorroga_id": 11,
    "numero_contenedor": "MSCU1234567",
    "fecha_vencimiento_original": "2024-12-26",
    "fecha_vencimiento_nueva": "2025-06-24",
    "estado": "Pendiente"
  }
}</pre>
    </div>

    <div class="page-break"></div>

    <!-- ERRORES -->
    <h2>5. Errores y Codigos de Respuesta</h2>
    
    <div class="section">
        <h3>Formato de Error</h3>
        <pre>{
  "success": false,
  "message": "Descripcion del error"
}</pre>

        <h3>Codigos de Error</h3>
        <table>
            <tr><th>Codigo</th><th>Descripcion</th></tr>
            <tr><td>400</td><td>Error en la solicitud</td></tr>
            <tr><td>401</td><td>Token invalido o no proporcionado</td></tr>
            <tr><td>403</td><td>Sin permisos (contenedor no pertenece a su operador)</td></tr>
            <tr><td>404</td><td>Recurso no encontrado</td></tr>
            <tr><td>422</td><td>Error de validacion</td></tr>
            <tr><td>500</td><td>Error interno del servidor</td></tr>
        </table>

        <h3>Ejemplos de Errores</h3>
        
        <div class="error-box">
            <strong>Token no proporcionado (401):</strong>
            <pre style="margin: 5px 0;">{"success": false, "message": "Token de acceso requerido"}</pre>
        </div>

        <div class="error-box">
            <strong>Contenedor no pertenece al operador (403):</strong>
            <pre style="margin: 5px 0;">{"success": false, "message": "No tiene permisos para acceder a este contenedor"}</pre>
        </div>

        <div class="error-box">
            <strong>Error de validacion (422):</strong>
            <pre style="margin: 5px 0;">{
  "success": false,
  "message": "Error de validacion",
  "errors": {
    "numero_contenedor": ["El campo es obligatorio."]
  }
}</pre>
        </div>
    </div>

    <!-- RESUMEN -->
    <h2>Resumen de Endpoints</h2>
    <table>
        <tr><th>Servicio</th><th>Metodo</th><th>Endpoint</th><th>Descripcion</th></tr>
        <tr><td>TATC</td><td><span class="method method-get">GET</span></td><td>/api/v1/tatc/{identificador}</td><td>Obtener TATC</td></tr>
        <tr><td>TATC</td><td><span class="method method-post">POST</span></td><td>/api/v1/tatc</td><td>Crear TATC</td></tr>
        <tr><td>TATC</td><td><span class="method method-put">PUT</span></td><td>/api/v1/tatc/{identificador}</td><td>Editar TATC</td></tr>
        <tr><td>TSTC</td><td><span class="method method-get">GET</span></td><td>/api/v1/tstc/{identificador}</td><td>Obtener TSTC</td></tr>
        <tr><td>TSTC</td><td><span class="method method-post">POST</span></td><td>/api/v1/tstc</td><td>Crear TSTC</td></tr>
        <tr><td>TSTC</td><td><span class="method method-put">PUT</span></td><td>/api/v1/tstc/{identificador}</td><td>Editar TSTC</td></tr>
        <tr><td>Salidas</td><td><span class="method method-get">GET</span></td><td>/api/v1/salidas</td><td>Listar salidas</td></tr>
        <tr><td>Salidas</td><td><span class="method method-get">GET</span></td><td>/api/v1/salidas/{id}</td><td>Obtener salida</td></tr>
        <tr><td>Prorrogas</td><td><span class="method method-get">GET</span></td><td>/api/v1/prorrogas</td><td>Listar prorrogas</td></tr>
        <tr><td>Prorrogas</td><td><span class="method method-post">POST</span></td><td>/api/v1/prorrogas</td><td>Solicitar prorroga</td></tr>
    </table>

    <!-- CODIGOS ADUANA -->
    <h2>Codigos de Aduana</h2>
    <table>
        <tr><th>Codigo</th><th>Aduana</th><th>Codigo</th><th>Aduana</th></tr>
        <tr><td>31</td><td>Arica</td><td>36</td><td>Coquimbo</td></tr>
        <tr><td>32</td><td>Iquique</td><td>37</td><td>Talcahuano</td></tr>
        <tr><td>33</td><td>Antofagasta</td><td>38</td><td>Coronel</td></tr>
        <tr><td>34</td><td>Valparaiso</td><td>39</td><td>Puerto Montt</td></tr>
        <tr><td>35</td><td>San Antonio</td><td>40</td><td>Punta Arenas</td></tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>Soporte Tecnico</strong></p>
        <p>Email: contacto@pricergroup.com | Web: www.pricergroup.com</p>
        <p style="margin-top: 15px; color: #999;">CONTENEDORES PRICER - Febrero 2025</p>
    </div>
</body>
</html>
