<main class="main">
        <aside class="main__aside">
            <nav>
                <button class="button--aside active">servicios</button>
                <button class="button--aside disable">enfermeras</button>
            </nav>
        </aside>
        <section class="main__content" id="main">
            <header class="main__header--servicios">
                <section>
                    <h2>Servicios</h2>
                    <button class="button button--primary">Activos</button>
                    <button class="button button--primary active">Futuros</button>
                    <button class="button button--primary">Pasados</button>
                </section>

                <section>
                    <button class="button button--primary button--filter" id="buttonFiltrar">
                        <i class="fa-solid fa-filter" style="margin: 2px 6px 2px 0px;"></i>
                        Filtrar
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <button class="button button--circle button--primary">
                        <i class="fa-solid fa-download"></i>
                    </button>
                </section>
            </header>

            <table class="main__table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Servicio</th>
                        <th>Prestador(a)</th>
                        <th>Cliente</th>
                        <th>ECA</th>
                        <th>Extras</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table__row--disable">
                        <td>21.03.2021</td>
                        <td>000 – 00</td>
                        <td>Enrique Fuentes F</td>
                        <td>Enf Gral –12hrs </td>
                        <td>
                            <span id="name_1">Jane Doe</span>
                            <i class="fa-solid fa-pencil" onclick="cambiarNombre(1)"></i>
                        </td>
                        <td>
                            $1,500
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                        <td>
                            $ 500
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                        <td>
                            $ 120
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                    </tr>
                    <?php for($i = 0; $i<10; $i++){ ?>

                    <tr>
                        <td>21.03.2021</td>
                        <td>000 – 00</td>
                        <td>Enrique Fuentes F</td>
                        <td>Enf Gral –12hrs </td>
                        <td>
                            Jane Doe
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                        <td>
                            $1,500
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                        <td>
                            $ 500
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                        <td>
                            $ 120
                            <i class="fa-solid fa-pencil"></i>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>

            <!-- Modal que se genera al clickear en "filtrar"  -->
            <div class="main__modal--filtrar" id="modalFiltrar">
                <!-- <form action="">
                    <div>
                        <label for="fecha">Fecha</label>
                        <input type="date">
                    </div>
                    
                    <div>
                        <label for="cliente">Cliente</label>
                        <select name="cliente" id="cliente">
                            <option value="0">Seleccionar cliente</option>
                            <option value="101011">Foo</option>
                            <option value="101012">Foo</option>
                        </select>
                    </div>

                    <div>
                        <label for="paciente">Paciente</label>
                        <select name="paciente" id="paciente">
                            <option value="0">Seleccionar paciente</option>
                            <option value="101011">Foo</option>
                            <option value="101012">Foo</option>
                        </select>
                    </div>

                    <div>
                        <label for="servicio">Servicio</label>
                        <select name="servicio" id="servicio">
                            <option value="0">Seleccionar servicio</option>
                            <option value="101011">Foo</option>
                            <option value="101012">Foo</option>
                        </select>
                    </div>

                    <div>
                        <label for="prestador">Prestador</label>
                        <select name="prestador" id="prestador">
                            <option value="0">Seleccionar prestador</option>
                            <option value="101011">Foo</option>
                            <option value="101012">Foo</option>
                        </select>
                    </div>

                    <div>
                        <label for="estatus">Estatus</label>
                        <select name="estatus" id="estatus">
                            <option value="0">Seleccionar estatus</option>
                            <option value="101011">Foo</option>
                            <option value="101012">Foo</option>
                        </select>
                    </div>
                    <button type="button" class="button button--primary">Filtrar</button>
                </form> -->
            </div>

            <footer class="main__footer">
                <div class="footer__progress--bar">
                    <span></span>
                </div>
                <div class="footer__progress--number">
                    1 de 16
                </div>
                <div class="footer__progress--buttons">
                    <button class="button--transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M224 480c-8.188 0-16.38-3.125-22.62-9.375l-192-192c-12.5-12.5-12.5-32.75 0-45.25l192-192c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25L77.25 256l169.4 169.4c12.5 12.5 12.5 32.75 0 45.25C240.4 476.9 232.2 480 224 480z"/></svg>
                    </button>

                    <button class="button--transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M96 480c-8.188 0-16.38-3.125-22.62-9.375c-12.5-12.5-12.5-32.75 0-45.25L242.8 256L73.38 86.63c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l192 192c12.5 12.5 12.5 32.75 0 45.25l-192 192C112.4 476.9 104.2 480 96 480z"/></svg>
                    </button>
                </div>
            </footer>
        </section>
    </main>
    <script src="<?php echo __ROOT__; ?>/intranet/assets/js/index.js"></script>