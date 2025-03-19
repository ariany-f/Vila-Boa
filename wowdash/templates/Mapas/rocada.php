<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div id="search-container">
                <input id="search-box" type="text" placeholder="Digite um endereço...">
                <button id="search-button"><iconify-icon icon="mage:search" class="menu-icon"></iconify-icon>Buscar</button>
            </div>
            <div id='map_rocada'></div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" crossorigin=""></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXNhLFLrxHDmza7jFYq-BQsIB2ZJUE11A"></script>
    <script src="<?= $this->Url->assetUrl('data/RocadaSetor00.js') ?>"></script>
    <script type="text/javascript">
       document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map_rocada').setView([-23.756350209308938, -46.56567919142369], 12);
            var markersLayer = L.layerGroup().addTo(map);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Redimensiona o mapa após o carregamento da página
            setTimeout(function() {
                map.invalidateSize();
            }, 100);

            // Redimensiona o mapa ao redimensionar a janela
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });

            document.getElementById('search-button').addEventListener('click', function() {
                var address = document.getElementById('search-box').value;
                if (!address) {
                    alert("Por favor, digite um endereço.");
                    return;
                }

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address': address, 'componentRestrictions': { 'locality': 'São Bernardo do Campo', 'country': 'BR' } }, function (results, status) {
                    if (status === 'OK') {
                        var validResult = results.find(result => result.formatted_address.includes("São Bernardo do Campo"));
                        
                        if (validResult) {
                            var location = validResult.geometry.location;
                            var latLng = [location.lat(), location.lng()];
                            map.setView(latLng, 16);
                            
                            markersLayer.clearLayers();
                            L.marker(latLng).addTo(markersLayer)
                                .bindPopup(validResult.formatted_address)
                                .openPopup();
                        } else {
                            alert('O endereço não pertence a São Bernardo do Campo.');
                        }
                    } else {
                        alert('Endereço não encontrado: ' + status);
                    }
                });
            });


            function getColor(description) {
                return description === 'A.AJARDINADAS 045' ? "#006400" :
                    description == 'CORTE DE MATO 070' ? "#1790e5" :
                    description == 'CORTE DE MATO 120' ? "#ff8200" : "#cc0000";
            }

            function style(feature) {
                if (!feature.properties || !feature.properties.description) {
                    console.warn("Polígono ignorado: propriedade 'description' ausente.");
                    return {};
                }

                var color = getColor(feature.properties.description);
                return {
                    weight: 5,
                    opacity: 1,
                    color: color,
                    fillColor: color,
                    fillOpacity: 0.9,
                    dashArray: '3',
                };
            }

            function highlightFeature(e) {
                var layer = e.target;
                layer.setStyle({
                    weight: 8,
                    color: '#666',
                    dashArray: '',
                });
                if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                    layer.bringToFront();
                }
            }

            function resetHighlight(e) {
                geojson.resetStyle(e.target);
            }

            function onEachFeature(feature, layer) {
                if (feature.properties && feature.properties.Name) {
                    layer.bindPopup("<b>" + feature.properties.Name + "</b><br>Descrição: " + (feature.properties.description || 'Descrição indisponível')+ "<br>Equipe: " + (feature.properties.agent || 'Última Execução indisponível') + "<br>Última Execução: " + (feature.properties.last || 'Última Execução indisponível'));
                } else {
                    console.warn("Polígono ignorado: propriedade 'Name' ausente.");
                }
                layer.on({
                    mouseover: highlightFeature,
                    mouseout: resetHighlight,
                });
            }

            geojson = L.geoJson(statesData, {
                style: style,
                onEachFeature: onEachFeature,
                filter: function(feature) {
                    return feature.properties && feature.properties.description;
                }
            }).addTo(map);

            var legend = L.control({ position: 'bottomleft' });
            legend.onAdd = function(map) {
                var div = L.DomUtil.create('div', 'info legend');
                var labels = ['<strong>Legenda</strong>'];
                var categories = ['A.AJARDINADAS 045', 'CORTE DE MATO 070', 'CORTE DE MATO 120'];

                for (var i = 0; i < categories.length; i++) {
                    div.innerHTML += labels.push(
                        '<i class="circle" style="background:' + getColor(categories[i]) + '"></i> ' +
                        (categories[i] ? categories[i] : '+'));
                }
                div.innerHTML = labels.join('<br>');
                return div;
            };
            legend.addTo(map);
        });
    </script>
<?php $this->end(); ?>