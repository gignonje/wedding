<?php

namespace Shadow\WeddingBundle\Controller;

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
     * @Route("/programme", name="program")
     * @Template()
     */
    public function programAction()
    {
        return [];
    }

    /**
     * @Route("/remerciements", name="thanks")
     * @Template()
     */
    public function thanksAction()
    {
        return [];
    }

    /**
     * @Route("/voyage", name="journey")
     * @Template()
     */
    public function journeyAction()
    {
        return [];
    }

    /**
     * @Route("/info", name="info")
     * @Template()
     */
    public function infoAction(Request $request)
    {
        $mapPierrefonds = $this->get('ivory_google_map.map');
        $mapPierrefonds->setAsync(false);
        $mapPierrefonds->setHtmlContainerId("map_pierrefonds");
        $mapPierrefonds->setAutoZoom(true);
        $mapPierrefonds->setLanguage('fr');
        $mapPierrefonds->setStylesheetOption('width', '100%');
        $mapPierrefonds->setStylesheetOption('height', '950px');
        $mapPierrefonds->setPrefixJavascriptVariable('map_pierrefonds_');
        $mapPierrefonds->setMapOptions(
            [
                'disableDefaultUI'       => false,
                'mapTypeId'              => 'hybrid',
            ]
        );

        $mapPlessis = $this->get('ivory_google_map.map');
        $mapPlessis->setAsync(false);
        $mapPlessis->setHtmlContainerId("map_plessis");
        $mapPlessis->setAutoZoom(true);
        $mapPlessis->setLanguage('fr');
        $mapPlessis->setStylesheetOption('width', '100%');
        $mapPlessis->setStylesheetOption('height', '950px');
        $mapPlessis->setPrefixJavascriptVariable('map_plessis_');
        $mapPlessis->setMapOptions(
            [
                'disableDefaultUI'       => false,
                'mapTypeId'              => 'hybrid',
            ]
        );

        $internAddress = "1 rue Sabatier, 60350 Pierrefonds";
        $receptionAddress = "8 rue Sabatier, 60350 Pierrefonds";
        $townHallAddress = "76 Rue Edouard Meunier, 60150 Le Plessis-Brion";
        $churchAddress = "19 rue de l’église, 60150 Le Plessis-Brion";

        try {
            $internMarker = new Marker(new Coordinate(49.346917, 2.976136));
            $internMarker->setInfoWindow(
                new InfoWindow(
                    "<strong>Internat agricole de l’Institut Charles Quentin</strong><br />(En face du domaine des thermes)<br /><br /> $internAddress"
                )
            );
            $internMarker->setIcon(
                $this->container->get('templating.helper.assets')->getUrl(
                    "bundles/shadowwedding/images/mapicons/bed.png"
                )
            );

            $receptionMarker = new Marker(new Coordinate(49.347099, 2.976179));
            $receptionMarker->setInfoWindow(
                new InfoWindow(
                    "<strong>Domaine des Thermes de Pierrefonds</strong><br /><br /> $receptionAddress"
                )
            );
            $receptionMarker->setIcon(
                $this->container->get('templating.helper.assets')->getUrl(
                    "bundles/shadowwedding/images/mapicons/wedding.png"
                )
            );

            $townHallMarker = new Marker(new Coordinate(49.467385, 2.891195));
            $townHallMarker->setInfoWindow(
                new InfoWindow(
                    "<strong>Mairie de le Plessis-Brion</strong><br /><br /> $townHallAddress"
                )
            );
            $townHallMarker->setIcon(
                $this->container->get('templating.helper.assets')->getUrl(
                    "bundles/shadowwedding/images/mapicons/reception.png"
                )
            );

            $churchMarker = new Marker(new Coordinate(49.466832, 2.893069));
            $churchMarker->setInfoWindow(
                new InfoWindow(
                    "<strong>Église de le Plessis-Brion</strong><br /><br /> $churchAddress"
                )
            );
            $churchMarker->setIcon(
                $this->container->get('templating.helper.assets')->getUrl(
                    "bundles/shadowwedding/images/mapicons/church.png"
                )
            );

            $mapPierrefonds->addMarker($internMarker);
            $mapPierrefonds->addMarker($receptionMarker);
            $mapPlessis->addMarker($townHallMarker);
            $mapPlessis->addMarker($churchMarker);
        } catch (\Exception $e) {
            $logger = $this->get('logger');
            $logger->error('Map error: ' . $e->getMessage());
        }

        return [
            'map_pierrefonds' => $mapPierrefonds,
            'map_plessis'     => $mapPlessis,
        ];
    }
}
