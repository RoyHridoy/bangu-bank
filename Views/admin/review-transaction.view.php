<?php use App\Core\Application;
use App\Core\Form\Form;

 ?>
<header class="py-10">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Review Transactions
            </h1>
          </div>
        </header>
      </div>

      <main class="-mt-32">
        <div class="px-4 pb-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="py-8 bg-white rounded-lg">
            <!-- List of All The Transactions -->
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <p class="mt-2 text-sm text-gray-700">
                    List of transactions (needs to review).
                  </p>
                </div>
              </div>
              <div class="flow-root mt-8">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                  <div
                    class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead>
                        <tr>
                          <th
                            scope="col"
                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Customer Name
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Email
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Amount
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Date
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">

                        <?php foreach ( array_reverse($transactions) as $transaction ): ?>
                          <tr>
                            <td
                              class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                              <?php $user = Application::$app->getUserBy('id',$transaction['user_id'])[1]; echo "{$user['firstName']} {$user['lastName']}" ?>
                            </td>

                            <td
                              class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                              <?php echo "{$user['email']}"; ?>
                            </td>

                            <td
                              class="px-2 py-4 text-sm font-medium whitespace-nowrap <?php echo $transaction['type'] === 'deposit' ? "text-emerald-600" : 'text-red-600'; ?> ">
                              <?php echo $transaction['type'] === 'deposit' ? "+" : '-'; ?>$<?php echo number_format( $transaction['amount'], 2 ); ?>
                            </td>
                            <td
                              class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                              <?php echo date( "d M Y, h:m:s A", $transaction['created_at'] ) ?>
                            </td>
                            <td
                              class="flex items-center justify-center gap-2 px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                                <div class="text-3xl">
                                  <?php Form::start() ?>
                                  <input type="number" class="hidden" name="transactionId" value="<?php echo $transaction['id']; ?>">
                                  <input type="number" class="hidden" name="status" value="1">
                                  <button class="!my-0" type="submit">✅</button>
                                  <?php Form::end(); ?>
                                </div>
                                <div class="text-3xl">
                                    <?php Form::start() ?>
                                    <input type="number" class="hidden" name="transactionId" value="<?php echo $transaction['id']; ?>">
                                    <input type="number" class="hidden" name="status" value="0">
                                    <button class="!my-0" type="submit">⛔</button>
                                    <?php Form::end(); ?>
                                </div>
                            </td>
                          </tr>

                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>