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
  <section class="absolute left-0 right-0 px-6 py-3 mx-auto font-semibold text-center border rounded-lg bg-emerald-200 border-emerald-900 text-emerald-900 w-fit top-10">
    <?php echo Application::$app->session->getFlash( 'success' ); ?>
  </section>
<?php endif;?>

<?php if ( Application::$app->session->getFlash( 'error' ) ): ?>
  <section class="absolute left-0 right-0 px-6 py-3 mx-auto font-semibold text-center text-red-900 bg-red-200 border border-red-900 rounded-lg w-fit top-10">
    <?php echo Application::$app->session->getFlash( 'error' ); ?>
  </section>
<?php endif;?>
</body>
</html>
