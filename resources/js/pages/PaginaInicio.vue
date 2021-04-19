<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
        <categoria-cafe />
        <categoria-restaurante />
        <categoria-hotel />
    </div>
</template>

<script>
import store from "../store";

import CategoriaCafe from "../components/categorias/CategoriaCafe";
import CategoriaHotel from "../components/categorias/CategoriaHotel.vue";
import CategoriaRestaurante from "../components/categorias/CategoriaRestaurante";

export default {
    store,
    components: {
        CategoriaCafe,
        CategoriaRestaurante,
        CategoriaHotel
    }
};
</script>
