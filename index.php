<?php include("template/header.php"); ?>

<section class="section">
  <div class="container">
    <div class="box">
      <h1 class="title">Proyecto Final</h1>

      <div class="buttons">
        <button class="button is-primary is-large custom-button" onclick="window.location.href='modulos/consultas/'">Consultas Join</button>
        <br><br>
        <button class="button is-primary is-large custom-button" onclick="window.location.href='modulos/consultasA/'">Consultas de agregación</button>
      </div>
    </div>
  </div>
</section>

<style>
body{
background: grey;
}
 .title{
      width:100%;
      height:60px;
      background-color:#59F5DF;
  }

  .custom-button {
    /* Agrega los estilos personalizados que desees */
    background-color: #4CAF50; /* Color de fondo */
    color: white; /* Color de texto */
    border: none; /* Sin borde */
    padding: 10px 20px; /* Espaciado interno */
    text-align: center; /* Alineación de texto */
    text-decoration: none; /* Sin subrayado de enlace */
    display: inline-block; /* Mostrar como elemento en línea */
    font-size: 16px; /* Tamaño de fuente */
    margin: 4px 2px; /* Márgenes externos */
    cursor: pointer; /* Cambia el cursor al pasar el mouse */
    border-radius: 4px; /* Radio de borde */
  }
  
 
</style>

<?php include("template/footer.php"); ?>

