<template>
    <div class="container my-5">
        <h2>Restaurantes</h2>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="restaurante in this.restaurantes"
                v-bind:key="restaurante.id"
            >
                <div class="card">
                    <div class="card-body">
                        <img
                            :src="`/storage/${restaurante.imagen_principal}`"
                            alt="img"
                            class="card-img-top"
                        />
                        <h3
                            class=" my-4 text-center card-title text-primary font-weight-bold"
                        >
                            {{ restaurante.nombre }}
                        </h3>
                        <p class="card-text">{{ restaurante.direccion }}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario</span>
                            {{ restaurante.apertura }} -
                            {{ restaurante.cierre }}
                        </p>
                        <a href="" class="btn btn-primary d-block">
                            Ver Lugar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        axios.get("/api/categorias/restaurante").then(res => {
            this.$store.commit("AGREGAR_RESTAURANTES", res.data);
        });
    },
    computed: {
        restaurantes() {
            return this.$store.state.restaurantes;
        }
    }
};
</script>
