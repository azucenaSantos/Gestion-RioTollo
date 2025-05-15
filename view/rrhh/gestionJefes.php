<html lang="en" data-bs-theme="dark">

<body>
    <div class="section d-flex flex-row">
        <nav class="navbar navbar-expand-lg navbar-light" style="width: 400px;">
            <div class="container-fluid lateral-menu">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item">
                            <a href="?c=Rrhh&a=gestionTrabajadores" class="nav-section">
                                <i class="las la-user-edit"></i>
                                <h3>Gestionar Trabajadores</h3>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="?c=Rrhh&a=gestionJefes" class="nav-section">
                                <i class="las la-user-shield"></i>
                                <h3>Gestionar Jefes</h3>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <main>
            <div class="info-container">
                <h1>Listado de Jefes</h1>
            </div>
            <div class="container containerTable">
                <form class="btn-container" action="?c=RRHH&a=editarJefe" method="post">
                    <button type="submit" class="buttonAdd">Añadir Jefe</button>
                </form>
                <table class="table table-hover mx-auto shadow-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Rol</th>
                            <th class="acciones">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </main>


    </div>
    <div class="line"></div>