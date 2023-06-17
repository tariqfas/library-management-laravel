<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <x-slot name="title">
        {{__('Report')}}
    </x-slot>
   
    <div class="container my-10">
        <div class="grid gridcols-1 md:grid-cols-2">
        <div class="bg-purple-600 p-5">
            <h1 class="text-4xl text-white">Date Wire Report</h1>
            <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " wire:model="dateReport" type="text"/>
            <button type="submit" class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" wire:click.prevent="getDateReport">
            Date Wire Report
        </button>
        </div>
        <div class="bg-purple-600 p-5">
            <h1 class="text-4xl text-white">Date Wire Report</h1>
        </div>
        </div>
        <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <!-- Search Issue Book -->
            <input class="w-100 py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="Search Book ..." wire:model="" type="text" />
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Id</th>
                        <th class="px-4 py-3">Student</th>
                        <th class="px-4 py-3">Book</th>
                        <th class="px-4 py-3">Issue Date</th>
                        <th class="px-4 py-3">Return Date</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <!--loop for Books -->
                    @if($reports != "")
                    @foreach($reports as $report)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold"> {{$report->id}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$report->student->name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$report->book->book_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$report->issue_date}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$report->return_date}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                        @if($report->issue_status=='N')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100"
                            >
                                Not return
                            </span>
                            @else
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-700"
                            >
                                 return
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif


                </tbody>
            </table>
            <div>
                {{--<!-- {{$reports->links()}} -->--}}
            </div>
        </div>
    </div>
    </div>

  

</div>
