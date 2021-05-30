<?php

require_once 'vendor/autoload.php';

// Die Produktion wird geladen
$production = new MP\Production();

// Alle verfügbaren Status werden laden
$stateOrdered     = new MP\State\Ordered();
$statePrinted     = new MP\State\Printed();
$stateSliced      = new MP\State\Sliced();
$stateFramed      = new MP\State\Framed();
$stateGiftWrapped = new MP\State\GiftWrapped();
$stateShipped     = new MP\State\Shipped();

// 1.1 Gerahmtes Poster ohne Geschenkverpackung ohne Fehler
$framedPoster = new MP\Article(MP\Article::TYPE_POSTER_FRAMED, new \MP\ProductionStrategy\FramedPoster());
$production->confirmState($stateOrdered, $framedPoster);
$production->confirmState($statePrinted, $framedPoster);
$production->confirmState($stateSliced, $framedPoster);
$production->confirmState($stateFramed, $framedPoster);
$production->confirmState($stateShipped, $framedPoster);

// 1.2 Gerahmtes Poster ohne Geschenkverpackung mit Fehler
$framedPoster = new MP\Article(MP\Article::TYPE_POSTER_FRAMED, new \MP\ProductionStrategy\FramedPoster());
$production->confirmState($stateOrdered, $framedPoster);
$production->confirmState($stateSliced, $framedPoster); // Fehler
$production->confirmState($statePrinted, $framedPoster);
$production->confirmState($stateSliced, $framedPoster);
$production->confirmState($stateFramed, $framedPoster);
$production->confirmState($stateShipped, $framedPoster);

// 1.3 Gerahmtes Poster mit Geschenkverpackung
$framedPosterWithGiftWrapping = new MP\Article(MP\Article::TYPE_POSTER_FRAMED, new \MP\ProductionStrategy\FramedPoster());
$framedPosterWithGiftWrapping->enableGiftWrapping();
$production->confirmState($stateOrdered, $framedPosterWithGiftWrapping);
$production->confirmState($statePrinted, $framedPosterWithGiftWrapping);
$production->confirmState($stateSliced, $framedPosterWithGiftWrapping);
$production->confirmState($stateFramed, $framedPosterWithGiftWrapping);
$production->confirmState($stateGiftWrapped, $framedPosterWithGiftWrapping);
$production->confirmState($stateShipped, $framedPosterWithGiftWrapping);

// 2.1 Bedrucktes Glas ohne Geschenkverpackung
$printedGlass = new MP\Article(MP\Article::TYPE_PRINTED_GLASS, new \MP\ProductionStrategy\PrintedGlass());
$production->confirmState($stateOrdered, $printedGlass);
$production->confirmState($statePrinted, $printedGlass);
$production->confirmState($stateShipped, $printedGlass);

// 2.2 Bedrucktes Glas mit Geschenkverpackung ohne Fehler
$printedGlassWithGiftWrapping = new MP\Article(MP\Article::TYPE_PRINTED_GLASS, new \MP\ProductionStrategy\PrintedGlass());
$printedGlassWithGiftWrapping->enableGiftWrapping();
$production->confirmState($stateOrdered, $printedGlassWithGiftWrapping);
$production->confirmState($statePrinted, $printedGlassWithGiftWrapping);
$production->confirmState($stateGiftWrapped, $printedGlassWithGiftWrapping);
$production->confirmState($stateShipped, $printedGlassWithGiftWrapping);

// 2.3 Bedrucktes Glas mit Geschenkverpackung mit Fehler
$printedGlassWithGiftWrapping = new MP\Article(MP\Article::TYPE_PRINTED_GLASS, new \MP\ProductionStrategy\PrintedGlass());
$printedGlassWithGiftWrapping->enableGiftWrapping();
$production->confirmState($stateOrdered, $printedGlassWithGiftWrapping);
$production->confirmState($statePrinted, $printedGlassWithGiftWrapping);
$production->confirmState($stateShipped, $printedGlassWithGiftWrapping); // Fehler
$production->confirmState($stateGiftWrapped, $printedGlassWithGiftWrapping);
$production->confirmState($stateShipped, $printedGlassWithGiftWrapping);
