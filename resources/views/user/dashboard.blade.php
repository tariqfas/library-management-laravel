<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Library System</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex">
        <div class="w-1/4 bg-gray-200 p-6">
            <!-- Sidebar -->
            <h2 class="text-lg font-bold mb-4">Library System</h2>
            <ul class="space-y-2">
                <li><a href="#" class="text-blue-500">Dashboard</a></li>
                <li><a href="#" class="text-blue-500">Books</a></li>
                <li><a href="#" class="text-blue-500">Borrowed Books</a></li>
                <li><a href="#" class="text-blue-500">My Profile</a></li>
                <li><a href="#" class="text-blue-500">Logout</a></li>
            </ul>
        </div>
        <div class="w-3/4 p-6">
            <!-- Main Content -->
            <h1 class="text-2xl font-bold mb-4">Welcome, John Doe!</h1>
            <div class="bg-white rounded shadow p-6">
                <!-- Dashboard content goes here -->
                <!-- Dashboard content goes here -->
                <h2 class="text-lg font-bold mb-4">My Borrowed Books</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-white rounded shadow p-4">
                        <h3 class="text-xl font-bold mb-2">Book Title 1</h3>
                        <p class="text-gray-600">Author: Author Name 1</p>
                        <p class="text-gray-600">Borrowed on: June 10, 2023</p>
                    </div>
                    <div class="bg-white rounded shadow p-4">
                        <h3 class="text-xl font-bold mb-2">Book Title 2</h3>
                        <p class="text-gray-600">Author: Author Name 2</p>
                        <p class="text-gray-600">Borrowed on: June 12, 2023</p>
                    </div>
                    <div class="bg-white rounded shadow p-4">
                        <h3 class="text-xl font-bold mb-2">Book Title 3</h3>
                        <p class="text-gray-600">Author: Author Name 3</p>
                        <p class="text-gray-600">Borrowed on: June 14, 2023</p>
                    </div>
                </div>
                <!-- Dashboard content goes here -->
                <h2 class="text-lg font-bold mb-4">My Borrowed Books</h2>

                <div class="mb-4">
                    <input type="text" placeholder="Search books" class="border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Book Title</th>
                            <th class="py-2 px-4 border-b">Author</th>
                            <th class="py-2 px-4 border-b">Borrowed On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b">Book Title 1</td>
                            <td class="py-2 px-4 border-b">Author Name 1</td>
                            <td class="py-2 px-4 border-b">June 10, 2023</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">Book Title 2</td>
                            <td class="py-2 px-4 border-b">Author Name 2</td>
                            <td class="py-2 px-4 border-b">June 12, 2023</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b">Book Title 3</td>
                            <td class="py-2 px-4 border-b">Author Name 3</td>
                            <td class="py-2 px-4 border-b">June 14, 2023</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Dashboard content goes here -->
                <h2 class="text-lg font-bold mb-4">My Borrowed Books</h2>

                <div class="mb-4">
                    <input type="text" placeholder="Search books" class="border border-gray-300 px-4 py-2 rounded-lg">
                </div>

                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Book Title</th>
                            <th class="py-2 px-4 border-b">Author</th>
                            <th class="py-2 px-4 border-b">Borrowed On</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($borrowedBooks as $book)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $book->title }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->author }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->borrowed_date }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $borrowedBooks->links() }}
                </div>

            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>

</html>