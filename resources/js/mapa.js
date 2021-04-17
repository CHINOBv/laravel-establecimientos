//const { default: axios } = require("axios");
import { OpenStreetMapProvider } from "leaflet-geosearch";
import { map } from "lodash";
const provider = new OpenStreetMapProvider();

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const reversCode = async pos => {
            var requestOptions = {
                method: "GET",
                redirect: "follow"
            };

            const res = await fetch(
                `https://revgeocode.search.hereapi.com/v1/revgeocode?at=${pos.lat},${pos.lng}&lang=en-US&apiKey=7L_gK7VQHY3sp3KtHvEZeOgWriGdM7YUc567W9DuuzU`,
                requestOptions
            );

            return res.json();
        };
        const lat = 25.6490376;
        const lng = -100.44318;

        const mapa = L.map("mapa").setView([lat, lng], 16);

        let markers = new L.featureGroup().addTo(mapa);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;

        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true
        }).addTo(mapa);
        markers.addLayer(marker);

        const buscarDireccion = e => {
            if (e.target.length < 10) return;

            provider
                .search({
                    query: e.target.value + " Nuevo Leon MX"
                })
                .then(res => {
                    if (!res[0]) return;

                    markers.clearLayers();

                    reversCode({
                        lat: res[0].bounds[0][0],
                        lng: res[0].bounds[0][1]
                    }).then(res => {
                        const { position } = res.items[0];
                        llenarInputs(res.items[0]);

                        mapa.setView(position);

                        marker = new L.marker(position, {
                            draggable: true,
                            autoPan: true
                        }).addTo(mapa);

                        markers.addLayer(marker);
                        reubicarPin(marker);
                    });
                })
                .catch(err => console.log(err));
        };

        let search = document.querySelector("#formbuscador");
        search.addEventListener("blur", buscarDireccion);

        reubicarPin(marker);

        function reubicarPin(marker) {
            marker.on("moveend", async function(e) {
                marker = e.target;

                let pos = await marker.getLatLng();

                mapa.panTo(new L.LatLng(pos.lat, pos.lng));

                reversCode(pos)
                    .then(res => {
                        marker.bindPopup(res.items[0].title);
                        marker.openPopup();
                        //  console.log(res);
                        return res;
                    })
                    .then(result => llenarInputs(result.items[0]));
            });
        }

        function llenarInputs(data) {
            document.querySelector("#direccion").value =
                data.address.street + " " + data.address.houseNumber || "";
            document.querySelector("#colonia").value =
                data.address.district || "";
            document.querySelector("#lat").value = data.position.lat || "";
            document.querySelector("#lat").value = data.position.lng || "";
            //console.log(data);
        }
    }
});
