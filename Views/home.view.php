<title>Bangubank</title>
  </head>
  <body class="flex flex-col items-baseline justify-center min-h-screen">
    <section
      class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-12">
      <h1
        class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl">
        BanguBank
      </h1>
      <p
        class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48">
        BanguBank is a simple banking application with features for both 'Admin'
        and 'Customer' users. It's a HTML template starter pack for students of
        <span class="font-semibold"
          >Laravel Career Path by Interactive Cares</span
        >.
      </p>
      <div
        class="flex flex-col gap-2 mb-8 lg:mb-16 md:flex-row md:justify-center">
        <?php if ( !$user ): ?>
        <a
          href="./login"
          type="button"
          class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
          Login
        </a>

        <a
          href="./register"
          type="button"
          class="text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
          Register as Customer
        </a>
        <?php endif;?>
        <?php if ( $user && $user['role'] === 'admin' ): ?>
        <a
          href="./admin/customers"
          type="button"
          class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
          Admin View
        </a>
        <?php endif;?>
        <?php if ( $user && $user['role'] === 'user' ): ?>
        <a
          href="./customer/dashboard"
          type="button"
          class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
          Customer View
        </a>
        <?php endif;?>
      </div>
    </section>
