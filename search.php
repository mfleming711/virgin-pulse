<?php

$context = Timber::get_context();
$templates = array('search.twig', 'archive.twig');


Timber::render( $templates, $context );
