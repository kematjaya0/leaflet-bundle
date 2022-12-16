# leaflet-bundle
symfony bundle base on leaflet js for selecting location using map
1. Installation
```
composer kematjaya/leaflet-bundle
```
2. add to config/bundles.php
```
// add to config/bundles.php
...
Kematjaya\LeafletBundle\LeafletBundle::class => ['all' => true]
...
```
3. add to form
```
// src/Form/AddressType.php
...
use Kematjaya\LeafletBundle\Type\LeafletMapType
...
$builder
      ->add('location', LeafletMapType::class, [
          'label' => 'location',
          "map_height" => "350px", // default 250px
          "map_width" => "100%", // default 100%
      ]);
...
```
4. create configuration file config/packages/leaflet.yaml
```
leaflet:
    map_box: 
        api_token: '%env(resolve:LEAFLET_MAPBOX_TOKEN)%'
    map: 
        lock_at_center: true # lock map at center point, default true
        min_zoom: 8          # minimal zoom available, default 8
        max_zoom: 20         # maximal zoom available, default 20
        zoom_value: 11       # default zoom when map loaded
        on_click_zoom: 14    # zoom when map clicked, default 14
        center_point: '%env(resolve:LEAFLET_MAP_CENTER_POINT)%'
        zoom_point: '%env(resolve:LEAFLET_MAP_CENTER_POINT)%'
```
and add value to .env
```
LEAFLET_MAPBOX_TOKEN=your.mapbox.token
LEAFLET_MAP_CENTER_POINT=longlat point ## example: '-7.293421341699741, 112.73709354459358'
```
4. use distance calculator
```
...
use Kematjaya\LeafletBundle\Calculator\Point;
use Kematjaya\LeafletBundle\Calculator\DistanceCalculatorInterface;
...
public function test(DistanceCalculatorInterface $distanceCalculator) 
{
    $from = new Point(-7.345728218434821, 112.76383132697055);
    $to = new Point(-7.2491223553386375, 112.79650342712807);

    $distance = $distanceCalculator->getDistance($from, $to); // in KM
}
```
