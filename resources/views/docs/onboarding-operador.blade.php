<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding - Nuevo Operador</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            padding: 15px 25px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1a5276;
        }
        
        .header img {
            max-width: 180px;
            margin-bottom: 10px;
        }
        
        .header h1 {
            color: #1a5276;
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .header h2 {
            color: #2980b9;
            font-size: 12px;
            font-weight: normal;
        }
        
        h2 {
            color: #1a5276;
            font-size: 14px;
            margin: 20px 0 12px 0;
            padding-bottom: 4px;
            border-bottom: 2px solid #3498db;
        }
        
        h3 {
            color: #2980b9;
            font-size: 11px;
            margin: 15px 0 8px 0;
        }
        
        p {
            margin-bottom: 8px;
            text-align: justify;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 9px;
        }
        
        th {
            background: #1a5276;
            color: white;
            padding: 6px 8px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 5px 8px;
            border-bottom: 1px solid #ddd;
        }
        
        tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .required {
            color: #e74c3c;
            font-weight: bold;
        }
        
        .section {
            page-break-inside: avoid;
        }
        
        .important-box {
            background: #fef9e7;
            border-left: 4px solid #f39c12;
            padding: 10px 12px;
            margin: 12px 0;
            font-size: 9px;
        }
        
        .info-box {
            background: #eaf2f8;
            border-left: 4px solid #3498db;
            padding: 10px 12px;
            margin: 12px 0;
            font-size: 9px;
        }
        
        pre {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 10px;
            border-radius: 4px;
            font-size: 8px;
            font-family: 'Courier New', monospace;
            overflow-x: auto;
            margin: 8px 0;
            white-space: pre-wrap;
        }
        
        .checklist {
            background: #e8f6f3;
            padding: 12px;
            border-radius: 5px;
            margin: 12px 0;
        }
        
        .checklist ul {
            list-style: none;
            padding-left: 0;
        }
        
        .checklist li {
            padding: 4px 0;
            padding-left: 20px;
            position: relative;
        }
        
        .checklist li:before {
            content: "☐";
            position: absolute;
            left: 0;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #1a5276;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
        
        .two-columns {
            display: table;
            width: 100%;
        }
        
        .column {
            display: table-cell;
            width: 48%;
            vertical-align: top;
            padding-right: 2%;
        }
        
        .column:last-child {
            padding-right: 0;
            padding-left: 2%;
        }
    </style>
</head>
<body>
    <!-- HEADER -->
    <div class="header">
        <img src="https://contenedores.pricer.cl/assets/img/logo-pricer-contenedores.png" alt="PRICER">
        <h1>Onboarding - Nuevo Operador</h1>
        <h2>CONTENEDORES PRICER - Documentacion de Alta de Clientes</h2>
    </div>

    <!-- INTRODUCCION -->
    <div class="info-box">
        <strong>Proposito:</strong> Este documento detalla toda la informacion necesaria para dar de alta un nuevo operador en el sistema CONTENEDORES PRICER. Complete los datos solicitados y envie los archivos correspondientes.
    </div>

    <!-- 1. DATOS DEL OPERADOR -->
    <h2>1. Datos del Operador</h2>
    
    <div class="section">
        <h3>1.1 Datos Generales (Obligatorios)</h3>
        <table>
            <tr><th>Campo</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td><span class="required">Codigo *</span></td><td>Codigo unico del operador (asignado por Aduanas)</td><td>S46</td></tr>
            <tr><td><span class="required">RUT Operador *</span></td><td>RUT de la empresa</td><td>76.123.456-7</td></tr>
            <tr><td><span class="required">Nombre Operador *</span></td><td>Razon social completa</td><td>MI EMPRESA S.A.</td></tr>
            <tr><td><span class="required">Estado *</span></td><td>Activo o Inactivo</td><td>Activo</td></tr>
        </table>

        <h3>1.2 Datos Generales (Opcionales)</h3>
        <table>
            <tr><th>Campo</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>Nombre de Fantasia</td><td>Nombre comercial</td><td>MI EMPRESA</td></tr>
            <tr><td>Direccion</td><td>Direccion completa</td><td>Av. Principal 123, Santiago</td></tr>
            <tr><td>Resolucion Operador</td><td>Numero resolucion aduanera</td><td>RES-2024-001234</td></tr>
        </table>

        <h3>1.3 Datos del Representante Legal</h3>
        <table>
            <tr><th>Campo</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>RUT Representante</td><td>RUT del representante legal</td><td>12.345.678-9</td></tr>
            <tr><td>Nombre Representante</td><td>Nombre completo</td><td>Juan Perez Lopez</td></tr>
            <tr><td>Cargo Representante</td><td>Cargo en la empresa</td><td>Gerente General</td></tr>
        </table>

        <h3>1.4 Archivos Requeridos</h3>
        <table>
            <tr><th>Archivo</th><th>Formato</th><th>Descripcion</th></tr>
            <tr><td><span class="required">Logo del Operador *</span></td><td>JPG, PNG, GIF (max 2MB)</td><td>Logo para documentos oficiales</td></tr>
            <tr><td><span class="required">Firma y Timbre *</span></td><td>JPG, PNG, GIF (max 2MB)</td><td>Firma del representante con timbre</td></tr>
        </table>

        <h3>1.5 Configuracion de Emails</h3>
        <table>
            <tr><th>Campo</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>Nombre Remitente</td><td>Nombre para envio de emails</td><td>Operaciones MI EMPRESA</td></tr>
            <tr><td>Email Remitente</td><td>Email principal</td><td>operaciones@miempresa.cl</td></tr>
            <tr><td>Email Copia</td><td>Email para copias</td><td>gerencia@miempresa.cl</td></tr>
            <tr><td>Email Notificaciones</td><td>Email para alertas</td><td>alertas@miempresa.cl</td></tr>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- 2. EMPRESAS TRANSPORTISTAS -->
    <h2>2. Datos de Empresas Transportistas</h2>
    
    <div class="important-box">
        <strong>Importante:</strong> Se requiere <strong>al menos 1 empresa transportista</strong> para comenzar a operar.
    </div>

    <div class="section">
        <h3>2.1 Datos por Transportista</h3>
        <table>
            <tr><th>Campo</th><th>Obligatorio</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>Nombre Empresa</td><td><span class="required">Si</span></td><td>Razon social</td><td>TRANSPORTES ABC LTDA.</td></tr>
            <tr><td>RUT</td><td><span class="required">Si</span></td><td>RUT de la empresa</td><td>76.987.654-3</td></tr>
            <tr><td>Direccion</td><td>No</td><td>Direccion</td><td>Calle 456</td></tr>
            <tr><td>Ciudad</td><td>No</td><td>Ciudad</td><td>Valparaiso</td></tr>
            <tr><td>Telefono</td><td>No</td><td>Telefono principal</td><td>+56 32 123 4567</td></tr>
            <tr><td>Email</td><td>No</td><td>Email de contacto</td><td>contacto@abc.cl</td></tr>
            <tr><td>Persona Contacto</td><td>No</td><td>Nombre encargado</td><td>Maria Rodriguez</td></tr>
            <tr><td>Estado</td><td><span class="required">Si</span></td><td>Activo/Inactivo</td><td>Activo</td></tr>
        </table>
    </div>

    <!-- 3. DATOS HISTORICOS TATC -->
    <h2>3. Datos Historicos TATC</h2>
    
    <div class="info-box">
        Para cargar TATCs existentes y mantener la correlatividad de numeros, envie un archivo con los siguientes datos.
    </div>

    <div class="section">
        <h3>3.1 Columnas Requeridas (Excel/CSV)</h3>
        <table>
            <tr><th>Columna</th><th>Formato</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>numero_tatc</td><td>Texto</td><td>Numero TATC completo</td><td>2024342460000123</td></tr>
            <tr><td>numero_contenedor</td><td>Texto</td><td>Numero del contenedor</td><td>MSCU1234567</td></tr>
            <tr><td>tipo_contenedor</td><td>Texto</td><td>Codigo ISO</td><td>42G1</td></tr>
            <tr><td>tipo_ingreso</td><td>Texto</td><td>desembarque/traspaso/reingreso</td><td>desembarque</td></tr>
            <tr><td>aduana_ingreso</td><td>Numero</td><td>Codigo de aduana</td><td>34</td></tr>
            <tr><td>ingreso_pais</td><td>Fecha/Hora</td><td>dd/mm/yyyy HH:mm</td><td>26/12/2024 10:30</td></tr>
            <tr><td>ingreso_deposito</td><td>Fecha/Hora</td><td>dd/mm/yyyy HH:mm</td><td>26/12/2024 14:00</td></tr>
            <tr><td>fecha_emision</td><td>Fecha</td><td>dd/mm/yyyy</td><td>26/12/2024</td></tr>
            <tr><td>estado</td><td>Texto</td><td>Estado actual</td><td>Aprobado</td></tr>
        </table>

        <h3>3.2 Columnas Opcionales</h3>
        <table>
            <tr><th>Columna</th><th>Formato</th><th>Descripcion</th></tr>
            <tr><td>fecha_traspaso</td><td>Fecha</td><td>Fecha de traspaso</td></tr>
            <tr><td>tatc_origen</td><td>Texto</td><td>TATC de origen (para traspasos)</td></tr>
            <tr><td>tara_contenedor</td><td>Numero</td><td>Peso tara en kg</td></tr>
            <tr><td>valor_fob</td><td>Numero</td><td>Valor FOB en USD</td></tr>
            <tr><td>puerto_ingreso</td><td>Texto</td><td>Puerto de ingreso</td></tr>
            <tr><td>ubicacion_fisica</td><td>Texto</td><td>Ubicacion en deposito</td></tr>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- 4. DATOS HISTORICOS TSTC -->
    <h2>4. Datos Historicos TSTC</h2>
    
    <div class="section">
        <h3>4.1 Columnas Requeridas (Excel/CSV)</h3>
        <table>
            <tr><th>Columna</th><th>Formato</th><th>Descripcion</th><th>Ejemplo</th></tr>
            <tr><td>numero_tstc</td><td>Texto</td><td>Numero TSTC completo</td><td>2024342460000050</td></tr>
            <tr><td>numero_contenedor</td><td>Texto</td><td>Numero del contenedor</td><td>MSCU1234567</td></tr>
            <tr><td>tipo_contenedor</td><td>Texto</td><td>Codigo ISO</td><td>42G1</td></tr>
            <tr><td>aduana_salida</td><td>Numero</td><td>Codigo de aduana</td><td>34</td></tr>
            <tr><td>destino_contenedor</td><td>Texto</td><td>Pais destino</td><td>China</td></tr>
            <tr><td>fecha_salida_pais</td><td>Fecha/Hora</td><td>dd/mm/yyyy HH:mm</td><td>30/12/2024 08:00</td></tr>
            <tr><td>fecha_emision</td><td>Fecha</td><td>dd/mm/yyyy</td><td>28/12/2024</td></tr>
            <tr><td>estado</td><td>Texto</td><td>Estado actual</td><td>Aprobado</td></tr>
        </table>
    </div>

    <!-- 5. DATOS HISTORICOS SALIDAS -->
    <h2>5. Datos Historicos Salidas</h2>
    
    <div class="section">
        <h3>5.1 Tipos de Salida</h3>
        <table>
            <tr><th>Tipo</th><th>Descripcion</th></tr>
            <tr><td>internacion</td><td>Declaracion de Internacion</td></tr>
            <tr><td>cancelacion</td><td>Cancelacion de TATC</td></tr>
            <tr><td>traspaso</td><td>Traspaso a otro operador</td></tr>
        </table>

        <h3>5.2 Columnas Requeridas</h3>
        <table>
            <tr><th>Columna</th><th>Formato</th><th>Descripcion</th></tr>
            <tr><td>numero_tatc</td><td>Texto</td><td>TATC asociado</td></tr>
            <tr><td>numero_contenedor</td><td>Texto</td><td>Numero del contenedor</td></tr>
            <tr><td>tipo_salida</td><td>Texto</td><td>internacion/cancelacion/traspaso</td></tr>
            <tr><td>fecha_salida</td><td>Fecha</td><td>dd/mm/yyyy</td></tr>
            <tr><td>estado</td><td>Texto</td><td>Estado</td></tr>
        </table>
    </div>

    <!-- 6. DATOS HISTORICOS PRORROGAS -->
    <h2>6. Datos Historicos Prorrogas</h2>
    
    <div class="section">
        <table>
            <tr><th>Columna</th><th>Formato</th><th>Descripcion</th></tr>
            <tr><td>numero_tatc</td><td>Texto</td><td>TATC asociado</td></tr>
            <tr><td>fecha_solicitud</td><td>Fecha</td><td>dd/mm/yyyy</td></tr>
            <tr><td>fecha_vencimiento_original</td><td>Fecha</td><td>dd/mm/yyyy</td></tr>
            <tr><td>fecha_vencimiento_nueva</td><td>Fecha</td><td>dd/mm/yyyy</td></tr>
            <tr><td>dias_solicitados</td><td>Numero</td><td>Dias de prorroga</td></tr>
            <tr><td>motivo</td><td>Texto</td><td>Motivo de la solicitud</td></tr>
            <tr><td>estado</td><td>Texto</td><td>Pendiente/Aprobada/Rechazada</td></tr>
        </table>
    </div>

    <!-- 7. USUARIOS -->
    <h2>7. Usuarios del Sistema</h2>
    
    <div class="section">
        <h3>7.1 Datos por Usuario</h3>
        <table>
            <tr><th>Campo</th><th>Obligatorio</th><th>Descripcion</th></tr>
            <tr><td>Nombre</td><td><span class="required">Si</span></td><td>Nombre completo del usuario</td></tr>
            <tr><td>Email</td><td><span class="required">Si</span></td><td>Email (sera el usuario de acceso)</td></tr>
            <tr><td>Rol</td><td><span class="required">Si</span></td><td>admin / operador / consulta</td></tr>
        </table>

        <h3>7.2 Roles Disponibles</h3>
        <table>
            <tr><th>Rol</th><th>Descripcion</th></tr>
            <tr><td>admin</td><td>Acceso completo al sistema</td></tr>
            <tr><td>operador</td><td>Puede crear y editar TATC/TSTC/Salidas</td></tr>
            <tr><td>consulta</td><td>Solo lectura de datos</td></tr>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- 8. FORMATOS DE ARCHIVO -->
    <h2>8. Formatos de Archivo Aceptados</h2>
    
    <div class="section">
        <table>
            <tr><th>Formato</th><th>Extension</th><th>Descripcion</th></tr>
            <tr><td>Excel</td><td>.xlsx, .xls</td><td>Recomendado para grandes volumenes</td></tr>
            <tr><td>JSON</td><td>.json</td><td>Para integracion via API</td></tr>
            <tr><td>SQL</td><td>.sql</td><td>Para migracion directa de base de datos</td></tr>
            <tr><td>CSV</td><td>.csv</td><td>Compatible con cualquier sistema</td></tr>
        </table>

        <div class="info-box">
            <strong>Especificaciones:</strong><br>
            - Codificacion: UTF-8<br>
            - Separador CSV: Punto y coma (;) o coma (,)<br>
            - Formato fechas: dd/mm/yyyy o yyyy-mm-dd<br>
            - Formato fecha/hora: dd/mm/yyyy HH:mm o yyyy-mm-ddTHH:mm:ss
        </div>
    </div>

    <!-- 9. CHECKLIST -->
    <h2>9. Checklist de Entrega</h2>
    
    <div class="checklist">
        <h3>Documentos Obligatorios</h3>
        <ul>
            <li>Datos del Operador (Codigo, RUT, Nombre, Estado)</li>
            <li>Logo del Operador (imagen)</li>
            <li>Firma y Timbre del Representante (imagen)</li>
            <li>Al menos 1 Empresa Transportista</li>
        </ul>

        <h3>Datos Historicos (si aplica)</h3>
        <ul>
            <li>Archivo de TATCs historicos</li>
            <li>Archivo de TSTCs historicos</li>
            <li>Archivo de Salidas historicas</li>
            <li>Archivo de Prorrogas historicas</li>
        </ul>

        <h3>Usuarios</h3>
        <ul>
            <li>Lista de usuarios con nombre, email y rol</li>
        </ul>

        <h3>Informacion Adicional</h3>
        <ul>
            <li>Ultimo numero correlativo de TATC utilizado</li>
            <li>Ultimo numero correlativo de TSTC utilizado</li>
            <li>Aduanas donde opera el cliente</li>
        </ul>
    </div>

    <!-- TABLAS DE REFERENCIA -->
    <h2>Tablas de Referencia</h2>
    
    <div class="two-columns">
        <div class="column">
            <h3>Codigos de Aduana</h3>
            <table>
                <tr><th>Codigo</th><th>Aduana</th></tr>
                <tr><td>31</td><td>Arica</td></tr>
                <tr><td>32</td><td>Iquique</td></tr>
                <tr><td>33</td><td>Antofagasta</td></tr>
                <tr><td>34</td><td>Valparaiso</td></tr>
                <tr><td>35</td><td>San Antonio</td></tr>
                <tr><td>36</td><td>Coquimbo</td></tr>
                <tr><td>37</td><td>Talcahuano</td></tr>
                <tr><td>38</td><td>Coronel</td></tr>
                <tr><td>39</td><td>Puerto Montt</td></tr>
                <tr><td>40</td><td>Punta Arenas</td></tr>
            </table>
        </div>
        <div class="column">
            <h3>Tipos de Contenedor</h3>
            <table>
                <tr><th>Codigo</th><th>Descripcion</th></tr>
                <tr><td>22G1</td><td>20' Dry Standard</td></tr>
                <tr><td>22R1</td><td>20' Reefer</td></tr>
                <tr><td>42G1</td><td>40' Dry Standard</td></tr>
                <tr><td>45G1</td><td>40' High Cube</td></tr>
                <tr><td>45R1</td><td>40' Reefer HC</td></tr>
                <tr><td>L5G1</td><td>45' High Cube</td></tr>
            </table>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>Enviar documentacion a:</strong></p>
        <p>Email: contacto@pricergroup.com | Web: www.pricergroup.com</p>
        <p style="margin-top: 10px; color: #999;">CONTENEDORES PRICER - Febrero 2025</p>
    </div>
</body>
</html>
