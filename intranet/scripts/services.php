<script type="text/javascript">
	let showingModal = true;
	const buttonFiltrar = document.getElementById('buttonFiltrar');
	const modalFiltrar = document.getElementById('modalFiltrar');
	const main = document.getElementById('main');

	buttonFiltrar.addEventListener('click', showModalFiltrar);

	function showModalFiltrar() {
	    if (!showingModal) {
	        main.removeChild(modalFiltrar);
	        showingModal = true;
	    } else {
	        main.appendChild(modalFiltrar);
	        showingModal = false;
	    }
	}
</script>