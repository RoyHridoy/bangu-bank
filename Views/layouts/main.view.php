<?php use App\Core\Application;?>
<!DOCTYPE html>
<html
  class="h-full bg-white"
  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
          'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
          'Helvetica Neue', sans-serif;
      }
    </style>
{{content}}
<?php if ( Application::$app->session->getFlash( 'success' ) ): ?>
  <section class="font-semibold bg-emerald-200 px-6 py-3 border border-emerald-900 text-emerald-900 text-center w-fit absolute top-10 left-0 right-0 mx-auto rounded-lg">
    <?php echo Application::$app->session->getFlash( 'success' ); ?>
  </section>
<?php endif;?>

<?php if ( Application::$app->session->getFlash( 'error' ) ): ?>
  <section class="font-semibold bg-red-200 px-6 py-3 border border-red-900 text-red-900 text-center w-fit absolute top-10 left-0 right-0 mx-auto  rounded-lg">
    <?php echo Application::$app->session->getFlash( 'error' ); ?>
  </section>
<?php endif;?>
</body>
</html>
