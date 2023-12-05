<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" encoding="UTF-8" doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/strict.dtd"/>
    
    <!-- Agregar logotipo y Bootstrap -->
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
                <style>
                    body {
                    background-color: #f2f2f2; /* Fondo gris claro */
                    color: #495057;
                    }
                    .container {
                    margin-top: 50px;
                    }
                    .logo img {
                    max-width: 100%;
                    height: auto;
                    }
                    .cuenta {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    }
                    .perfiles ul {
                    padding: 0;
                    }
                    .perfiles li {
                    list-style: none;
                    margin-bottom: 10px;
                    }
                    .contenido table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                    background-color: #fff;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                    border-radius: 10px;
                    }
                    .contenido th, .contenido td {
                    border: 1px solid #dee2e6;
                    padding: 12px;
                    text-align: left;
                    }
                    .contenido th {
                    background-color: #28a745; /* Verde */
                    color: #fff;
                    border-color: #28a745;
                    }
                    .contenido tbody tr:nth-child(even) {
                    background-color: #f9f9f9;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="logo">
                        <img src="logo.png" alt="Logo"/>
                    </div>
                    <div class="cuenta">
                        <h1>Cuenta: <xsl:value-of select="CatalogoVOD/cuenta/@correo"/></h1>
                        <div class="perfiles">
                            <h2>Perfiles:</h2>
                            <ul class="list-group">
                                <xsl:apply-templates select="CatalogoVOD/cuenta/perfiles/perfil"/>
                            </ul>
                        </div>
                        <div class="contenido">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="bg-success text-white" style="text-align:center;">Peliculas</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #17a2b8; color: #fff;">Título</th>
                                        <th style="background-color: #dc3545; color: #fff;">Duración</th>
                                        <th style="background-color: #ffc107; color: #212529;">Género</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:apply-templates select="CatalogoVOD/contenido/peliculas/genero/titulo"/>
                                </tbody>
                            </table>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="bg-warning text-white" style="text-align:center;">Series</th>
                                    </tr>
                                    <tr>
                                        <th style="background-color: #007bff; color: #fff;">Título</th>
                                        <th style="background-color: #28a745; color: #fff;">Duración</th>
                                        <th style="background-color: #6c757d; color: #fff;">Género</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <xsl:apply-templates select="CatalogoVOD/contenido/series/genero/titulo"/>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    
    <!-- Transformar perfil -->
    <xsl:template match="perfil">
        <li class="list-group-item">
            <strong>Usuario:</strong> <xsl:value-of select="@usuario"/> | <strong>Idioma:</strong> <xsl:value-of select="@idioma"/>
        </li>
    </xsl:template>
    
    <!-- Transformar título de película o serie -->
    <xsl:template match="titulo">
        <tr>
            <td><xsl:value-of select="."/></td>
            <td><xsl:value-of select="@duracion"/></td>
            <td><xsl:value-of select="../@nombre"/></td>
        </tr>
    </xsl:template>
</xsl:stylesheet>
