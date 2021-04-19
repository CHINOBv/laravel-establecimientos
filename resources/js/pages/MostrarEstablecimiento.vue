<template>
    <div class="container my-5">
        <h2 class="text-center mb-5">{{ establecimiento.nombre }}</h2>
        <div class="row align-items-start">
            <div class="col-md-8">
                <img
                    :src="`../storage/${establecimiento.imagen_principal}`"
                    alt="img"
                    class="img-fluid"
                />
                <p class="mt-3 text-black">
                    {{ establecimiento.descripcion }}
                </p>
            </div>
            <aside class="col-md-4">
                <div class="bg-primary p-4">
                    <div>
                        <mapa-ubicacion />
                    </div>
                    <div class="">
                        <h2 class="text-center text-white mt-2 mb-4">
                            Mas informacion
                        </h2>
                        <p class="text-white mt-1">
                            <span class="font-weight-bold">Colonia:</span>
                            {{ establecimiento.colonia }}
                        </p>
                        <p class="text-white mt-1">
                            <span class="font-weight-bold">Horario:</span>
                            {{ establecimiento.apertura }} -
                            {{ establecimiento.cierre }}
                        </p>
                        <p class="text-white mt-1">
                            <span class="font-weight-bold">Telefono:</span>
                            {{ establecimiento.telefono }}
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</template>

<script>
import MapaUbicacion from "../components/MapaUbicacion.vue";
export default {
    components: { MapaUbicacion },
    mounted() {
        const { id } = this.$route.params;

        axios.get(`/api/establecimientos/${id}`).then(res => {
            this.$store.commit("AGREGAR_ESTABLECIMIENTO", res.data);
        });
    },

    computed: {
        establecimiento() {
            return this.$store.state.establecimiento;
        }
    }
};
</script>
