<script>
    function initMap() {
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: { lat: 55.378052, lng: -3.435973 },
      });
      // Create an array of alphabetical characters used to label the markers.
      const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
      // Add some markers to the map.
      // Note: The code uses the JavaScript Array.prototype.map() method to
      // create an array of markers based on a given "locations" array.
      // The map() method here has nothing to do with the Google Maps API.
      const markers = locations.map((location, i) => {
        return new google.maps.Marker({
          position: location,
          label: labels[i % labels.length],
        });
      });
      // Add a marker clusterer to manage the markers.
      new MarkerClusterer(map, markers, {
        imagePath:
          "https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
      });
    }



    const locations = [
        <?php
            $args = array(
                'post_type' => 'stockists',
                'posts_per_page' => -1
            );
            $places = new WP_Query($args);
            if($places->have_posts()){
                while($places->have_posts()) {
                   $places->the_post(); ?>
                   <?php if (get_field('lat')) : ?>
                    {lat:<?php echo get_field('lat') ?>, lng:<?php echo get_field('long') ?>},
                   <?php endif; ?>
            <?php } ?>
            <?php wp_reset_postdata(); ?>
        <?php } ?>
    ];


</script>


<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="https://unpkg.com/@google/markerclustererplus@4.0.1/dist/markerclustererplus.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHWvE3TtdAohd5wrGYQDNtP3-RS2FDJ-M&callback=initMap&libraries=&v=weekly" defer></script>

<section class='clusterMap'>
    <div class='grid-container full'>
        <div class='grid-x'>
            <div class='large-12 cell'>
                <div id="map"></div>
            </div>
        </div>
    </div>
</section>
