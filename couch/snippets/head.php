<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        
        <cms:capture into='cur_site_title'>
            <cms:get_custom_field var='site_title' masterpage='index.php' />
        </cms:capture>
        <cms:if "<cms:not_empty cur_site_title />">
            <title><cms:show cur_site_title /></title>
        </cms:if>

        <!-- Bootstrap core CSS -->
        <link href="<cms:show k_site_link />vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<cms:show k_site_link />css/main.css" rel="stylesheet">
        
        <!-- Favikonos rodymas -->
        <cms:capture into='cur_site_favicon'>
            <cms:get_custom_field var='site_favicon' masterpage='index.php' />
        </cms:capture>
        <cms:if "<cms:not_empty cur_site_favicon />">
            <link rel="shortcut icon" href="<cms:show cur_site_favicon />" type="image/x-icon">
            <link rel="icon" href="<cms:show cur_site_favicon />" type="image/x-icon">
        </cms:if>
    </head>

    <body>