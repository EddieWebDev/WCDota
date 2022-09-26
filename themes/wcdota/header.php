<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <div id="wrapper" class="hfeed">
    <header id="header" role="banner">

      <h2>HEADER</h2>
      <?php get_template_part("header-template"); ?>

    </header>
    <div id="container">
      <h2>CONTAINER</h2>
      <main id="main" role="main">