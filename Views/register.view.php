<title>Create A New Account</title>
  </head>
  <body class="h-full bg-slate-100">
    <div class="flex flex-col justify-center min-h-full py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2
          class="mt-6 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
          Create A New Account
        </h2>
      </div>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="px-6 py-12 bg-white shadow sm:rounded-lg sm:px-12">
          <?php use App\Core\Form\Form; $form = Form::start() ?>
            <?php echo $form->field( $model, 'firstName' )->addLabel( "First name" ); ?>
            <?php echo $form->field( $model, 'lastName' )->addLabel( "Last name" ); ?>
            <?php echo $form->field( $model, 'email' )->addLabel( "Email" )->emailField(); ?>
            <?php echo $form->field( $model, 'password' )->addLabel( "Password" )->passwordField(); ?>
            <?php echo $form->field( $model, 'confirmPassword' )->addLabel( "Confirm Password" )->passwordField(); ?>
            <div>
                  <button
                    type="submit"
                    class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                    Register
                  </button>
                </div>
            <?php Form::end() ?>

        </div>

        <p class="mt-10 text-sm text-center text-gray-500">
          Already a customer?
          <a
            href="./login"
            class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500"
            >Sign-in</a
          >
        </p>
      </div>
    </div>
