<header class="py-10">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Transfer Balance
            </h1>
          </div>
        </header>
      </div>

      <main class="-mt-32">
        <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="p-2 bg-white rounded-lg">
            <!-- Current Balance Stat -->
            <dl
              class="grid grid-cols-1 gap-px mx-auto sm:grid-cols-2 lg:grid-cols-4">
              <div
                class="flex flex-wrap items-baseline justify-between px-4 py-10 bg-white gap-x-4 gap-y-2 sm:px-6 xl:px-8">
                <dt class="text-sm font-medium leading-6 text-gray-500">
                  Current Balance
                </dt>
                <dd
                  class="flex-none w-full text-3xl font-medium leading-10 tracking-tight text-gray-900">
                  $ <?php echo $model ? $model->balance : 0; ?>
                </dd>
              </div>
            </dl>

            <hr />
            <!-- Transfer Form -->
            <div class="sm:rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <div class="mt-4 text-sm text-gray-500">

                <?php use App\Core\Form\Form; $form = Form::start()?>
                    <div class="relative mt-2 rounded-md">
					  <?php echo $form->field( $model, 'email' )->emailField()->setPlaceholder("Recipient's Email Address")->setClasses( "block w-full py-2 text-gray-800 border-b outline-none ring-0 placeholder:text-gray-400 md:text-4xl" ); ?>
                    </div>
                    
                	  <div class="relative mt-2 rounded-md">
                      <div
                        class="absolute inset-y-0 left-0 flex items-center pl-0 pointer-events-none">
                        <span class="text-gray-400 sm:text-4xl">$</span>
                      </div>
					  <?php echo $form->field( $model, 'amount' )->numberField()->setPlaceholder("0.00")->setClasses( "block w-full py-2 pl-4 text-xl text-gray-800 border-b outline-none ring-0 sm:pl-8 border-b-emerald-500 placeholder:text-gray-400 sm:text-4xl" ); ?>
                    </div>

                    <div class="mt-5">
                      <button
                        type="submit"
                        class="w-full px-6 py-3.5 text-base font-medium text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 rounded-lg sm:text-xl text-center">
                        Proceed
                      </button>
                    </div>
                  <?php Form::end()?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>