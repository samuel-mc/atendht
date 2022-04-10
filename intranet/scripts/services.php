<script type="text/javascript">

    // Modal Filtrar
	let showingModal = false;
    const buttonFiltrar = document.getElementById('buttonFiltrar');
    const modalFiltrar = document.createElement("div");
    modalFiltrar.classList.add('main__modal', 'main__modal--filtrar');
    modalFiltrar.setAttribute('id', 'modalFiltrar');
    modalFiltrar.innerHTML =
        `<form>
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
        </form>`

    const main = document.getElementById('header');

    buttonFiltrar.addEventListener('click', showModalFiltrar);

    function showModalFiltrar() {
        if (!showingModal) {
            main.appendChild(modalFiltrar);
            showingModal = true;
        } else {
            main.removeChild(modalFiltrar);
            showingModal = false;
        }
    }

    // Modal Editar
    let showingModalEditar = false;
    let botonesEditar = document.getElementsByClassName('buttonEditar');
    botonesEditar = Array.from(botonesEditar);
    const modalEditar = document.createElement("div");
    modalEditar.classList.add('main__modal', 'main__modal--edit');
    modalEditar.setAttribute('id', 'modalEdit');
    modalEditar.innerHTML =
        `   <div>
                <button class="button button--primary button--circle" onclick="closeModalEditar()">
                    X
                </button>
            </div>
            <form action="">
                <div>
                    <label for="aplica">Aplica a</label>
                    <select name="aplica" id="aplica">
                        <option value="0">Cliente</option>
                        <option value="101011">Foo</option>
                        <option value="101012">Foo</option>
                    </select>
                </div>

                <div>
                    <label for="recurrencia">Recurrencia</label>
                    <select name="recurrencia" id="recurrencia">
                        <option value="0">De aquí en adelante</option>
                        <option value="101011">Foo</option>
                        <option value="101012">Foo</option>
                    </select>
                </div>

                <div>
                    <label for="estatus">Monto</label>
                    <input type="text" value="$250">
                </div>

                <div>
                    <label for="estatus">Comentario</label>
                    <input type="text" value="EPP y transporte de ECA">
                </div>

                <button type="button" class="button button--primary button--submit">Agregar</button>
            </form>`

        
    const showModalEditar = (e) => {
        const father = e.target.parentNode.parentNode;
        if (!showingModalEditar) {
            father.appendChild(modalEditar);
            showingModalEditar = true;
        }
    }
    const closeModalEditar = () => {
        modalEditar.remove();
        showingModalEditar = false;
    }
    
    botonesEditar.forEach(boton => {
        boton.addEventListener('click', showModalEditar);
    });

</script>