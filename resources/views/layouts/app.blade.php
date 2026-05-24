<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Force Control System</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-gray-900 text-white hidden md:flex md:flex-col">
            <div class="px-6 py-6 border-b border-gray-700">
                <div class="text-xl font-bold">FCS</div>
                <div class="text-xs text-gray-400 mt-1">Force Control System</div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg bg-gray-800">
                    ダッシュボード
                </a>
                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    シフト管理
                </a>
                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    実績管理
                </a>
                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    マスタ管理
                </a>
                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-800">
                    CSV出力
                </a>
            </nav>

            <div class="px-4 py-4 border-t border-gray-700 text-xs text-gray-400">
                ログイン中：{{ Auth::user()->name ?? '' }}
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        @isset($header)
                            {{ $header }}
                        @else
                            <h1 class="text-xl font-bold text-gray-800">Force Control System</h1>
                        @endisset
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-sm text-gray-600">
                            {{ Auth::user()->email ?? '' }}
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm bg-gray-900 text-white px-4 py-2 rounded-lg">
                                ログアウト
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
