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
          'label' => 'location'
      ]);
...
```
4. create configuration file config/packages/leaflet.yaml
```
leaflet:
    map_box: 
        api_token: '%env(resolve:LEAFLET_MAPBOX_TOKEN)%'
    map: 
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
