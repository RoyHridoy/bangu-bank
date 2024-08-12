<header class="py-10">
          <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-white">
              Howdy, <?php echo "{$user['firstName']} {$user['lastName']}"; ?> 👋
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
                  $ <?php echo $model ? number_format( $model->balance, 2 ) : 0; ?>
                </dd>
              </div>
            </dl>

            <!-- List of All The Transactions -->
            <div class="px-4 sm:px-6 lg:px-8">
              <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                  <p class="mt-2 text-sm text-gray-700">
                    Here's a list of all your transactions which inlcuded
                    receiver's name, email, amount and date.
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
                            Name
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                            Email
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap text-right pr-10 px-2 py-3.5 text-sm font-semibold text-gray-900">
                            Amount
                          </th>
                          <th
                            scope="col"
                            class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                            Date
                          </th>
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ( $model->getAllTransactionByUserId( $model->currentUserId ) as $transaction ): ?>
                          <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            <?php echo "{$transaction['user']['firstName']} {$transaction['user']['lastName']}" ?>
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            <?php echo $transaction['email'] ?>
                          </td>
                          <td
                            class="px-2 text-right py-4 pr-10 text-sm font-medium whitespace-nowrap <?php echo $transaction['type'] === 'deposit' ? "text-emerald-600" : 'text-red-600'; ?> ">
                            <?php echo $transaction['type'] === 'deposit' ? "+" : '-'; ?>$<?php echo number_format( $transaction['amount'], 2 ); ?>
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            <?php echo date( "d M Y, h:m:s A", $transaction['created_at'] ) ?>
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