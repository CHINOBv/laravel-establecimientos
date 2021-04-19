<template>
    <div>
        <categoria-cafe />
        <categoria-restaurante />
        <categoria-hotel />
    </div>
</template>

<script>
import CategoriaCafe from "../components/categorias/CategoriaCafe";
import CategoriaHotel from "../components/categorias/CategoriaHotel.vue";
import CategoriaRestaurante from "../components/categorias/CategoriaRestaurante";

export default {
    components: {
        CategoriaCafe,
        CategoriaRestaurante,
        CategoriaHotel
    }
};
</script>
