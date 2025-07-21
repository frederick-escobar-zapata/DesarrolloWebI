<span class="text-light">
    <i class="bi bi-currency-exchange"></i> 
    UF: 
    <strong id="uf-valor">Cargando...</strong>
</span>

<script>
document.addEventListener('DOMContentLoaded', function() {
    cargarUF();
});

async function cargarUF() {
    try {
        const response = await fetch('https://mindicador.cl/api');
        const data = await response.json();        
        const elemento = document.getElementById('uf-valor');               
        if (data.uf && data.uf.valor) {
            const valorUf = data.uf.valor;
            elemento.textContent = '$' + new Intl.NumberFormat('es-CL').format(valorUf);
        } else {
            elemento.textContent = 'Error';
        }
    } catch (error) {
        document.getElementById('uf-valor').textContent = 'Sin conexión';
        console.error('Error al obtener UF:', error);
    }
}
</script>
