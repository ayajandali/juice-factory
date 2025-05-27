<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>واجهة المعمل - Tailwind</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

</head>
<body class="bg-gray-50 text-gray-800 font-sans">

    <header class="bg-blue-700 text-white text-center p-10 animate_animated animate_fadeInDown">
        <h1 class="text-4xl font-bold mb-2">مرحبا بكم في واجهة المعمل</h1>
        <p class="text-lg">أفضل منتجات وخدمات بجودة عالية</p>
    </header>

    <section class="max-w-5xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg animate_animated animate_fadeInLeft">
        <h2 class="text-3xl font-semibold text-blue-700 mb-4">نبذة عنا</h2>
        <p class="text-gray-700 leading-relaxed">
            نحن معمل متخصص في تقديم أفضل المنتجات الصناعية والخدمات المميزة لعملائنا.
        </p>
    </section>

    <section class="max-w-5xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg animate_animated animate_fadeInRight">
        <h2 class="text-3xl font-semibold text-blue-700 mb-4">من نحن</h2>
        <p class="text-gray-700 leading-relaxed">
            فريقنا ملتزم بالابتكار والجودة، ويعمل بشغف لتلبية احتياجات السوق.
        </p>
    </section>

    <section class="max-w-7xl mx-auto mt-12 p-6 bg-white rounded-lg shadow-lg animate_animated animate_fadeInUp">
        <h2 class="text-3xl font-semibold text-blue-700 mb-6">منتجاتنا</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach($products as $product)
                <div class="border border-gray-300 rounded-lg p-5 hover:shadow-lg transition-shadow duration-300 animate_animated animate_zoomIn">
                    <h3 class="text-xl font-bold mb-2 text-blue-800">{{ $product->product_name }}</h3>
                    <p class="text-gray-600 mb-3">{{ $product->description }}</p>
                </div>
            @endforeach
        </div>
    </section>

</body>
</html>