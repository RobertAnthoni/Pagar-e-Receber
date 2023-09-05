<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $header }} | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')


        <!-- Notificação -->
        @if (session()->has('message'))
            <div>
                <div id="alert"
                    class="bg-white/60 backdrop-blur-xl z-20 max-w-md absolute right-5 top-5 rounded-lg p-6 shadow">
                    <span class="flex items-center">
                        <!-- <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAADGklEQVR4nO2Zu2/UQBCHR6IA/gAgUPEqQRBQeORmbAhNSsKjBGpQIlFS0VJFQalpoEMCEULSRxFCQlF4xLO+kAYJAQFFUUCiIomM1sed7s4+e23veg+RkaaxtOv5/Jtdz84CbNn/YOz2gHAIGK8A043QPbpce+b2QNeaT3uBcQQYJ0DQKggKUnwVmJ4B03B3gDENAOM0MG4oBB/vcizjFHjO+fIBPKcPGF/lDr6zv4QqnjQP8NHdAYLGgWnTAESzQvdhaXC7GQh2D4Ogt8YAokDzsIAH9UJUnaPA9KU0CFF3/AbC6dUD4dMJYPpZPgTVlfkB3H+8GITXfwgEfbcGIRrKLMMiHcgHIRcb4xv7EFT39/DpzM7sIHJ3sh980JZmY9kg5F5e5CdnDIQ2gemUOoiZn50uVWYVUwovWA9WpLiProoa09YDFan+QqWKLX9tMH0AxkEQeA0E/kofg+uwcHpPkhoj5X9drLaU8owPFNPrVhLIhFWI4Oo2EPhacezTziBqhyJzEEyP1NMRVzqvj7IgmBah2r+vDeJh5nnend0dp4aTIRB5HhkHxrvZC0r0Cykhmt2hKIjnXMog6+OmcX0gcK18CJLzXYxJrcr1DBM8b/sICjC6ISgIYy4GIieh2+owBiBEJ5AsqdVIMbrTus6c3sjOp2thC9XUyrLYlZUxpISof6QKdugO5p0wRhlZQRtTgmq+hLuiIEV/iO3KNJtuJUTSD1FHidKujCklRJi2TxJAaLjwC5qVMaGEaIDcTACR6wTXNbzkXvjXlYWdEQj6HV+etKbXlKGX6/TJZIhaeg10QaBBijugZLIrbj/YINaZZuDfbwfhRvZesGzt2w5cRHwUcrZM57sg+OCvz+W/M5H3E7KBbBuC8StU3f1QyGRLX7b2rYHgGniVY6DFfPcIMH22ALGs76KnbvJ+otw1M1c8nZI3gDGjWzOHc4+auwyNXMfhrH4Imil+zZbHvMq5sKFcqNAMx06qlx0mTTaUZS9WVrvywJOePivheUKW4qlVrE2TwcnztF8ZCjsdNR8Kn3V14FsG2uwPDvl6chRU9CgAAAAASUVORK5CYII="> -->
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFiklEQVR4nO2ZbUxTVxiA77bMuSET2looX9oPbC2ttKV+znVZcH/MMhN/sMxlJi7OBq2UKAGdlLu2Wi4fZRSQBlGQW1vlxKowWiitIFLawQQRaLQJSljYNC4xMeW6zT8s16SGCS5QbktZeP7147zvefqee+7beyAoyFyiGz42sAxcaKljpKOXUeZFFbTUMS6LhBnLFQk3wqIiv5FhzjgZFi+2iFTkyvhW3McOOMBEdH7GWHQBNkpWpi+WiCytJyszzY0d3NS7oB8UehhdIB0lKTEvSb0z1CJyYbf0sKhnMlPsCij3DEbJP0jvk9WYh1q4M1QiOaldUrnQOSkTECThx0tWSz0UDTY0TxkjHa1AmUbZfMbkpnZIcwRdk9mCbmIl/IyQT0uH1iDYALU4OAkgCDqZ6pDmpXZO5gg6g5bjJUNURDpALcb6giBTwHNIT/JvTB4PtoSffmqxtC+mFHPFlRGWUMmzZSl4duwEvyPgHTIgbseUZLljtXeIiAVD8NuqlLZhBb89tBJ+pqCptxYao2SjLQJaylRwrn5VymkaL+K2TGm41glVSts+aKlRxbkiK2dfw7Sc5kNF7FZ2Idd6UJnS9hzmte+Clgr6ZCCrXH8FK+c0fTb9fRWvraiAb2+BlgK1yUCmXw+wSo75XxI4yhTboQJ+u2txZgZBkJ1Rs7qDpkvrTqqO/q/v1TEvyWqTL2N6FpghoWNZ31Ol2PoVfDsCLQYuWtmpW7TyFzfjKv50xJ/5qy1BXzDbToa3KPUsE1b7BgkN19Ki5NlGYJb1QyjU9MWU7HfTtE+ccT9uw1+3J5z5pDWh+nFLYk3VdBkjHZUZmEasjmWaVQLhtlg0KRbPaZ4jZkETmlp1hPt3hLwQiziKPIvMQZ5G5iJPVh9Hfo86gUxEKZAxEow8ICkRL0WNeCiaLP+4X2JLHG6aNm96LGuSnmtJrHnctPbcS5lGev1hIwPFUPrsEqWcJguy4SfPaV7TDIkcwc3KbKETyIQukJnmBgfEfWC/uB/s23wH7N0yCL7cMgz2bPOA3dvvg88/ur8DmlqZtePFB3LwfNVR8CzyGHgamQv+WH0cPIo6ASai8sEYCQajZCXwklXAQ9FUvKoItVTuStCyXp8ALnM9qfaRed35sUb6BcxER2eV0LGvW7Sc5lklcI4KbsqzBU5EJnIhmaKfke/Efch+8W3km80DyN7Ng0jG1mFkz1YPsnv7vcJdW7wboEAZ4cIr3LHaik5aKeX1z6ys82vMSee+vpJ0njGbRCXbbNGxr42Uv0EipAAIvOOK1dq648qdcx7DBSv060FzFdt8r4xjpkHhgitB+74zXvfpXCXOJjc265PBvZpwkphOV5xuuz2+6lYzrWbGMvMvpzqWyVqb3DhSzTBToXClc239Snv8mfbWxOrB12WsLN17KNNorWeZhsNaYvoya03Q2yyJZ8ev4xf62noOWHfhCyOjYRBlGodQBhr+En5up9W825J0Fsa336vr6qYAvf6pkdFQZWAZQn/HJgpbDBoR6j9pAdFLLU13xZYNEjUBJc82qODZX3UOIaGfWpSOP3xw07SEJVbzbRIFv92Xz3fIoVBwN7ZQ0h9T7MMfPhAdG+bbJN9vdPjy+B3BlfFQCiV3qYhvIAgSfk7yb0hyUzt8eK8VlAReilrioWh8QxRkXhImZsMRlHHxVbM5F/KENyQ5gi5ftqCbWJmHFFjiJat909v4uWKioyqUYbw833HHhF2SbKHTd1jUQ4zMwyhY8oCk9HkppwJaToGK4MiFPRKZyOXLFLkXJvMrWbHp5UEPSRnwNbEQEZxDwp50/KDnwKbeDChQJsj57PFoOPAABIjgHBT2ihd09EYERIiEBcsi4cZyRcKN/01FDCwDt4Fh3BHsRP8AgpuIkIy0+FIAAAAASUVORK5CYII=">
                        <h1 class="text-blue-500 px-2">{{ session('message') }}</h1>
                    </span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div>
                <div id="alert"
                    class="bg-white/60 backdrop-blur-xl z-20 max-w-md absolute right-5 top-5 rounded-lg p-6 shadow">
                    <span class="flex items-center">
                        <div
                            class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <h1 class="text-red-500 px-2">{{ session('error') }}</h1>
                    </span>
                </div>
            </div>
        @endif

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $header }}
                    </h2>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script>
    setTimeout(function() {
        $('#alert').fadeOut('fast');
    }, 3000);
</script>
