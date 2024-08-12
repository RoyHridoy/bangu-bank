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
                  $10,115,091.00
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
                            Receiver Name
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
                        </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            Bruce Wayne
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            bruce@wayne.com
                          </td>
                          <td
                            class="px-2 py-4 text-sm font-medium whitespace-nowrap text-emerald-600">
                            +$10,240
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            29 Sep 2023, 09:25 AM
                          </td>
                        </tr>
                        <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            Al Nahian
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            alnahian@2003.com
                          </td>
                          <td
                            class="px-2 py-4 text-sm font-medium text-red-600 whitespace-nowrap">
                            -$2,500
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            15 Sep 2023, 06:14 PM
                          </td>
                        </tr>
                        <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            Muhammad Alp Arslan
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            alp@arslan.com
                          </td>
                          <td
                            class="px-2 py-4 text-sm font-medium whitespace-nowrap text-emerald-600">
                            +$49,556
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            03 Jul 2023, 12:55 AM
                          </td>
                        </tr>

                        <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            Povilas Korop
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            povilas@korop.com
                          </td>
                          <td
                            class="px-2 py-4 text-sm font-medium whitespace-nowrap text-emerald-600">
                            +$6,125
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            07 Jun 2023, 10:00 PM
                          </td>
                        </tr>

                        <tr>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-800 whitespace-nowrap sm:pl-0">
                            Martin Joo
                          </td>
                          <td
                            class="py-4 pl-4 pr-3 text-sm text-gray-500 whitespace-nowrap sm:pl-0">
                            martin@joo.com
                          </td>
                          <td
                            class="px-2 py-4 text-sm font-medium text-red-600 whitespace-nowrap">
                            -$125
                          </td>
                          <td
                            class="px-2 py-4 text-sm text-gray-500 whitespace-nowrap">
                            02 Feb 2023, 8:30 PM
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>