<div>
    <x-slot name="title">{{__('Book')}}</x-slot>
    <a class="flex items-center justify-between p-4 mb-8 my-3 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple">
        <div class="flex items-center">
            <span>{{__('Book ')}} {{"($nbrBook)"}}</span>
        </div>
        <span>
            <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple border-2 border-purple-700" wire:click="showForm">
                Create Book
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
    <!-- author table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <!-- Search Book -->
            <input class="w-100 py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="Search Book ..." wire:model="search" type="text" />
            <!-- {{$search}} -->
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Id</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Publisher</th>
                        <th class="px-4 py-3">Author</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                        <!-- <th class="px-4 py-3">Date</th>
                      <th class="px-4 py-3">Actions</th> -->
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <!--loop for Books -->
                    @forelse($books as $book)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold"> {{$book->id}}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$book->book_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$book->category->category_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$book->publisher->publisher_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$book->author->author_name}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if($book->book_status=='Y')
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                            >
                                Available
                            </span>
                            @else
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-700"
                            >
                                Not Available
                            </span>
                            @endif
                        </td>
                        <!-- Actions (delete / update) -->
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit" wire:click="editForm({{$book->id}})">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </button>
                                <button class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" wire:click="deleteBook({{$book->id}})">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <!-- if it is empty -->
                    @empty
                    <p>No author</p>
                    <!-- endforelse -->
                    @endforelse


                </tbody>
            </table>
        </div>
    </div>
    @endif
    @if($showForm)
    <!-- create Book -->
    <form action="" wire:submit.prevent="store">
        <input class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " wire:model.lazy="book_name" type="text" placeholder="Entre a book name ..." />
        @error('book_name')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" name="" id="" wire:model.lazy="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
        </select>
        @error('category_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" name="" id="" wire:model.lazy="publisher_id">
            <option value="">Select a publisher</option>
            @foreach($publishers as $publisher)
            <option value="{{$publisher->id}}">{{$publisher->publisher_name}}</option>
            @endforeach
        </select>
        @error('publisher_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" name="" id="" wire:model.lazy="author_id">
            <option value="">Select an author</option>
            @foreach($authors as $author)
            <option value="{{$author->id}}">{{$author->author_name}}</option>
            @endforeach
        </select>
        @error('author_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <button type="submit" class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Save
        </button>
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" type="reset" wire:click="cancel">
            Cancel
        </button>
    </form>
    @endif
    @if($updateForm)
    <!-- update Book -->
    <form action="">
        <input class="w-full py-3 px-2 text-sm my-2 text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input " type="text" placeholder="Update Book" wire:model='edit_book_name' />
        @error('book_name')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" 
            name=""
            id="" 
            wire:model.lazy="category_id"
        >
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">
                {{$category->category_name}}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" 
            name=""
            id="" 
            wire:model.lazy="publisher_id"
        >
            <option value="">Select a publisher</option>
            @foreach($publishers as $publisher)
            <option value="{{$publisher->id}}">{{$publisher->publisher_name}}</option>
            @endforeach
        </select>
        @error('publisher_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <select class="w-full py-3 px-2 my-2 text-sm text-gray-700 placeholder-gray-900 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-500 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-dark focus:border-purple-300 focus:outline-none focus:shadow-outline-purple" 
            name=""
            id="" 
            wire:model.lazy="author_id"
        >
            <option value="">Select an author</option>
            @foreach($authors as $author)
            <option value="{{$author->id}}">{{$author->author_name}}</option>
            @endforeach
        </select>
        @error('author_id')
        <span class="text-red-600">{{$message}}</span>
        @enderror
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" wire:click="updateBook({{$updatedBookId}})">
            Edit
        </button>
        <button class="px-4 py-2 my-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple" wire:click="cancel" type="reset">
            Cancel
        </button>
    </form>
    @endif
</div>