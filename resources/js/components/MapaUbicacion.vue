<template>
    <div class="mapa">
        <l-map :zoom="zoom" :center="center">
            <l-tile-layer
                :url="url"
                :attribution="attribution"
                :options="mapOptions"
            />
            <l-marker :lat-lng="{ lat, lng }">
                <l-tooltip>
                    <div>{{ establecimiento.nombre }}</div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
import { latLng } from "leaflet";
import { LMap, LTileLayer, LMarker, LTooltip } from "vue2-leaflet";

export default {
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LTooltip
    },
    data() {
        return {
            zoom: 16,
            center: latLng(20.666332695977, -103.392177745699),
            url: "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
            attribution:
                '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            currentZoom: 11.5,
            mapOptions: {
                zoomSnap: 0.5
            },
            showMap: true,
            lat: "",
            lng: ""
        };
    },

    created() {
        setTimeout(() => {
            this.lat = this.$store.state.establecimiento.lat;
            this.lng = this.$store.state.establecimiento.lng;
            this.center = latLng(this.lat, this.lng);
        }, 900);
    },

    computed: {
        establecimiento() {
            return this.$store.state.establecimiento;
        }
    }
};
</script>

<style scoped>
@import "https://unpkg.com/leaflet@1.7.1/dist/leaflet.css";
.mapa {
    height: 300px;
    width: 100%;
}
</style>
