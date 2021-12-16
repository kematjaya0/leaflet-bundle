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
