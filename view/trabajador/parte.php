<html lang="en" data-bs-theme="dark">

<body>
    <div class="section">
        <!--Menu lateral, comun a todos los usuarios (con más o menos apartados) -->
        <nav class="navbar navbar-expand-lg navbar-light" style="width: 400px;">
            <div class="container-fluid lateral-menu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item li-active">
                            <a class="nav-section" href="?c=Trabajador&a=verParte">
                                <i class="las la-file"></i>
                                <h3>Visualizar Parte</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Contenido de la página-->
        <main>
            <div class="info-container">
                <h1>Visualizar Parte</h1>
                <hr>
            </div>
            <div class="container">
                <!--iframe donde se carga el PDF en modo previsualizacion-->
                <iframe src="pdfs/<?php echo $fileName; ?>" width="90%" height="600px"></iframe>
            </div>
        </main>
    </div>
    <div class="line"></div>
</body>