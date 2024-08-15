<header class="py-10">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Add a New Customer
            </h1>
          </div>
        </header>
      </div>

      <main class="-mt-32">
        <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="bg-white rounded-lg">


              <?php use App\Core\Form\Form; $form = Form::start() ?>
              <div class="px-4 py-6 sm:p-8">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                  <div class="sm:col-span-3">
                        <?php echo $form->field( $model, 'firstName' )->addLabel( "First name" ); ?>
                  </div>

                  <div class="sm:col-span-3">
                        <?php echo $form->field( $model, 'lastName' )->addLabel( "Last name" ); ?>
                  </div>

                  <div class="sm:col-span-6">
                        <?php echo $form->field( $model, 'email' )->addLabel( "Email" )->emailField(); ?>
                  </div>

                  <div class="sm:col-span-3">
                        <?php echo $form->field( $model, 'password' )->addLabel( "Password" )->passwordField(); ?>
                  </div>
                  <div class="sm:col-span-3">
                        <?php echo $form->field( $model, 'confirmPassword' )->addLabel( "Confirm Password" )->passwordField(); ?>
                  </div>
                </div>
              </div>
              <div
                class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
                <button
                  type="reset"
                  class="text-sm font-semibold leading-6 text-gray-900">
                  Cancel
                </button>
                <button
                  type="submit"
                  class="px-3 py-2 text-sm font-semibold text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
                  Create Customer
                </button>
              </div>
            <?php Form::end() ?>

          </div>
        </div>
      </main>