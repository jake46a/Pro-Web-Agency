<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @package Bootstrap 4.1
 * @subpackage  Timber
 * @since    Timber 0.1
 *
 */

$context = Timber::get_context();
Timber::render( '404.twig', $context );
