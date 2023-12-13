<!DOCTYPE html>

<html>

<head>
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style type="text/tailwindcss">
        .page-actions {
            @apply my-4
        }

        .page-action-link {
            @apply text-sm font-normal p-2 mr-2 border border-slate-300 hover:border-slate-700 rounded transition
        }

        .page-title {
            @apply text-2xl font-bold mb-5
        }

        .book-card {
            @apply bg-gray-50 border border-gray-100 rounded-lg drop-shadow-lg mb-5 px-4 py-6
        }

        .book-isbn {
            @apply inline bg-gray-100 border border-slate-300 rounded-lg px-2 py-1 text-sm font-light text-gray-600
        }

        .book-title {
            @apply text-lg font-bold
        }

        .book-author {
            @apply text-sm font-light text-gray-700
        }
    </style>
</head>

<body>
    <div class="container mt-6 m-auto">
        <div class="page-actions">
            @yield('page-actions')
        </div>
        <h1 class="page-title">
            @yield('title')
        </h1>
        <div>
            @yield('content')
        </div>
    </div>

</body>

</html>
