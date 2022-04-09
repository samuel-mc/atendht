let showingModal = true;
const buttonFiltrar = document.getElementById('buttonFiltrar');
const modalFiltrar = document.createElement("div");


modalFiltrar.classList.add('main__modal', 'main__modal--filtrar')
modalFiltrar.setAttribute('id', 'modalFiltrar')
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

buttonFiltrar.addEventListener('click', showModalFilrar);

function showModalFilrar() {
    if (!showingModal) {
        main.removeChild(modalFiltrar);
        showingModal = true;
    } else {
        main.appendChild(modalFiltrar);
        showingModal = false;
    }
}