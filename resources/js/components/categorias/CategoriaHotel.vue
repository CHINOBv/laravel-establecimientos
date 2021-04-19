<template>
    <div class="container my-5">
        <h2>Hoteles</h2>
        <div class="row">
            <div
                class="col-md-4 mt-4"
                v-for="hotel in this.hoteles"
                v-bind:key="hotel.id"
            >
                <div class="card">
                    <div class="card-body">
                        <img
                            :src="`/storage/${hotel.imagen_principal}`"
                            alt="img"
                            class="card-img-top"
                        />
                        <h3
                            class=" my-4 text-center card-title text-primary font-weight-bold"
                        >
                            {{ hotel.nombre }}
                        </h3>
                        <p class="card-text">{{ hotel.direccion }}</p>
                        <p class="card-text">
                            <span class="font-weight-bold">Horario</span>
                            {{ hotel.apertura }} -
                            {{ hotel.cierre }}
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
        axios.get("/api/categorias/hotel").then(res => {
            this.$store.commit("AGREGAR_HOTELES", res.data);
        });
    },
    computed: {
        hoteles() {
            return this.$store.state.hoteles;
        }
    }
};
</script>
