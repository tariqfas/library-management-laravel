<div>
    <x-slot name="title">{{__('Student')}}</x-slot>
    <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple" >
        <div class="flex items-center">
            <span>{{__('Students')}} {{"($nbrStudent)"}}</span>
        </div>
        <span>
            <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            wire:click="showForm"
            >
                Create Student
            </button>
        </span>
    </a>
    @if(session()->has('success'))
    <div class="bg-green-400 p-5 rounded my-2">
        <b>{{session('success')}}</b>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="bg-green-400 p-5 rounded my-2">
        <b>{{session('error')}}</b>
    </div>
    @endif
    @if($showTable==true)
    <!-- Student table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <!-- Search Student -->
            <input class="w-100 py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" 
            placeholder="Search Student ..."
            wire:model="search"
            type="text" />
            <!-- {{$search}} -->
            @if($students)
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Id</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Address</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Classes</th>
                        <th class="px-4 py-3">Actions</th>
                        <!-- <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Actions</th> -->
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($students as $student)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold">{{$student->id}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$student->name}}
                        </td>
                        
                        <td class="px-4 py-3 text-sm">{{$student->email}}</td>
                        <td class="px-4 py-3">{{$student->address}}</td>
                        <td class="px-4 py-3">{{$student->gender}}</td>
                        <td class="px-4 py-3">{{$student->phone}}</td>
                        <td class="px-4 py-3">{{$student->classes}}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit"
                                    wire:click="editForm({{$student->id}})"
                                >
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete"
                                    wire:click="deleteStudent({{$student->id}})"
                                >
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p>No Student</p>
            @endif
        </div>
        <!-- <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
            <span class="flex items-center col-span-3">
                Showing 21-30 of 100
            </span>
            <span class="col-span-2"></span>
             Pagination
            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                1
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                2
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple">
                                3
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                4
                            </button>
                        </li>
                        <li>
                            <span class="px-3 py-1">...</span>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                8
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">
                                9
                            </button>
                        </li>
                        <li>
                            <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                    <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div> -->
        <div>
            {{$students->links()}}
        </div>
    </div>
    @endif
    @if($showForm==true)
    <!-- create Student -->
    <form action="" wire:submit.prevent="store">
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input 
            @error('publisher_name') is-invalid border-1 border-red-600 @enderror" 
            wire:model.lazy="name"
            placeholder="Entre Student Name"
            type="text" 
        />
        @error('name')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input 
            @error('publisher_name') is-invalid border-1 border-red-600 @enderror" 
            wire:model.lazy="email"
            placeholder="Entre Student Email"
            type="text" 
        />
        @error('email')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input 
        @error('publisher_name') is-invalid border-1 border-red-600 @enderror" 
        wire:model.lazy="address"
        placeholder="Entre Student Address"
        type="text" 
        />
        @error('address')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select wire:model.lazy="gender" class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input">
            <option value="">gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        @error('gender')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input 
            @error('publisher_name') is-invalid border-1 border-red-600 @enderror" 
            wire:model.lazy="phone"
            placeholder="Entre Student Phone"
            type="text" 
        />
        @error('phone')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input 
            @error('publisher_name') is-invalid border-1 border-red-600 @enderror" 
            wire:model.lazy="classes"
            placeholder="Entre Student Classes"
            type="text" 
        />
        @error('classes')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <button type="submit" class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Save
        </button>
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" 
            type="reset"
            wire:click="cancel"
        >
            Cancel
        </button>
    </form>
    @endif
    @if($updateForm)
    <!-- update Student -->
    <form action="">
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " 
            type="text" 
            placeholder="Update Student" 
            wire:model='edit_student_name' 
            
        />
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " 
            type="text" 
            placeholder="Update Student" 
            wire:model='edit_student_email' 
            
        />
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " 
            type="text" 
            placeholder="Update Student" 
            wire:model='edit_student_address' 
            
        />
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " 
            type="text" 
            placeholder="Update Student" 
            wire:model='edit_student_phone' 
            
        />
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input "
             name="" id=""
             wire:model='edit_student_gender'
        >
            <option value="">gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " 
            type="text" 
            placeholder="Update Student" 
            wire:model='edit_student_classes' 
            
        />
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            wire:click="updateStudent({{$updatedStudentId}})"
        >
            Edit
        </button>
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" 
            wire:click="cancel"
        >
            Cancel
        </button>
    </form>
    @endif
</div>
