<?php

namespace Shadow\WeddingBundle\Controller;

use Geocoder\Geocoder;
use Geocoder\HttpAdapter\CurlHttpAdapter;
use Geocoder\Provider\GoogleMapsProvider;
use Ivory\GoogleMap\Base\Coordinate;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\Marker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return [];
    }

    /**
     * @Route("/contact", name="contact")
     * @Template()
     */
    public function contactAction()
    {
        return [];
    }

    /**
     * @Route("/info", name="info")
     * @Template()
     */
    public function infoAction(Request $request)
    {
        $map = $this->get('ivory_google_map.map');
        $map->setAsync(true);
        $map->setHtmlContainerId("hostel_map");

        $address = "20 rue Tristan Bernard, 78340 Les Clayes sous Bois";

        $geocoder = new Geocoder();
        $adapter  = new CurlHttpAdapter();
        $provider = new GoogleMapsProvider($adapter);
        $geocoder->registerProvider($provider);

        $result = $geocoder->geocode($address);

        try {
            $map->setCenter($result->getLatitude(), $result->getLongitude());
            $map->setMapOption('zoom', 16);

            $marker = new Marker(new Coordinate($result->getLatitude(), $result->getLongitude()));
            $marker->setInfoWindow(
                new InfoWindow(
                    "<strong>Hôtel</strong><br /> $address"
                )
            );

            $map->addMarker($marker);
        } catch (\Exception $e) {
            $logger = $this->get('logger');
            $logger->error('Map error: '.$e->getMessage());
        }

        return [
            'map' => $map,
        ];
    }
}
