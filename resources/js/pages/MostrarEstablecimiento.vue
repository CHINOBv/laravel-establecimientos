<template>
    <h1>Estab</h1>
</template>

<script>
export default {
    mounted() {
        axios.get("/api/establecimientos/1").then(res => console.log(res));
    }
};
</script>
